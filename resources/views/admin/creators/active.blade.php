
@extends('layouts.app')
@section('title')
Active User
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

<div class="row">
    <div class="col-sm-12 shadow">
        <div class="p-5 rounded mb-5">
            <ul id="myTab1" class="nav nav-tabs nav-pills with-arrow flex-column flex-sm-row text-center">
                <li class="nav-item flex-sm-fill">
                    <a id="home1-tab" href="{{ route('admin.creators.active') }}"
                       aria-selected="true"
                       class="nav-link text-uppercase font-weight-bold rounded-0 border active">Active User</a>
                </li>
                <li class="nav-item flex-sm-fill">
                    <a id="profile1-tab" href="{{ route('admin.creators.inactive') }}"
                       aria-selected="false"
                       class="nav-link text-uppercase font-weight-bold rounded-0 border">Cancel User</a>
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
                                <th scope="col">Plan</th>

                                <th scope="col">Join Date</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activeUsers as $user)
                                <tr>
                                    <th scope="row">
                                        {{-- <img src="assets/images/portrait-3.jpg" alt="" class="img-fluid mr-2"
                                             style="border-radius: 100%; width: 30px; height: 30px;"> --}}

                                             {{ $user->first_name }}  {{ $user->last_name }}
                                    </th>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td class="plan-tag">
                                        @if ($user->is_plan_active== 1)
                                        <span class="bg-secondary text-white px-3 py-1 rounded-pill">{{$user->current_plan}}</span>
                                        @else
                                        <span class="bg-danger text-white px-3 py-1 rounded-pill">No Plan</span>
                                        @endif
                                    </td>

                                    <td>{{$user->created_at}}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <form action="{{ route('admin.creators.disable', $user->user_id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="mdi mdi-pencil-outline me-1"></i> Disable
                                                    </button>
                                                </form>
                                                <a class="dropdown-item" href="{{ route('admin.creators.view', $user->user_id) }}">
                                                    <i class="mdi mdi-eye-outline me-1"></i> View
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
