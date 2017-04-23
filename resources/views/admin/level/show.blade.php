<div class="modal fade" id="myModal-{{$level->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">
                    Detail of level
                </h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-md-6">
                        <input class="form-control" name="content" type="text" value={{ $level->name}} disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">No</label>
                    <div class="col-md-6">
                        <input class="form-control" name="content" type="text" value={{ $level->no}} disabled>
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
