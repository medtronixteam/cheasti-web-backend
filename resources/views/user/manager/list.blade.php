@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-black">Managers</h2>
       <a href="{{ route('user.manager.create') }}" class="btn btn-primary">
    <span class="mdi mdi-plus"></span> Add Manager
</a>

    </div>
    <div class="row ">
        @foreach($managers as $manager)
            <div class="col-lg-3 col-md-6 manager-card mt-5">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ $manager['image'] }}" class="card-img-top mx-auto" alt="Manager Image">
                        <h5 class="card-title mt-3">{{ $manager['name'] }}</h5>
                        <p class="card-text">{{ $manager['designation'] }}</p>
                        <p class="card-text">{{ $manager['email'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .card {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border: none;
    }
    .card-img-top {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-top: -50px;
        background-color: rgba(255, 107, 0, 1);
        padding: 2px;
    }
    .card-body {
        text-align: center;
        background:white;
    }
    .manager-card {
        margin-bottom: 30px;
    }
     .card-text{
        color:grey;
    }
    .card-title{
        color:black;
    }
</style>
@endsection
