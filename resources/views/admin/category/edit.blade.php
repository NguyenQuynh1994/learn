@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="row">
         <!-- page header -->
        <div class="col-lg-12">
            <h1 class="page-header">Edit Category Forms</h1>
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
                    <button class="btn btn-default btn-lg btn-header btn-common" data-url="{{ route('admin.categories.index') }}">
                        Manage Category
                    </button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::open([
                                'method' => 'PUT',
                                'action' => ['Admin\CategoryController@update', $category->id],
                                'class' => 'form-horizontal',
                                'role' => 'form',
                                'files' => true,
                            ]) !!}
                                <div class="form-group">
                                    {!! Form::label('name', 'Name', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('name', isset($category->name) ? $category->name : old('name'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group" id="image-preview">
                                    {!! Form::label('image', 'Image', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::hidden('image_hidden', null, ['id' => 'image_hidden']) !!}
                                        {!! Form::file('image', ['class' => 'form-control']) !!}
                                        <img class="img img-responsive" id="image-url" src="{{ $category->image }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('level_id', 'Level', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::select('level_id', $levels, isset($category->level_id) ? $category->level_id : old('level_id'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description', 'Description', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-md-9">
                                        {!! Form::textarea('description', isset($category->description) ? $category->description : old('description'), ['class' => 'form-control textarea']) !!}
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
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description' );
</script>
@endsection
