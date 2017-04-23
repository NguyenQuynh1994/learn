<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Level;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::get();

        return view('admin.level.index', ['levels' => $levels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'no' => request()->get('no'),
        ];

        try {
            $data = Level::create($input);

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
            'no' => request()->get('no'),
        ];

        if (Level::where('id', $id)->update($input)) {
            session()->flash('success', trans('message.update_successfully'));
            // return redirect()->route('admin.levels.index');
            return response()->json(['success' => true]);
        }
        session()->flash('errors', trans('message.updating_error'));
        // return redirect()->route('adminlevels.index');
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

            if (Level::destroy($ids) != 0) {
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
