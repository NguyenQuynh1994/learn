<div class="modal fade bs-example-modal-lg" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">
                    Create lesson
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        {!! Form::label('name', 'Name', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        {!! Form::label('category_id', 'Category', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control', 'id' => 'category_id']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        {!! Form::label('description', 'Description', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::textarea('description', old('description'), ['class' => 'form-control textarea', 'id' => 'description']) !!}
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
                        id="btn-create-lesson"
                        class="btn btn-primary"
                        data-url = "{{ action('Admin\LessonController@store') }}"
                        data-manage = "{{ action('Admin\LessonController@index') }}">
                        Store
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
