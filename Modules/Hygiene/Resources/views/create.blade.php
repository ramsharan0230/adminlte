@extends('layouts.admin.master')
@section('title','Add Inspection')
@push('stylesheets')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
    div.finding_suggestions {
      overflow-y:scroll; 
      overflow-x:hidden; 
      height:110px; 
      border: 2px solid gray; 
      border-radius: 5px;
    }

    ul.suggestions {
      list-style-type: none;
      margin-left: -22px;
    }

    .suggestions li{
      cursor: pointer;
      margin-bottom: 0px;
    }

    .li_suggestions {
      border: 1px solid gray; 
      border-radius: 2px; 
      margin-left: -15px;
      margin-top: 5px;
      font-size: 12px
    }
  </style>
@endpush
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contactfffs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Add Inspectionsss</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- Main content -->
     <section class="content">
      <form action="#" method="post">

        <div class="row">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">General Informadddddtions</h3>
  
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
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label for="findings">Findings Description</label>
                        <textarea id="findings" class="form-control" rows="4" name="findings" placeholder="Type finding or problems"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-4" >
                      <label for="finding_suggestions">Findings Suggestions</label>
                      <div class="finding_suggestions">
                        <ul class="suggestions">
                          <li class="li_suggestions"><span class="t"><i class="fa fa-arrow-right"></i> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span></li>
                          <li class="li_suggestions"><span class="t"><i class="fa fa-arrow-right"></i> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                            when an unknown printer took a galley of type and scrambled it to make a type specimen book. </span></li>
                          <li class="li_suggestions"><span class="t"><i class="fa fa-arrow-right"></i> Many desktop publishing packages and web page editors now use Lorem 
                            Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</span></li>
                          <li class="li_suggestions"><span class="t"><i class="fa fa-arrow-right"></i> The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</span></li>
                          <li class="li_suggestions"><span class="t"><i class="fa fa-arrow-right"></i> "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span></li>
                        </ul>
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group">
                            <label for="inputStatus">Accountibility</label>
                            <input type="text" class="form-control" id="accountibility" placeholder="Accountibility...">
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
                <div class="col-sm-12">
                  <div class="form-group">
                      <label for="datepicker1">Date</label>
                      <div class='input-group date' id='datetimepicker1'>
                          <input type="text" class="datepicker1">
                      </div>
                  </div> 
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                      <label for="datepicker">Closing Date</label>
                      <div class='input-group date' id='datetimepicker1'>
                          <input type="text" class="datepicker">
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
            <input type="submit" value="Create new Inspection" class="btn btn-success float-right">
          </div>
        </div>
      </form>
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

  $(".datepicker1").datepicker({ dateFormat: 'yy-mm-dd' }).datepicker("setDate", new Date());


  $('#accountibility1').change(function(){
    $('#accountibility').val($('#accountibility1').val())
  })

  $('#location_choose').change(function(){
    $('#location').val($('#location_choose').val())
  })

  $(document).ready(function() 
 {
    $('ul.suggestions li').click(function(e) { 
      $('#findings').val($(this).find("span.t").text())
    });
 });


  </script>
  @endpush