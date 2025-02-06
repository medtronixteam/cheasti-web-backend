<!-- // resources/views/admin/creators/inactive.blade.php -->
@extends('layouts.app')
@section('title')
InActive User
@endsection
@push('css')
<style>
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff !important;
    background-color: orangered;
}
</style>

@endpush

@section('content')
<link rel="stylesheet" href="{{url('assets/css/admin.css')}}">

<div class="row ">
    <div class="col-sm-12 shadow">
        <div class="p-5 rounded mb-5">
            <!-- Bordered tabs-->
            <ul id="myTab1" role="tablist" class="nav nav-tabs nav-pills with-arrow flex-column flex-sm-row text-center">
                <li class="nav-item flex-sm-fill">
                    <a href="{{ route('admin.creators.active') }}" aria-controls="home1" aria-selected="true" class="nav-link text-uppercase font-weight-bold rounded-0 border">Active User</a>
                </li>
                <li class="nav-item flex-sm-fill">
                    <a href="{{ route('admin.creators.inactive') }}" aria-controls="profile1" aria-selected="false" class="nav-link text-uppercase font-weight-bold rounded-0 border active">Cancel User</a>
                </li>
            </ul>
            <div class="row">
                <div class="col-12">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                                             <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inactiveUsers as $user)
                                <tr>
                                    <th scope="row">
                                        {{-- <img src="{{url('assets/images/portrait-3.jpg')}}" alt="" class="img-fluid mr-2" style="border-radius: 100%; width: 30px; height: 30px;">
                                      --}}
                                      {{ $user->first_name }}  {{ $user->last_name }}</th>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <form action="{{ route('admin.creators.enable', $user->user_id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="mdi mdi-pencil-outline me-1"></i> Enable
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.creators.delete', $user->user_id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="mdi mdi-trash-can-outline me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End bordered tabs -->
        </div>
    </div>
</div>
@endsection
