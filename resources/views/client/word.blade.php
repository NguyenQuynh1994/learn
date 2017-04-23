@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Lesson: {{ $word->lesson->name }} << {{ session()->get('categoryName') }}</div>
                    <div class="panel-body">
                    {{-- {!! Form::open(['method' => 'POST', 'action' => 'ClientController@result']) !!} --}}
                        {!! Form::hidden('type', $word->type, ['class' => 'word-type']) !!}
                        {!! Form::hidden('word_id', $word->id, ['id' => 'word-id']) !!}
                        {!! Form::hidden('lesson_word_id', session()->get('lesson_id'), ['id' => 'lesson-id']) !!}
                        {!! Form::hidden('index', session()->get('index'), ['id' => 'index']) !!}
                        {!! Form::hidden('correct', session()->get('correct'), ['id' => 'correct']) !!}
                        @if ($word->type == 1)
                            <div class="row">
                                <h4>Chọn nghĩa của từ : {{ $word->content }}</h4>
                            </div>
                            @foreach($answers as $answer)
                                <div class="col-lg-3">
                                    <div class="thumbnail">
                                        <div class="radio">
                                            <label>
                                                {!! Form::radio('answer_id', $answer->id) !!}
                                                <h3>{{ $answer->content }}</h3>
                                            </label>
                                        </div>

                                        <img src="{{ $answer->image }}">
                                    </div>
                                </div>
                            @endforeach
                        @elseif($word->type == 2)
                            <div class="row">
                                <h4>Chọn nghĩa của từ : {{ $word->content }}</h4>
                            </div>
                            @foreach($answers as $answer)
                                <div class="col-lg-3">
                                    <div class="thumbnail">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('answer_ids[]', $answer->id) !!}
                                                <h3>{{ $answer->content }}</h3>
                                            </label>
                                        </div>

                                        <img src="{{ $answer->image }}">
                                    </div>
                                </div>
                            @endforeach
                        @elseif($word->type == 3)
                            <div class="row col-md-8">
                                <h4>Nhap nghia dung cho từ : {{ $word->content }}
                                    <div class="form-group">
                                        {!! Form::text('answer', old('answer'), ['class' => 'form-control input-answer']) !!}
                                    </div>
                                </h4>
                            </div>
                        @else
                            <div class="row col-md-8">
                                <h4>Chọn từ con thieu : </br>
                                    <h4>
                                    {{ $word->content }}
                                    {!! Form::select('select_answer', $optionAnswers, old('select_answer'), ['class' => 'form-control select-answer col-md-2']) !!}
                                    {{ $word->last_content }}
                                    </h4>
                                </h4>
                            </div>
                        @endif
                        <div class="row col-md-8">
                            <button class="btn btn-info done">Done</button>
                            <button class="btn btn-info next hidden" data-url="{{ action('ClientController@word', ['id' => session()->get('lesson_id')]) }}">Next</button>
                           {{--  {!! Form::submit('Next', ['class' => 'btn btn-info next hidden']) !!} --}}
                        </div>
                        <div class="row col-md-8">
                            @include('common.result')
                        </div>
                     {{-- {!! Form::close() !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
