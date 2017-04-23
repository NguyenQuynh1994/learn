@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Topic thao luan</h4></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ url($post->user->avatar) }}" class="img-circle" style="height: 50px; width: 50px; margin-left: 50px;">
                            </div>
                            <div class="col-md-10" style="padding: 0px 10px 10px 0px; list-style-type: none;">
                                <h3>{{ $post->title }}</h3>
                                <h4>{{ $post->created_at->diffForHumans() }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                @if(!empty($post->image))
                                    <img src="{{ url($post->image) }}" alt="">
                                @endif
                            </div>
                            <div class="col-md-10" style="padding: 0px 10px 10px 0px; list-style-type: none;">
                                <p> {!! $post->content !!}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <div class="fb-like" data-href="{{ action('ClientController@showPost', [$post->id]) }}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <div class="fb-comments" data-href="{{ action('ClientController@showPost', ['id' => $post->id]) }}" data-width="560" data-include-parent="false">
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
