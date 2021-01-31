@extends('layouts.admin.master')
@section('title','Add Inspection')
@push('stylesheets')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
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
                            <label for="inputName">Locations</label>
                            <input type="text" id="inputName" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                            <label for="inputStatus">Choose Location</label>
                            <select class="form-control custom-select">
                              <option selected disabled>Select one</option>
                              <option>Khalifa Kitchen</option>
                              <option>Store</option>
                              <option>Kitchen</option>
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputDescription">Findings Description</label>
                        <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputDescription">Proposed Corrective Actions</label>
                          <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group">
                            <label for="inputStatus">Accountibility</label>
                            <input type="text" class="form-control" placeholder="Accountibility...">
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="inputStatus">Choose Accountibility</label>
                            <select class="form-control custom-select">
                                <option >Select one</option>
                                <option>Production Department</option>
                                <option>Store</option>
                                <option>Maintenance</option>
                                <option>Stewarding Supervisor</option>
                            </select>
                        </div>
                    </div>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-4">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Choose Image</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label for="datepicker">Date</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type="text" class="datepicker">
                        </div>
                    </div> 
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label for="datepicker">Closing Date</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type="text" class="datepicker">
                        </div>
                    </div>
                    </div>
                </div>
                
                <div class="form-group">
                  <label for="picture">Choose Inspection File</label>
                  <input type="file" id="picture" class="form-control">
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <input type="submit" value="Create new Porject" class="btn btn-success float-right">
          </div>
        </div>
      </section>
      <!-- /.content -->

      @endsection

  @push('scripts')
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker(
        { dateFormat: 'yy-mm-dd' }
    );
  } );
  </script>
  @endpush