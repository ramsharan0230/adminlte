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
            <h1>Inspection Excel Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Excel Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- Main content -->
     <section class="content">
      <form action="{{ route('inspection.report.excel', $branch_id) }}" method="post" >
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Excel Report</h3>
  
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                        <input type="hidden" value="{{ $branch_id }}" name="branch_id">
                        <div class="input-group date" data-provide="datepicker">
                            <label for="start_date" class="mr-3">Start Date: </label>
                            <input type="text" class="form-control datepicker" id="start_date" name="start_date" autocomplete="off">
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="input-group date" data-provide="datepicker">
                            <label for="end_date" class="mr-3">End Date: </label>
                            <input type="text" class="form-control datepicker" id="end_date" name="end_date" autocomplete="off">
                        </div>
                      </div>

                      <div class="col-sm-3">
                           <button class="btn btn-primary btn-sm mt-1">Submit</button>
                      </div>
                  </div>
                </div>
              <!-- /.card-body -->
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
  <script>
    $(function(){
        $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
        $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#to").datepicker( "option", "minDate", minValue );
        })
    });

  </script>
  @endpush