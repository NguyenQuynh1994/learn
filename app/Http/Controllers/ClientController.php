<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\LessonWord;
use Session;
use App\Models\Answer;
use App\Models\UserLesson;
use App\Models\UserLevel;
use App\Models\UserCategory;
use App\Models\Level;
use Auth;
use App\Models\Post;
use Cloudder;
use Carbon\Carbon;
use DateTime;

class ClientController extends Controller
{
    public function __construct()
    {
        session()->keep([
            'index',
            'categoryName',
            'type',
            'lesson_id',
            'total',
            'correct',
            'result'
        ]);
    }

    public function category()
    {
        if (Auth::user()->id != '') {
            $levels = Auth::user()->levels;

            return view('client.category', ['levels' => $levels]);
        }
    }

    public function lesson(Request $request)
    {
        $categoryName = $request->categoryName;
        $categoryId = $request->categoryId;
        $lessons = Lesson::where('category_id', $categoryId)->get();
        session()->flash('categoryName', $categoryName);

        return view('client.lesson', ['lessons' => $lessons, 'category_name' => $categoryName]);
    }

    public function optionWord($lessonId, $index)
    {
        $words = LessonWord::where('lesson_id', $lessonId)->get();

        return $words[$index];
    }

    public function optionAnswer($wordId)
    {
        $answers = Answer::where('lesson_word_id', $wordId)->where('correct', 1)->get();
        return $answers;
    }

    public function getFlagUserLesson($lesson_id)
    {
        $lessons = Lesson::find($lesson_id)->category->lessons;
        $use_flag = 0;

        foreach ($lessons as $lesson) {
            $userlesson = UserLesson::where('lesson_id', $lesson->id)->where('user_id', Auth::user()->id)->first();
            if (isset($userlesson->result) && ($userlesson->result > 50)) {
                $use_flag = 1;
            } else {
                $use_flag = 0;

                return $use_flag;
            }
        }
        return $use_flag;
    }

    public function changeFlagUserLevel($lesson_id)
    {
        $use_flag = $this->getFlagUserLesson($lesson_id);
        $flag = 0;

        if ($use_flag == 1) {
            $categories = Lesson::find($lesson_id)->category->level->categories;
            foreach ($categories as $category) {
                $usercategory = UserCategory::where('category_id', $category->id)->where('user_id', Auth::user()->id)->first();

                if (isset($usercategory->status) && $usercategory->status == 1) {
                    $flag = 1;
                } else {
                    $flag = 0;
                }
            }
        }

        if ($flag == 1) {
            $level = Lesson::find($lesson_id)->category->level;
            $userlevel = UserLevel::where('level_id', $level->id)->where('user_id', Auth::user()->id)->update(['status' => 1]);
            $userLevel = UserLevel::where('level_id', $level->id)->where('user_id', Auth::user()->id)->first();
            $userLevelNext = UserLevel::skip($userLevel->id)->take(1)->get();
            foreach ($userLevelNext as $item) {
                UserLevel::find($item->id)->update(['status' => 1]);
                $categoriesNext = Level::find($item->id)->categories;

                foreach ($categoriesNext as $category) {
                    UserCategory::where('user_id', Auth::user()->id)->where('category_id', $category->id)->update(['status' => 1]);
                }
            }
        }
    }

    public function word($id)
    {
        if (empty(session('correct'))) {
            session()->flash('correct', 0);
        } else {
            session()->keep('correct');
        }

        if (empty(session('index'))) {
            session()->flash('index', 0);
        } else {
            session()->keep('index');
        }

        $words = LessonWord::where('lesson_id', $id)->get();
        $total = 0;

        foreach ($words as $word) {
            if( count($word->answers) != 0) {
                $total = $total + 1;
            }
        }

        session()->flash('lesson_id', $id);

        if (intval(session('index')) < $total) {
            // if (session('index') == 0) {
            //     session()->forget('result');
            // }
            $word = $words[intval(session('index'))];
        } else {
            if (!Auth::guest()) {
                $input = [
                    'user_id' => Auth::user()->id,
                    'lesson_id' => $id,
                    'result' => intval(((intval(session('correct'))) / $total) * 100),
                ];
                $userlesson = UserLesson::where('user_id', Auth::user()->id)->where('lesson_id', $id)->get();

                if (!empty($userlesson)) {
                    UserLesson::where('user_id', Auth::user()->id)->where('lesson_id', $id)->update($input);
                } else {
                    UserLesson::create($input);
                }

                $this->changeFlagUserLevel($id);
            }

            return redirect()->action('ClientController@category');
        }

        $answers = Answer::where('lesson_word_id', $word->id)->get();

        $optionAnswers = [];
        foreach ($answers as $answer) {
            $optionAnswers[$answer->id] = $answer->content;
        }

        return view('client.word', [
            'word' => $word,
            'answers' => $answers,
            'optionAnswers' => $optionAnswers
        ]);
    }

    public function result(Request $request)
    {
        session()->flash('correct', request()->get('correct'));
        $index = request()->get('index') + 1;
        session()->flash('index', $index);

        $type = request()->get('type');
        $word_id = request()->get('word_id');

        if ($type == 1) {
            $correct = Answer::find(request()->get('answer_id'))->correct;
            if ($correct == 1) {
                $true = intval(session()->get('correct')) + 1;
                session()->flash('correct', $true);
                return response()->json(['success' => true, 'message' => 'Bạn đã chọn đáp án đúng']);
            } else {
                return response()->json(['success' => false, 'message' => 'Bạn đã chọn đáp án sai']);
            }
        }
        elseif ($type == 2) {
            $answers = LessonWord::find($word_id)->answers;
            $correct_id = [];

            foreach ($answers as $value) {
                if ($value->correct == 1) {
                    $correct_id[] = $value->id;
                }
            }
            $answer = request()->get('answer_ids');
            $length = count($answer);

            for ($i=0; $i < $length; $i++) {
                if (in_array($answer[$i], $correct_id)) {
                    break;
                } else {
                    return response()->json(['success' => false, 'message' => 'Bạn đã chọn đáp án sai']);
                }
            }

            $true = intval(session()->get('correct')) + 1;
            session()->flash('correct', $true);
            return response()->json(['success' => true, 'message' => 'Bạn đã chọn đáp án đúng']);
        } elseif ($type == 3) {
            $answers = LessonWord::find($word_id)->answers;

            foreach ($answers as $value) {
                if ($value->correct == 1) {
                    $str1 = strtolower(trim($value->content));
                    $str2 = strtolower(trim(request()->get('answer')));

                    if (strcmp($str1, $str2) == 0) {
                        $true = intval(session()->get('correct')) + 1;
                        session()->flash('correct', $true);
                        return response()->json(['success' => true, 'message' => 'Bạn đã nhập đúng']);
                    }
                }
            }
            return response()->json(['success' => false, 'message' => 'Bạn đã nhập sai']);
        } else {
            $correct = Answer::find(request()->get('select_answer'))->correct;
            if ($correct == 1) {
                $true = intval(session()->get('correct')) + 1;
                session()->flash('correct', $true);
                return response()->json(['success' => true, 'message' => 'Bạn đã chọn đáp án đúng']);
            } else {
                return response()->json(['success' => false, 'message' => 'Bạn đã chọn đáp án sai']);
            }
        }
    }

    public function chart()
    {
        return view('client.chart');
    }

    public function dataChart()
    {
        $userlessons = UserLesson::where('user_id', Auth::user()->id)->orderBy('updated_at', 'ASC')->limit(100)->get();
        $datas[] = ['Time', 'Result'];
        $dates = [];
        $days = [];
        $results= [];

        foreach ($userlessons as $data) {
            if (!empty($days)) {
                if (((strtotime($data->updated_at) - strtotime(end($days))) / 43200) > 1) {
                    $days[] = $data->updated_at;
                    $dates[] = date('d', strtotime($data->updated_at));
                    $results[] = (int)$data->result;
                } else {
                    $days[] = $data->updated_at;
                    $end = (int)end($results) + (int)$data->result;
                    array_pop($results);
                    array_push($results, $end);
                }
            } else {
                $days[] = $data->updated_at;
                $dates[] = date('d', strtotime($data->updated_at));
                $results[] = (int)$data->result;
            }
        }

        foreach ($dates as $key => $value) {
            $datas[] = [$value, $results[$key]];
        }

        // foreach ($charts as $value) {
        //     $datas[] = end($charts);
        //     array_pop($charts);
        // }

        return response()->json(['datas' => $datas]);
    }

    public function createPost()
    {
        return view('client.post.create');
    }

    public function storePost(Request $request)
    {
        if (Auth::user()->id != '') {

            $input = [
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => Auth::user()->id,
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                Cloudder::upload($image, config('common.path.path_cloud_category_image') . time(), array(
                   "width" => 125, "height" => 125,
                   "crop" => "fill", "gravity" => "face",
                   "radius" => "max",
                 ));
                $input['image'] = Cloudder::getResult()['url'];
            }

            Post::create($input);

            return redirect()->action('ClientController@post');
        }
    }

    public function post()
    {
        $posts = Post::get();

        return view('client.post.index', ['posts' => $posts]);
    }

    public function showPost($id)
    {
        $post = Post::find($id);

        return view('client.post.show', ['post' => $post]);
    }
}
