@extends('layouts.app')
@section('title')
Platform-Links

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row "style="border-bottom: 1px solid rgba(227, 227, 227, 1)">
            <div class="col-md-6 mb-2">
                <h4 class="text-black">Platform Links</h4>
            </div>
            <div class="col-md-6 mb-3 text-right" style="justify-content: end;display: flex;">



            </div>
        </div>
        <div class="row ">
            <div class="col-sm-4 mt-2 ">

                <div class="card">
                    <div class="card-body ">
                        <div class="w-100 d-flex justify-content-center">
                            <img width="50" src="{{url('assets/img/instagra-icon.png')}}" class="" />

                        </div>
                        <br>
                        <p class="text-center w-100">You can link <b> Instagram</b> to this platform</p>
                        <hr>

                        <div class="d-flex justify-content-between mt-5">
                            <a href="#" class="btn btn-primary">Link</a>

                        </div>
                    </div>
                </div>
            </div>
             {{-- end of col --}}
             <div class="col-sm-4 mt-2  ">

                <div class="card">
                    <div class="card-body ">
                        <div class="w-100 d-flex justify-content-center">


                            <img width="50" src="{{url('assets/img/items.png')}}" class="" />


                        </div>

                        <br>
                        <p class="text-center mb-3 w-100">You can link <b> Tiktok</b> Account to this platform</p>


                        <hr>

                        <div class="d-flex justify-content-between mt-5">
                            <a href="#" class="btn btn-primary">Link</a>

                        </div>
                    </div>
                </div>
            </div>
             {{-- end of col --}}
             <div class="col-sm-4 mt-2 ">

                <div class="card">
                    <div class="card-body ">
                        <div class="w-100 d-flex justify-content-center">

                            <img width="50" src="{{url('assets/img/youtube-logo-png-2067 1.png')}}" class="" />




                        </div>

                        <br>
                        <p class="text-center mb-3 w-100">You can link <b> Youtube </b> to this platform</p>

                        <hr>

                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{route('auth.redirect')}}" class="btn btn-primary">Link</a>

                        </div>
                    </div>
                </div>
            </div>
             {{-- end of col --}}


        </div>
    </div>






@endsection
