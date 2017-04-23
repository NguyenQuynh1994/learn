<div class="modal fade" id="modalEdit-{{ $level->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">
                    Edit level
                </h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Name</label>
                    <div class="col-md-8 form-group">
                        <input class="form-control" name="name" type="text" value={{ $level->name }} id="name-{{ $level->id }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">No</label>
                    <div class="col-md-8 form-group">
                        <input class="form-control" name="no" type="text" value={{ $level->no }} id="no-{{ $level->id }}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button"
                    class="btn btn-primary btn-edit-level"
                    data-url = "{{ action('Admin\LevelController@update', ['id' => $level->id]) }}"
                    data-manage = "{{ action('Admin\LevelController@index') }}"
                    data-id = "{{ $level->id }}">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>
