<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\LessonWord;
use App\Models\Answer;
use Cloudder;

class LessonWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCategories = Category::get();
        $categories = [];

        foreach ($dataCategories as $key => $category) {
            $categories[$category->id] = $category->name;
        }

        $words = LessonWord::get();
        $dataLessons = Lesson::get();
        $lessons = [];

        foreach ($dataLessons as $lesson) {
            $lessons[$lesson->id] = $lesson->name;
        }

        return view('admin.word.index', [
            'words' => $words,
            'lessons' => $lessons,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataCategories = Category::get();
        $categories = [];
        $type = $this->type;
        $correct = $this->correct;

        foreach ($dataCategories as $key => $category) {
            $categories[$category->id] = $category->name;
        }

        return view('admin.word.create', ['categories' => $categories, 'type' => $type, 'correct' => $correct]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subAnswer = [];
        $type = $request->get('type');
        $word = [
            'lesson_id' => $request->get('lesson-id'),
            'content' => $request->get('content'),
            'type' => $type,
        ];
        $data = LessonWord::create($word);

        $answer = [];
        if ($type == 3) {
            $total = $request->get('total-write');
            for ($i=0; $i <= $total; $i++) {
                $answer[] = [
                    'content' => $request->get('input-content-' . $i),
                    'lesson_word_id' => $data->id,
                    'correct' => 1,
                ];
            }
        } elseif ($type == 1 || $type == 2) {
            $total = $request->get('total');
            for ($i=0; $i <= $total; $i++) {
                $subAnswer = [
                    'content' => $request->get('content-' . $i),
                    'correct' => $request->get('correct-' . $i),
                    'lesson_word_id' => $data->id,
                ];
                if ($request->hasFile('image-' . $i)) {
                    $image = $request->file('image-' . $i);
                    Cloudder::upload($image, config('common.path.path_cloud_category_image') . time(), array(
                       "width" => 110, "height" => 125,
                       "crop" => "fill", "gravity" => "face",
                       "radius" => "max"
                     ));
                    $subAnswer['image'] = Cloudder::getResult()['url'];
                }
                $answer[] = $subAnswer;
            }
        } else {
            $total = $request->get('total-select');
            $update = ['last_content' => $request->get('last_content')];
            $updateWord = LessonWord::find($data->id)->update($update);
            for ($i=0; $i <= $total; $i++) {
                $subAnswer = [
                    'content' => $request->get('select-content-' . $i),
                    'correct' => $request->get('select-correct-' . $i),
                    'lesson_word_id' => $data->id,
                ];
                $answer[] = $subAnswer;
            }
        }

        if (Answer::insert($answer)) {
            session()->flash('success', trans('message.create_successfully'));
            return redirect()->route('admin.lessonWords.index');
        } else {
            session()->flash('errors', trans('message.creating_error'));
            return redirect()->route('admin.lessonWords.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lessonWord = LessonWord::find($id);
        $lesson = $lessonWord->lesson;
        $chooseLesson = [
            $lesson->id => $lesson->name,
        ];
        $dataCategories = Category::get();
        $categories = [];
        $type = $this->type;
        $correct = $this->correct;
        $answers = $lessonWord->answers;

        foreach ($dataCategories as $key => $category) {
            $categories[$category->id] = $category->name;
        }

        return view('admin.word.edit', [
            'categories' => $categories,
            'type' => $type,
            'correct' => $correct,
            'lessonWord' => $lessonWord,
            'chooseLesson' => $chooseLesson,
            'answers' => $answers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $word = LessonWord::find($id);
        $type = $word->type;
        if ($type == 4) {
            $input = [
                'content' => request()->get('content'),
                'last_content' => request()->get('last_content')
            ];
        } else {
            $input = [
                'content' => request()->get('content'),
            ];
        }


        if ($word->update($input)) {
            session()->flash('success', trans('message.update_successfully'));
            return redirect()->back();
        }
        session()->flash('errors', trans('message.updating_error'));
        return redirect()->back();
    }

    public function updateAnswer(Request $request)
    {
        $type = $request->get('type');

        $id = $request->get('id');
        $input = [];
        if ($type == 1) {
            $input = [
                'content' => $request->get('content'),
                'correct' => $request->get('correct'),
                'lesson_word_id' => $request->get('lesson_word_id'),
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                Cloudder::upload($image, config('common.path.path_cloud_category_image') . time(), array(
                   "width" => 110, "height" => 125,
                   "crop" => "fill", "gravity" => "face",
                   "radius" => "max"
                 ));
                $input['image'] = Cloudder::getResult()['url'];
            }
        } else {
            $input = [
                'content' => $request->get('input-content'),
                'lesson_word_id' => $request->get('lesson_word_id'),
            ];
        }

        if (Answer::where('id', $id)->update($input)) {
            session()->flash('success', trans('message.update_successfully'));
            return redirect()->route('admin.lessonWords.edit', ['id' => $request->get('lesson_word_id')]);
        }
        session()->flash('errors', trans('message.updating_error'));
        return redirect()->route('admin.lessonWords.edit', ['id' => $request->get('lesson_word_id')]);
    }

    public function createAnswer(Request $request)
    {
        $type = $request->get('type');
        $input = [];

        if ($type == 1 || $type == 2) {
            $input = [
                'content' => $request->get('content'),
                'correct' => $request->get('correct'),
                'lesson_word_id' => $request->get('lesson_word_id'),
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                Cloudder::upload($image, config('common.path.path_cloud_category_image') . time(), array(
                   "width" => 110, "height" => 125,
                   "crop" => "fill", "gravity" => "face",
                   "radius" => "max"
                 ));
                $input['image'] = Cloudder::getResult()['url'];
            }
        } elseif ($type == 3) {
            $input = [
                'content' => $request->get('input-content'),
                'correct' => 1,
                'lesson_word_id' => $request->get('lesson_word_id'),
            ];
        } else {
            $input = [
                'content' => $request->get('select-content'),
                'correct' => $request->get('select-correct'),
                'lesson_word_id' => $request->get('lesson_word_id'),
            ];
        }

        if (Answer::create($input)) {
            session()->flash('success', trans('message.create_successfully'));
        } else {
            session()->flash('errors', trans('message.creating_error'));
        }

        return redirect()->route('admin.lessonWords.edit', ['id' => $request->get('lesson_word_id')]);
    }

    public function deleteAnswer($id)
    {
        $wordId = Answer::find($id)->lessonWord->id;
        if (Answer::destroy($id) != 0) {
            session()->flash('success', trans('message.delete_successfully'));
        } else {
            session()->flash('errors', trans('message.deleting_error'));
        }
        return redirect()->route('admin.lessonWords.edit', ['id' => $wordId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->has('ids')) {
            $ids = request()->get('ids');

            if (LessonWord::destroy($ids) != 0) {
                session()->flash('success', trans('message.delete_successfully'));
                return response()->json(['ids' => $ids]);
            }

            session()->flash('errors', trans('message.deleting_error'));
            return rediect()->back();

        }

        session()->flash('errors', trans('message.item_not_exist'));
        return rediect()->back();
    }

    public $type = [
        1 => 'Radio',
        2 => 'Checkbox',
        3 => 'Input',
        4 => 'Select',
    ];

    public $correct = [
        1 => 'true',
        0 => 'false',
    ];
}
