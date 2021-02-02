@extends('layouts.admin.master')
@section('title','Inspections')
@push('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('dist/cam/css/style.css') }}" />
@endpush
@section('content')
<div class="col-md-12 col-md-lg col-sm-lg">
    <div class="card">
        <div class="card-body">
            <form class="form" method="POST" action="#">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="inspection_id" value="{{ \Request::get('inspection_id') }}" id="inspection_id">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div id="vid_container">
                      <video id="video" autoplay playsinline></video>
                      <div id="video_overlay"></div>
                    </div>
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div id="gui_controls">
                      <button
                        id="switchCameraButton"
                        name="switch Camera"
                        type="button"
                        aria-pressed="false"
                      >Flick</button>
                      <button id="takePhotoButton" name="take Photo" type="button">Capture</button>
                      <button
                        id="toggleFullScreenButton"
                        name="toggle FullScreen"
                        type="button"
                        aria-pressed="false"
                      >Flick</button>
                    </div>
                  </div>

                </div>
            </form>
        </div>
    </div>
</div>  
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('dist/js/actions.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="{{ asset('dist/cam/js/adapter.min.js') }}"></script>
<script src="{{ asset('dist/cam/js/screenfull.min.js') }}"></script>
<script src="{{ asset('dist/cam/js/howler.core.min.js') }}"></script>
<script src="{{ asset('dist/cam/js/main.js') }}"></script>
@endpush
