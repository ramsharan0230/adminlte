@extends('layouts.admin.master')
@section('title','Add Inspection')
@push('stylesheets')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="{{ asset('dist/css/inspection.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/file.css') }}">
  
@endpush
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Inspection</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Add Inspection</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- Main content -->
     <section class="content">
      <form action="{{ route('inspection.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-8">
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
                            <label for="location">Location</label>
                            <input type="text" id="location" class="form-control" name="location" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                            <label for="inputStatus">Choose Location</label>
                            <select class="form-control custom-select" id="location_choose">
                              <option selected disabled>Select one</option>
                              @forelse($locations as $prepend)
                              <option>{{ $prepend->location }}</option>
                              @empty
                              <option value="">No Item Found!!</option>
                              @endforelse
                            </select>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label for="findings">Findings Description</label>
                        <textarea id="findings" class="form-control" rows="4" name="findings" placeholder="Type finding or problems" autocomplete="off"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-4" >
                      <label for="finding_suggestions">Findings Suggestions</label>
                      <div class="finding_suggestions">
                        <ul class="suggestions">
                          @forelse($findings as $prepend)
                            <li class="li_suggestions"><span class="t"><i class="fa fa-arrow-right"></i> {{ $prepend->findings }}</span></li>
                          @empty
                              <li class="li_suggestions"> No Item Found!!!</li>
                          @endforelse
                        </ul>
                      </div>
                    </div>


                    {{-- pca suggestions --}}
                    <div class="col-sm-8">
                        <div class="form-group">
                          <label for="pca">Proposed Corrective Action</label>
                          <textarea id="pca" class="form-control" rows="4" name="pca" placeholder="Type Proposed Corrective Actions..." autocomplete="off"></textarea>
                        </div>
                      </div>
                      <div class="col-sm-4" >
                        <label for="pca_suggestions">Proposed Corrective Action Suggestions</label>
                        <div class="pca_suggestions">
                          <ul class="pca_suggestionAll">
                            @forelse($pcas as $prepend)
                              <li class="li_pca_suggestions"><span class="t"><i class="fa fa-arrow-right"></i> {{ $prepend->pca }}</span></li>
                            @empty
                                <li class="li_pca_suggestions"> No Item Found!!!</li>
                            @endforelse
                          </ul>
                        </div>
                      </div>

                      {{-- accountibility start --}}
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
                                  @forelse($accountibilities as $prepend)
                                  <option>{{ $prepend->accountibility }}</option>
                                  @empty
                                  @endforelse
                              </select>
                          </div>
                      </div>
                {{-- accountibility end --}}
                  </div>
                {{-- pca ends --}}

                
                <!-- /.card -->

              </div>
              <!-- /.card-body -->
              <div class="card-footer"></div>

            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-4">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Choose Date</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="datepicker1">Date</label>
                            <div class='input-group date' id='datetimepicker1' >
                                <input type="text" class="datepicker1 form-control" name="start_date" autocomplete="off">
                            </div>
                        </div> 
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                            <label for="datepicker">Closing Date</label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type="text" id="datepicker" class="datepicker form-control" name="closing_date" autocomplete="off">
                            </div>
                        </div>
                      </div>
                  </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer"></div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  Upload Inspection Files
                </h3>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="form-group">
                    <label for="upload_imgs" class="button hollow">Select Your Images: </label>
                    <input class="show-for-sr" type="file" id="upload_imgs" name="upload_ins[]" multiple/>
                    <div class="quote-imgs-thumbs quote-imgs-thumbs--hidden" id="img_preview" aria-live="polite"></div>
                  </div>

                  <div class="form-group">

                    <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group">
                              <label for="publish"><input type="checkbox" name="publish"> Publish</label>
                          </div>
                      </div>
  
                      <div class="col-12">
                          <input type="submit" value="Create new Inspection" class="btn btn-success btn-sm">
                      </div>
                  </div>
                  </div>
                </div>
              </div>
              <div class="card-footer"></div>
            </div>
          </div>
        </div>
        
      </form>
      </section>
      <!-- /.content -->

      @endsection

  @push('scripts')
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="{{ asset('dist/js/inspection.js') }}"></script>
  <script src="{{ asset('dist/js/file.js') }}"></script>
  @endpush