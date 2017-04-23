@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
<div class="row">
     <!--  page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Category Manage</h1>
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
                    data-url="{{ route('admin.categories.create') }}">
                    Create
                </button>
                <button id="btn-deletes" type="button"
                    class="btn btn-default btn-lg btn-header"
                    data-url="{{ route('admin.categories.destroy', ['id' => 1]) }}">
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
                                <th>Image</th>
                                <th>Level</th>
                                <th>Edit</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr id = 'row-{{ $category->id }}'>
                                <td>
                                    {!! Form::checkbox('select', $category->id, false, ['class' => 'select']) !!}
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $category->id }}</td>
                                <td>{{ isset($category->name) ? $category->name : '' }}</td>
                                <td>
                                    <img src="{{ $category->image }}" class="img-row">
                                </td>
                                <td>{{ isset($category->level->name) ? $category->level->name : '' }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-common" data-url="{{ route('admin.categories.edit', [$category->id]) }}">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-common" data-url="{{ route('admin.categories.show', [$category->id]) }}">
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
