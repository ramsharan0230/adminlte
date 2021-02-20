<div class="modal fade" id="edit-status-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title">Edit Status</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
      
        <div class="modal-body">
            <section class="content">
                <form action="{{ route('inspection.update.status') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="hidden" name="inspection_id" id="inspect_id">
                                    <label for="editOnlyStatus">Status</label>
                                    <select name="status" id="editOnlyStatus" class="form-control form-control-sm">
                                        <option selected disabled>Select Status</option>
                                        <option value="1">Open</option>
                                        <option value="0">Close</option>
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-12">
                            <input type="submit" value="Update Status" class="btn btn-success btn-sm">
                        </div>
                    </div>
        
                </div>
                
                </form>
            </section>
        </div>

      </div>
    </div>
</div>
    