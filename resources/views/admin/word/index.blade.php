@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
<div class="row">
     <!--  page header -->
    <div class="col-lg-12">
        <h1 class="page-header">LessonWord Manage</h1>
    </div>
     <!-- end  page header -->
</div>
<div class="row">
    <div class="col-lg-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <button type="button" class="btn btn-default btn-lg btn-header select-all">
                    Select All
                </button>
                <button id="btn-create" type="button"
                    class="btn btn-default btn-lg btn-header"
                    data-url="{{ route('admin.lessonWords.create') }}">
                    Create
                </button>
                <button id="btn-deletes" type="button"
                    class="btn btn-default btn-lg btn-header"
                    data-url="{{ route('admin.lessonWords.destroy', ['id' => 1]) }}">
                    Delete
                </button>
                @include('common.flash_message')
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr><th>All</th>
                                <th>Index</th>
                                <th>ID</th>
                                <th>Content</th>
                                <th>Lesson</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($words as $key => $word)
                                <tr id = 'row-{{ $word->id }}'>
                                <td>
                                    {!! Form::checkbox('select', $word->id, false, ['class' => 'select']) !!}
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $word->id }}</td>
                                <td>{{ $word->content }}</td>
                                <td>{{ isset($word->lesson->name) ? ($word->lesson->name) : '' }} < {{ isset($word->lesson->category->name) ? $word->lesson->category->name : '' }} ></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-common" data-url="{{ route('admin.lessonWords.edit', [$word->id]) }}">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
@endsection
