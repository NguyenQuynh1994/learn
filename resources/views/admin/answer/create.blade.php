@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="row">
         <!-- page header -->
        <div class="col-lg-12">
            <h1 class="page-header">Create Answer Forms</h1>
        </div>
        <!--end page header -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn-back btn btn-default btn-lg btn-header" id="btn-back">
                        Back
                    </button>
                    <button class="btn btn-default btn-lg btn-header" id="btn-common" data-url="{{ route('admin.answers.index') }}">
                        Manage Answer
                    </button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::open([
                                'method' => 'POST',
                                'action' => ['Admin\AnswerController@store'],
                                'class' => 'form-horizontal',
                                'role' => 'form',
                                'files' => true,
                            ]) !!}
                                <div class="form-group">
                                    {!! Form::label('category_id', 'Category', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control', 'id' => 'category_id_create_lesson', 'placeholder' => 'Please choose category']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('lesson_id', 'Lesson', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        <label>
                                            <select name="lessonword-correct" id="lessonword-correct" class="lessonword-correct form-control">
                                                <option value="">Choose category before choose lesson</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('lesson_word_id', 'LessonWord', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        <label>
                                            <select name="lesson_word_id" id="lesson_word_id" class="form-control">
                                                <option value="">Choose lesson before choose lessonword</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('content', 'Content', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('content', old('content'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('correct', 'Correct', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::select('correct', $correct, old('correct'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group" id="image-preview">
                                    {!! Form::label('image', 'Image', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::hidden('image_hidden', null, ['id' => 'image_hidden']) !!}
                                        {!! Form::file('image', ['class' => 'form-control']) !!}
                                        <img class="img img-responsive" id="image-url" src="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-7 col-md-offset-3">
                                        {!! Form::submit('Store', ['class' => 'btn btn-info']) !!}
                                        {!! Form::reset('Reset', ['class' => 'btn btn-default']) !!}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
