@extends('layouts.admin.master')
@section('title','Add Inspection')
@push('stylesheets')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="{{ asset('dist/css/inspection.css') }}">
@endpush
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contacts</h1>
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
                            <input type="text" id="location" class="form-control" name="location">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                            <label for="inputStatus">Choose Location</label>
                            <select class="form-control custom-select" id="location_choose">
                              <option selected disabled>Select one</option>
                              <option>Khalifa Kitchen</option>
                              <option>Store</option>
                              <option>Kitchen</option>
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="findings">Findings Description</label>
                        <textarea id="findings" class="form-control" rows="4" name="findings" placeholder="Type finding or problems"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-3" >
                      <label for="finding_suggestions">Findings Suggestions</label>
                      <div class="finding_suggestions">
                        <ul class="suggestions">
                          @forelse ($findings as $item)
                            <li class="li_suggestions"><span class="t"><i class="fa fa-arrow-right"></i> {{ $item->findings }}</span></li>
                          @empty
                              <li class="li_suggestions"> No Item Found!!!</li>
                          @endforelse
                        </ul>
                      </div>
                    </div>


                    {{-- pca suggestions --}}
                    <div class="col-sm-3">
                        <div class="form-group">
                          <label for="pca">Proposed Corrective Action</label>
                          <textarea id="pca" class="form-control" rows="4" name="pca" placeholder="Type Proposed Corrective Actions..."></textarea>
                        </div>
                      </div>
                      <div class="col-sm-3" >
                        <label for="pca_suggestions">Proposed Corrective Action Suggestions</label>
                        <div class="pca_suggestions">
                          <ul class="pca_suggestionAll">
                            @forelse ($pcas as $item)
                              <li class="li_pca_suggestions"><span class="t"><i class="fa fa-arrow-right"></i> {{ $item->pca }}</span></li>
                            @empty
                                <li class="li_pca_suggestions"> No Item Found!!!</li>
                            @endforelse
                          </ul>
                        </div>
                      </div>
                </div>

              </div>
              <div class="card-footer"></div>
              <!-- /.card-body -->
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
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="accountibility">Accountibility</label>
                            <input type="text" class="form-control" name="accountibility" id="accountibility" placeholder="Accountibility...">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="inputStatus">Choose Accountibility</label>
                            <select class="form-control custom-select" id="accountibility1">
                                <option selected disabled>Select one</option>
                                <option>Production Department</option>
                                <option>Store</option>
                                <option>Maintenance</option>
                                <option>Stewarding Supervisor</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="datepicker1">Date</label>
                            <div class='input-group date' id='datetimepicker1' >
                                <input type="text" class="datepicker1" name="start_date">
                            </div>
                        </div> 
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="datepicker">Closing Date</label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type="text" class="datepicker" name="closing_date">
                            </div>
                        </div>
                      </div>
                  </div>
                


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
              <!-- /.card-body -->
              <div class="card-footer"></div>
            </div>
            
            <!-- /.card -->
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
  @endpush