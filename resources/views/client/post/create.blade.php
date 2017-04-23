@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Create Post</h4></div>
                    <div class="panel-body">
                    @include('common.flash_message')
                        <div class="row">
                        <div class="col-lg-12">
                            {!! Form::open([
                                'method' => 'POST',
                                'action' => ['ClientController@storePost'],
                                'class' => 'form-horizontal',
                                'role' => 'form',
                                'files' => true,
                            ]) !!}
                                <div class="form-group">
                                    {!! Form::label('title', 'Title', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('content', 'Content', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-md-9">
                                        {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group" id="image-preview">
                                    {!! Form::label('image', 'Image', ['class' => 'col-md-2 control-label']) !!}
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
</div>
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
@endsection
