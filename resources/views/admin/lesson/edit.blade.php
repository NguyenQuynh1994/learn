<div class="modal fade" id="modalEdit-{{ $lesson->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">
                    Edit lesson
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        {!! Form::label('name', 'Name', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::text('name', isset($lesson->name) ? $lesson->name :old('name'), ['class' => 'form-control', 'id' => 'name-'.$lesson->id]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        {!! Form::label('category_id', 'Category', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::select('category_id', $categories, isset($lesson->category_id) ? $lesson->category_id : old('category_id'), ['class' => 'form-control', 'id' => 'category_id-' . $lesson->id]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        {!! Form::label('description', 'Description', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::textarea('description', isset($lesson->description) ? $lesson->description : old('description'), ['class' => 'form-control textarea', 'id' => 'description-'.$lesson->id]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                    </button>
                    <button type="button"
                        id="btn-edit-lesson"
                        class="btn btn-primary"
                        data-url = "{{ action('Admin\LessonController@update', ['id' => $lesson->id]) }}"
                        data-manage = "{{ action('Admin\LessonController@index') }}"
                        data-id = "{{ $lesson->id }}">
                        Store
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
