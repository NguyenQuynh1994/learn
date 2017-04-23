@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
<div class="row">
     <!--  page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Level Manage</h1>
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
                @include('admin.level.create')
                {{-- <button id="btn-create" type="button"
                    class="btn btn-default btn-lg btn-header"
                    data-url="{{ route('admin.levels.create') }}">
                    Create
                </button> --}}
                <button id="btn-deletes" type="button"
                    class="btn btn-default btn-lg btn-header"
                    data-url="{{ route('admin.levels.destroy', ['id' => 1]) }}">
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
                                <th>No</th>
                                <th>Edit</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($levels as $key => $level)
                                <tr id = 'row-{{ $level->id }}'>
                                <td>
                                    {!! Form::checkbox('select', $level->id, false, ['class' => 'select']) !!}
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $level->id }}</td>
                                <td>{{ $level->name }}</td>
                                <td>{{ $level->no }}</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#modalEdit-{{ $level->id }}" class="btn btn-info">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    @include('admin.level.edit')
                                </td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#myModal-{{ $level->id }}" class="btn btn-info">
                                        <i class="glyphicon glyphicon-share"></i>
                                    </button>
                                    @include('admin.level.show')
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
@endsection
