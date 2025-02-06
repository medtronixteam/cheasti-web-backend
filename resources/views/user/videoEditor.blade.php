@extends('layouts.app')
@section('title','Video Editor')
@section('content')
<div class="row gy-4">
    <div class="col-12 d-flex justify-content-end">
        <button type="button" onclick="fullScreen()"  class="btn btn-dark btn-sm">Full Screen</button>
    </div>
    <div class="col-md-12 col-lg-12">
       <iframe style="width: 100%; height:100vh" id="my-iframe"  src="https://video.ihsancrm.com/?token={{ $token }}" frameborder="0"></iframe>
    </div>
      {{-- <iframe style="width: 100%; height:100vh" id="my-iframe"  src="http://localhost:3000?token={{ $token }}" frameborder="0"></iframe>
   --}}
</div>
    <!--/ row -->


  </div>

@endsection

@push('js')
    <script>

function fullScreen(){
            const iframe = document.getElementById('my-iframe');
  if (iframe.requestFullscreen) {
    iframe.requestFullscreen();
  } else if (iframe.mozRequestFullScreen) { // Firefox
    iframe.mozRequestFullScreen();
  } else if (iframe.webkitRequestFullscreen) { // Chrome, Safari, and Opera
    iframe.webkitRequestFullscreen();
  } else if (iframe.msRequestFullscreen) { // IE/Edge
    iframe.msRequestFullscreen();
  }
        }


    </script>
@endpush
