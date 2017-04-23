@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
<div class="row">
     <!--  page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Answer Manage</h1>
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
                    data-url="{{ route('admin.answers.create') }}">
                    Create
                </button>
                <button id="btn-deletes" type="button"
                    class="btn btn-default btn-lg btn-header"
                    data-url="{{ route('admin.answers.destroy', ['id' => 1]) }}">
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
                                <th>Image</th>
                                <th>LessonWord</th>
                                <th>Correct</th>
                                <th>Edit</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($answers as $key => $answer)
                                <tr id = 'row-{{ $answer->id }}'>
                                <td>
                                    {!! Form::checkbox('select', $answer->id, false, ['class' => 'select']) !!}
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $answer->id }}</td>
                                <td>{{ isset($answer->content) ? $answer->content : '' }}</td>
                                <td>
                                    <img src="{{ $answer->image }}" class="img-row">
                                </td>
                                <td>{{ isset($answer->lesson_word_id) ? $answer->lessonWord->content : '' }} < {{ $answer->lessonWord->lesson->name }} ></td>
                                <td>{{ ($answer->correct) ? 'true' : 'false' }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-common" data-url="{{ route('admin.answers.edit', [$answer->id]) }}">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-common" data-url="{{ route('admin.answers.show', [$answer->id]) }}">
                                        <i class="glyphicon glyphicon-share"></i>
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
