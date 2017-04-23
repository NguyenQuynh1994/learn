@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="row">
         <!-- page header -->
        <div class="col-lg-12">
            <h1 class="page-header">Edit Answer Forms</h1>
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
                    <button class="btn btn-default btn-lg btn-header btn-common" data-url="{{ route('admin.answers.index') }}">
                        Manage Answer
                    </button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::open([
                                'method' => 'PUT',
                                'action' => ['Admin\AnswerController@update', $answer->id],
                                'class' => 'form-horizontal',
                                'role' => 'form',
                                'files' => true,
                            ]) !!}
                                <div class="form-group">
                                    {!! Form::label('content', 'Content', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('content', isset($answer->content) ? $answer->content : old('content'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('correct', 'Correct', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::select('correct', $correct, isset($answer->content) ? $answer->content : old('correct'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group" id="image-preview">
                                    {!! Form::label('image', 'Image', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::hidden('image_hidden', null, ['id' => 'image_hidden']) !!}
                                        {!! Form::file('image', ['class' => 'form-control']) !!}
                                        <img class="img img-responsive" id="image-url" src="{{ $answer->image }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('lesson_word_id', 'LessonWord', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::select('lesson_word_id', $words, isset($answer->lesson_word_id) ? $answer->lesson_word_id : old('lesson_word_id'), ['class' => 'form-control']) !!}
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
