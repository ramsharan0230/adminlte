@push('stylesheets')
  <link rel="stylesheet" href="{{ asset('dist/css/file.css') }}">
@endpush
<div class="modal fade" id="edit-inspection-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title">Edit Inspection</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
      
        <div class="modal-body">
            <section class="content">
                <form action="{{ route('inspection.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">General Informations</h3>
            
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="hidden" name="editInspectionId" id="inspectionFoundId">
                                    <label for="location">Location</label>
                                    <input type="text" id="location" class="form-control" name="location" autocomplete="off">
                                </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="inputStatus">Choose Location</label>
                                    <select class="form-control custom-select" id="location_choose">
                                        <option selected disabled>Select one</option>
                                        @forelse($prepends as $prepend)
                                        <option>{{ $prepend->location }}</option>
                                        @empty
                                        <option value="">No Item Found!!</option>
                                        @endforelse
                                    </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label for="findings">Findings Description</label>
                                <textarea id="findings" class="form-control" rows="4" name="findings" placeholder="Type finding or problems" autocomplete="off"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6" >
                                <label for="finding_suggestions">Findings Suggestions</label>
                                <div class="finding_suggestions">
                                <ul class="suggestions">
                                    @forelse($prepends as $prepend)
                                    <li class="li_suggestions"><span class="t"><i class="fa fa-arrow-right"></i> {{ $prepend->findings }}</span></li>
                                    @empty
                                        <li class="li_suggestions"> No Item Found!!!</li>
                                    @endforelse
                                </ul>
                                </div>
                            </div>
        
        
                            {{-- pca suggestions --}}
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pca">Proposed Corrective Action</label>
                                    <textarea id="pca" class="form-control" rows="4" name="pca" placeholder="Type Proposed Corrective Actions..." autocomplete="off"></textarea>
                                </div>
                                </div>
                                <div class="col-sm-6" >
                                <label for="pca_suggestions">Proposed Corrective Action Suggestions</label>
                                <div class="pca_suggestions">
                                    <ul class="pca_suggestionAll">
                                    @forelse($prepends as $prepend)
                                        <li class="li_pca_suggestions"><span class="t"><i class="fa fa-arrow-right"></i> {{ $prepend->pca }}</span></li>
                                    @empty
                                        <li class="li_pca_suggestions"> No Item Found!!!</li>
                                    @endforelse
                                    </ul>
                                </div>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="accountibility">Accountibility</label>
                                        <input type="text" class="form-control" name="accountibility" id="accountibility" placeholder="Accountibility..." autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputStatus">Choose Accountibility</label>
                                        <select class="form-control custom-select" id="accountibility1">
                                            <option selected disabled>Select one</option>
                                            @forelse($prepends as $prepend)
                                            <option>{{ $prepend->accountibility }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="datepicker1">Date</label>
                                        <div class='input-group date' id='datetimepicker1' >
                                            <input type="text" class="datepicker1" name="start_date" autocomplete="off">
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="datepicker">Closing Date</label>
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type="text" class="datepicker" name="closing_date" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="editStatus">Status</label>
                                        <select name="status" id="editStatus" class="form-control form-control-sm">
                                            <option selected disabled>Select Status</option>
                                            <option value="1">Open</option>
                                            <option value="0">Close</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="jumbotron col-sm-12">
                                    <div class="form-group">
                                    <label for="upload_imgs" class="button hollow">Select Your Images: </label>
                                    <input class="show-for-sr" type="file" id="upload_imgs" name="upload_ins[]" multiple/>
                                    <div class="quote-imgs-thumbs quote-imgs-thumbs--show" id="img_preview" aria-live="polite">
                                    </div>
                                    </div>
                                </div>
                            </div>
        
                        </div>
                        <div class="card-footer">
                            <div class="col-12">
                                <input type="submit" value="Update Inspection" class="btn btn-success btn-sm">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                
                </form>
            </section>
        </div>

      </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('dist/js/file.js') }}"></script>
@endpush
    