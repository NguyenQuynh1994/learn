@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="row">
         <!-- page header -->
        <div class="col-lg-12">
            <h1 class="page-header">Create LessonWord Forms</h1>
        </div>
        <!--end page header -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
                {!! Form::open([
                    'method' => 'POST',
                    'action' => ['Admin\LessonWordController@store'],
                    'class' => 'form-horizontal frmCreate',
                    'role' => 'form',
                    'files' => true,
                ]) !!}
                    <div class="panel-heading">
                        <button class="btn-back btn btn-default btn-lg btn-header" id="btn-back">
                            Back
                        </button>
                        <button class="btn btn-default btn-lg btn-header" id="btn-common" data-url="{{ route('admin.lessonWords.index') }}">
                            Manage Lesson Word
                        </button>
                        {!! Form::submit('Store', ['class' => 'btn btn-info btn-lg btn-header']) !!}
                        {!! Form::reset('Reset', ['class' => 'btn btn-default btn-lg btn-danger']) !!}
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                {!! Form::label('category_id', 'Category', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-8">
                                    {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control', 'id' => 'category_id_create_lesson', 'placeholder' => 'Please choose category',]) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('lesson_id', 'Lesson', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-8">
                                    <div class="word-correct">
                                        <label>
                                            <select name="lesson-id" id="lessonword-correct" class="lessonword-correct form-control">
                                                <option value="">Choose category before choose lesson</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('type', 'type', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-8">
                                    {!! Form::select('type', $type, old('type'), ['class' => 'form-control type', 'placeholder' => 'Please choose type']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('content', 'Content', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('content', old('content'), ['class' => 'form-control', 'id' => 'content']) !!}
                                </div>
                            </div>

                            <div class="form-group last-content hidden">
                                {!! Form::label('last_content', 'Last Content', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('last_content', old('last_content'), ['class' => 'form-control', 'id' => 'last_content']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading">
                        <h4>
                            Create answer of lessonword
                        </h4>
                        <button type="button" class="btn btn-info new">
                            New Answer
                        </button>
                        <button type="button" class="btn btn-info remove">
                            Remove Answer
                        </button>
                    </div>
                    <div class="panel-body">
                        <div class="manage">
                            <div class="row-word" id='row-0'>
                                <div class="form-group">
                                    {!! Form::label('content', 'Content', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('content-0', old('content-0') ,['class' => 'form-control content']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('correct', 'Correct', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::select('correct-0', $correct, ' ',  ['class' => 'form-control correct', 'placeholder' => 'Choose correct']) !!}
                                    </div>
                                </div>
                                <div class="form-group" id="image-preview">
                                    {!! Form::label('image', 'Image', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">

                                        {!! Form::file('image-0', ['class' => 'form-control image', 'id' => 'image-0']) !!}
                                    </div>
                                </div>
                                <hr/>
                            </div>
                            {!! Form::hidden('total', 0, ['class' => 'total']) !!}
                        </div>
                        <div class="manage-write hidden">
                            <div class="row-word" id='row-0'>
                                <div class="form-group">
                                    {!! Form::label('input-content', 'Input Content', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('input-content-0', old('content-0'), ['class' => 'form-control input-content']) !!}
                                    </div>
                                </div>
                                <hr/>
                            </div>
                            {!! Form::hidden('total-write', 0, ['class' => 'total-write']) !!}
                        </div>
                        <div class="manage-select hidden">
                            <div class="row-select" id="row-select-0">
                                <div class="form-group">
                                    {!! Form::label('input-content', 'Input Content', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('select-content-0', old('select-content-0'), ['class' => 'form-control select-content']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('correct', 'Correct', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::select('select-correct-0', $correct, ' ',  ['class' => 'form-control select-correct', 'placeholder' => 'Choose correct']) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::hidden('total-select', 0, ['class' => 'total-select']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
