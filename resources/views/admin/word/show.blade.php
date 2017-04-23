<div class="modal fade" id="myModal-{{ $word->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">
                    Detail of LessonWord
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        {!! Form::label('content', 'Content :', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::label('content', isset($word->content) ? $word->content : '', ['class' => 'control-label',]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        {!! Form::label('lesson_id', 'Lesson :', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::label('lesson', isset($word->lesson_id) ? $word->lesson->name : '', ['class' => 'control-label',]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    CLose
                </button>
            </div>
        </div>
    </div>
</div>
