<div class="modal fade" id="review-list-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('inspection.picture.add') }}" method="GET">
          <div class="modal-header">
            <h4 class="modal-title">Reviews</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 reviews">
                    
                </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary float-right btn-sm" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>