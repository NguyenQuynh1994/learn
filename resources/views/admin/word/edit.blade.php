@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="row">
         <!-- page header -->
        <div class="col-lg-12">
            <h1 class="page-header">Edit LessonWord Forms</h1>
        </div>
        <!--end page header -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
                {!! Form::open([
                    'method' => 'PUT',
                    'action' => ['Admin\LessonWordController@update', 'id'  => $lessonWord->id],
                    'class' => 'form-horizontal frmAdminLessonWord',
                    'files' => true,
                ]) !!}
                    <div class="panel-heading">
                        <button class="btn-back btn btn-default btn-lg btn-header" id="btn-back">
                            Back
                        </button>
                        {!! Form::submit('Save', ['class' => 'btn btn-info btn-lg btn-header']) !!}
                        @include('common.flash_message')
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            @include('common.errors')
                            <div class="form-group">
                                {!! Form::label('category_id', 'Category', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::select('category_id', $categories, $lessonWord->lesson->category->id, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('lesson_id', 'Lesson', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::select('lesson-id', $chooseLesson, $lessonWord->lesson->id, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('type', 'type', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::select('type', $type, $lessonWord->type, ['class' => 'form-control type', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('content', 'Content', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('content', $lessonWord->content, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            @if ($lessonWord->type == 4)
                                <div class="form-group">
                                    {!! Form::label('last_content', 'Last Content', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('last_content', $lessonWord->last_content, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                {!! Form::close() !!}
                <div class="panel-heading">
                    <button class="btn-back btn btn-success btn-lg btn-header" data-toggle="modal" data-target="#modalCreateAnswer">
                        New Answer
                    </button>
                    @include('admin.word.createAnswer')
                </div>
                @if (count($answers))
                    <div class="panel-body form-horizontal">
                        <table class="table table-bordered table-striped table-responsive table-grid">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Correct</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($answers as $answer)
                                    <tr>
                                        <td>{{ $answer->id }}</td>
                                        <td>{{ isset($answer->content) ? $answer->content : '' }}</td>
                                        <td>
                                            @if(isset($answer->image) & !empty($answer->image))
                                                <img src="{{ $answer->image }}" class="img-row">
                                            @endif
                                        </td>
                                        <td>{{ ($answer->correct) ? 'true' : 'false' }}</td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#modalEdit-{{ $answer->id }}" class="btn btn-info">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </button>
                                            @include('admin.word.editAnswer')
                                        </td>
                                        <td>
                                            <a href="{{ action('Admin\LessonWordController@deleteAnswer', ['id' => $answer->id])}}" class="btn btn-info btn-common">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
