<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Category;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::get();
        $dataCategories = Category::get();
        $categories = [];
        foreach ($dataCategories as $category) {
            $categories[$category->id] = $category->name;
        }

        return view('admin.lesson.index', ['lessons' => $lessons, 'categories' => $categories]);
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
        foreach ($dataCategories as $category) {
            $categories[$category->id] = $category->name;
        }

        return view('admin.lesson.create', ['categories' => $categories]);
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
            'name' => request()->get('name'),
            'description' => request()->get('description'),
            'category_id' => request()->get('category_id'),
        ];

        try {
            $data = Lesson::create($input);

            session()->flash('success', trans('message.create_successfully'));
            return response()->json(['success' => true]);
        } catch (Exception $ex) {
            session()->flash('errors', trans('message.creating_error'));
            return response()->json(['success' => false]);
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
        //
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
            'name' => request()->get('name'),
            'description' => request()->get('description'),
            'category_id' => request()->get('category_id'),
        ];

        if (Lesson::where('id', $id)->update($input)) {
            session()->flash('success', trans('message.update_successfully'));
            return response()->json(['success' => true]);
        }
        session()->flash('errors', trans('message.updating_error'));
        return response()->json(['success' => false]);
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

            if (Lesson::destroy($ids) != 0) {
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
