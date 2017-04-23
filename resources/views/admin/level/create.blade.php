<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">
                    Create level
                </h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Name</label>
                    <div class="col-md-8 form-group">
                        <input class="form-control" id="name_level" type="text" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">No</label>
                    <div class="col-md-8 form-group">
                        <input class="form-control" id="no_level" type="text" value="{{ old('no') }}">
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                    </button>
                    <button type="button"
                        id="btn-create-level"
                        class="btn btn-primary"
                        data-url = "{{ action('Admin\LevelController@store') }}"
                        data-manage = "{{ action('Admin\LevelController@index') }}">
                        Store
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
