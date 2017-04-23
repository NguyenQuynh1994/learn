<div class="modal fade" id="modalEdit-{{ $answer->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">
                    Edit Answer
                </h3>
            </div>
            {!! Form::open([
                'method' => 'POST',
                'action' => 'Admin\LessonWordController@updateAnswer',
                'class' => 'form-horizontal',
                'files' => true,
            ]) !!}
            <div class="modal-body">
                @if ($lessonWord->type == 1 || $lessonWord->type == 2)
                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('content', 'Content', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('content', isset($answer->content) ? $answer->content : old('content') ,['class' => 'form-control content']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('correct', 'Correct', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('correct', $correct, isset($answer->correct) ? $answer->correct : old('correct'),  ['class' => 'form-control correct', 'placeholder' => 'Choose correct']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" id="image-preview">
                            {!! Form::label('image', 'Image', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::hidden('image_hidden', null, ['id' => 'image_hidden']) !!}
                                {!! Form::file('image', ['class' => 'form-control']) !!}
                                <img class="img img-responsive" id="image-url" src="{{ $answer->image }}">
                            </div>
                        </div>
                    </div>
                @elseif ($lessonWord->type == 3)
                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('content', 'Content', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('input-content', isset($answer->content) ? $answer->content : old('input-content') ,['class' => 'form-control content']) !!}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('select-content', 'Content', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('select-content', isset($answer->content) ? $answer->content : old('select-content') ,['class' => 'form-control content']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('select-correct', 'Correct', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('select-correct', $correct, isset($answer->correct) ? $answer->correct : old('select-correct'),  ['class' => 'form-control correct', 'placeholder' => 'Choose correct']) !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                    </button>
                    {!! Form::hidden('type', $lessonWord->type) !!}
                    {!! Form::hidden('id', $answer->id) !!}
                    {!! Form::hidden('lesson_word_id', $lessonWord->id) !!}
                    {!! Form::submit('Store', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
