@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4> Lesson << {{ $category_name }}</h4></div>
                    <div class="panel-body">
                        @include('common.flash_message')
                        <div class="row">
                            @foreach($lessons as $lesson)
                                <div class="col-lg-3">
                                    <div class="thumbnail">
                                        <h3>{{ $lesson->name }}</h3>
                                        {!! Form::open(['method' => 'GET', 'action' => ['ClientController@word', 'id' => $lesson->id]]) !!}
                                            {!! Form::submit('Start Lesson', ['class' => 'btn btn-info']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="alert alert-info" role="alert" align="center">
                            <h3> Ngữ pháp và ghi chú</h3>
                            <span>{!! $lesson->category->description !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
