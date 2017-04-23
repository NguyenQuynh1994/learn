<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\LessonWord;
use App\Models\Answer;
use Cloudder;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::get();

        return view('admin.answer.index', ['answers' => $answers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $correct = [
        1 => 'true',
        0 => 'false',
    ];

    public function create()
    {
        $correct = $this->correct;
        $dataWords = LessonWord::get();
        $words = [];
        foreach ($dataWords as $word) {
            $words[$word->id] = $word->content;
        }

        $dataCategories = Category::get();
        $categories = [];

        foreach ($dataCategories as $key => $category) {
            $categories[$category->id] = $category->name;
        }

        return view('admin.answer.create', ['words' => $words, 'correct' => $correct, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = [
            'content' => $request->content,
            'correct' => $request->correct,
            'lesson_word_id' => $request->lesson_word_id,
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

        if (Answer::create($input)) {
            session()->flash('success', trans('message.create_successfully'));
            return redirect()->route('admin.answers.index');
        }
        session()->flash('errors', trans('message.creating_error'));
        return redirect()->route('admin.answers.index');
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
        $answer = Answer::find($id);
        $correct = $this->correct;
        $dataWords = LessonWord::get();
        $words = [];
        foreach ($dataWords as $word) {
            $words[$word->id] = $word->content;
        }

        return view('admin.answer.edit', ['words' => $words, 'correct' => $correct, 'answer' => $answer]);
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
        $input = [
            'content' => $request->content,
            'correct' => $request->correct,
            'lesson_word_id' => $request->lesson_word_id,
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

        if (Answer::where('id', $id)->update($input)) {
            session()->flash('success', trans('message.update_successfully'));
            return redirect()->route('admin.answers.index');
        }
        session()->flash('errors', trans('message.updating_error'));
        return redirect()->route('admin.answers.index');
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

            if (Answer::destroy($ids) != 0) {
                session()->flash('success', trans('message.delete_successfully'));
                return response()->json(['ids' => $ids]);
            }

            session()->flash('errors', trans('message.deleting_error'));
            return rediect()->back();
        }

        session()->flash('errors', trans('message.item_not_exist'));
        return rediect()->back();
    }
}
