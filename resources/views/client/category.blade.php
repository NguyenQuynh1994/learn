@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Category</h4></div>
                    <div class="panel-body">
                    @include('common.flash_message')
                    @foreach($levels as $level)
                        @if ($level->pivot->status == 0)
                            <div class='row'>
                                <div class="alert alert-warning" role="alert" align="center">
                                    <h4>{{ $level->name }}</h4>
                                </div>
                                <div class="panel-body">
                                    @foreach($level->categories as $category)
                                        <div class="col-lg-3">
                                            <div class="thumbnail">
                                                <h3>{{ $category->name }}</h3>
                                                <img src="{{ $category->image }}">
                                                {!! Form::open(['method' => 'POST', 'url' => 'lesson']) !!}
                                                    {!! Form::hidden('categoryId', $category->id) !!}
                                                    {!! Form::hidden('categoryName', $category->name) !!}
                                                    {!! Form::submit('Start Learn', ['class' => 'btn btn-info', 'disabled' => 'disabled']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class='row'>
                                <div class="alert alert-info" role="alert" align="center">
                                    <h4>{{ $level->name }}</h4>
                                </div>
                                <div class="panel-body">
                                    @foreach($level->categories as $category)
                                        <div class="col-lg-3">
                                            <div class="thumbnail">
                                                <h3>{{ $category->name }}</h3>
                                                <img src="{{ $category->image }}">
                                                {!! Form::open(['method' => 'POST', 'url' => 'lesson']) !!}
                                                    {!! Form::hidden('categoryId', $category->id) !!}
                                                    {!! Form::hidden('categoryName', $category->name) !!}
                                                    {!! Form::submit('Start Learn', ['class' => 'btn btn-info']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
