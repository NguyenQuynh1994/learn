<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Level;
use Cloudder;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();

        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataLevels = Level::get();
        $levels = [];
        foreach ($dataLevels as $level) {
            $levels[$level->id] = $level->name;
        }

        return view('admin.category.create', ['levels' => $levels]);
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
            'name' => $request->name,
            'description' => $request->description,
            'level_id' => $request->level_id,
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

        if (Category::create($input)) {
            session()->flash('success', trans('message.create_successfully'));
            return redirect()->route('admin.categories.index');
        }
        session()->flash('errors', trans('message.creating_error'));
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataLevels = Level::get();
        $levels = [];
        foreach ($dataLevels as $level) {
            $levels[$level->id] = $level->name;
        }
        $category = Category::find($id);
        return view('admin.category.edit', ['category' => $category, 'levels' => $levels]);
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
            'name' => $request->name,
            'description' => $request->description,
            'level_id' => $request->level_id,
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

        if (Category::where('id', $id)->update($input)) {
            session()->flash('success', trans('message.update_successfully'));
            return redirect()->route('admin.categories.index');
        }
        session()->flash('errors', trans('message.updating_error'));
        return redirect()->route('admin.categories.index');
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

            if (Category::destroy($ids) != 0) {
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
