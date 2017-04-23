@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Create Post</h4></div>
                    <div class="panel-body">
                    @include('common.flash_message')
                        @foreach($posts as $post)
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ url($post->user->avatar) }}" class="img-circle" style="height: 50px; width: 50px; margin-left: 50px;">
                                </div>
                                <div class="col-md-10" style="padding: 0px 10px 10px 0px; list-style-type: none;">
                                    <h4>
                                        <a href="{{ action('ClientController@showPost', ['id' => $post->id]) }}" class="username-comment">
                                            <p> {{ $post->title }}</p>
                                        </a>
                                        <h5> {{ $post->created_at->diffForHumans() }}</h5>
                                    </h4>
                                    <div class="fb-like" data-href="{{ action('ClientController@showPost', [$post->id]) }}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
