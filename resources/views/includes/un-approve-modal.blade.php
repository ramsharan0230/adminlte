<div class="modal fade" id="un-approve-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="form" action="{{ route('sitemanager.review.store') }}" method="POST">
            @csrf
            <div class="modal-header">
            <h4 class="modal-title">Add Your Comment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{$error}}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="hidden" id="inspection_id" name="inspection_id">
                            <label for="comment">Comments</label>
                            <textarea required name="comments" class="form-control form-control-sm" id="comment" cols="30" rows="10" placeholder="Type your comments here..."></textarea>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>