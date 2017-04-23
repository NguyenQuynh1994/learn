@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="row">
         <!-- page header -->
        <div class="col-lg-12">
            <h1 class="page-header">Detail Category</h1>
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
                            <div class="form-group row">
                                {!! Form::label('name', 'Name :', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-6">
                                    {!! isset($category->name) ? $category->name : '' !!}
                                </div>
                            </div>
                            <div class="form-group row" id="image-preview">
                                {!! Form::label('image', 'Image :', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::hidden('image_hidden', null, ['id' => 'image_hidden']) !!}
                                    <img class="img img-responsive" id="image-url" src="{{ $category->image }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('level_id', 'Level :', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-6">
                                    {!! isset($category->level_id) ? $category->level->name : '' !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('description', 'Description :', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-6">
                                    {!! isset($category->description) ? $category->description : '' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
