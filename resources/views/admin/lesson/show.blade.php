<div class="modal fade" id="myModal-{{$lesson->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">
                    Detail of Lesson
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="form-group col-md-12">
                    {!! Form::label('name', 'Name :', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-8">
                        {!! Form::label('lesson_name', isset($lesson->name) ? $lesson->name : '', ['class' => 'control-label',]) !!}
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group col-md-12">
                    {!! Form::label('category', 'Category :', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-8">
                        {!! Form::label('lesson_category', isset($lesson->category_id) ? $lesson->category->name : '', ['class' => 'control-label',]) !!}
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group col-md-12">
                    {!! Form::label('description', 'Description :', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-8">
                        {!! Form::label('lesson_description', isset($lesson->description) ? $lesson->description : '', ['class' => 'control-label',]) !!}
                    </div>
                </div>
                </div>
                {{-- <div class="form-group">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-md-6">
                        <input class="form-control" name="content" type="text" value={{ $level->name}} disabled>
                    </div>
                </div> --}}
                {{-- <div class="form-group">
                    <label class="col-md-3 control-label">No</label>
                    <div class="col-md-6">
                        <input class="form-control" name="content" type="text" value={{ $level->no}} disabled>
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    CLose
                </button>
            </div>
        </div>
    </div>
</div>
