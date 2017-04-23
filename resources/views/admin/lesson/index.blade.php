@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
<div class="row">
     <!--  page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Lesson Manage</h1>
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
                <button type="button" data-toggle="modal" data-target="#modalCreate" class="btn btn-default btn-lg btn-header">
                    Create
                </button>
                @include('admin.lesson.create')
                {{-- <button id="btn-create" type="button"
                    class="btn btn-default btn-lg btn-header"
                    data-url="{{ route('admin.levels.create') }}">
                    Create
                </button> --}}
                <button id="btn-deletes" type="button"
                    class="btn btn-default btn-lg btn-header"
                    data-url="{{ route('admin.lessons.destroy', ['id' => 1]) }}">
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Edit</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessons as $key => $lesson)
                                <tr id = 'row-{{ $lesson->id }}'>
                                <td>
                                    {!! Form::checkbox('select', $lesson->id, false, ['class' => 'select']) !!}
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $lesson->id }}</td>
                                <td>{{ $lesson->name }}</td>
                                <td>{{ $lesson->description }}</td>
                                <td>{{ $lesson->category->name }}</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#modalEdit-{{ $lesson->id }}" class="btn btn-info">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    @include('admin.lesson.edit')
                                </td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#myModal-{{ $lesson->id }}" class="btn btn-info">
                                        <i class="glyphicon glyphicon-share"></i>
                                    </button>
                                    @include('admin.lesson.show')
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
