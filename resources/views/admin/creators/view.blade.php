<!-- resources/views/admin/creators/view.blade.php -->
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{url('assets/css/admin.css')}}">

<div class="row">
    <section class="user-profile">
        <div class="container mt-3">
            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="font-weight-bold">User Profile</h3>
                    <hr>
                </div>
                <div class="col-6 mx-auto user-content text-center">
                    <img src="{{ url('assets/images/' . $user->photo) }}" alt="" class="img-fluid user-img">
                    <h2 class="mt-2">{{ $user->first_name }} {{ $user->last_name }}</h2>
                    <p>{{ $user->role }}</p>

                    <div class="user-detail d-flex justify-content-around mt-3 flex-wrap">
                        <div class="mx-2">
                            <h2>199</h2>
                            <p>Post</p>
                        </div>
                        <hr style="border: 1px solid gray; height: 50px;">
                        <div class="mx-2">
                            <h2>Premium</h2>
                            <p>plan</p>
                        </div>
                        <hr style="border: 1px solid gray; height: 50px;">
                        <div class="mx-2">
                            <h2>{{ \Carbon\Carbon::parse($user->created_at)->format('d M ') }}</h2>
                            <p>Member Since</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <hr>
                </div>
            </div>
            <!-- cards list -->
            <div class="row mt-5 mb-5 justify-content-between">
                <div class="col-12 col-lg-6 bg-white table-list table-list1">
                    <p class="mb-0 p-3 font-weight-bold">{{ $user->first_name }}'s Transaction History</p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="transaction-thead">
                                <tr>
                                    <th>Product name</th>
                                    <th>Date</th>
                                  
                                    <th>Amount</th>
                                </tr>
                            </thead>
                           <!-- Inside the table body for transaction history -->
<!-- Inside the table body for transaction history -->
<tbody>
    @if($transactions)
       @foreach($transactions as $transaction)
    <tr>
        <td>{{ $transaction->prod_name }}</td>
      <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('m-d-Y') }}</td>
       
        <td class="text-danger">{{ $transaction->currency }}. {{ $transaction->amount }}</td>
    </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4" class="text-center">No transaction history found.</td>
        </tr>
    @endif
</tbody>

                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-6 bg-white table-list mt-lg-0 mt-3">
                    <p class="mb-0 p-3 font-weight-bold">{{ $user->first_name }}'s Uploading History</p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="transaction-thead">
                                <tr>
                                    <th>Platform</th>
                                    <th>Title</th>
                                    <th>Time</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="social-icon"><i class='bx bxl-facebook'></i></td>
                                    <td>Podcast Clip Short Video</td>
                                    <td>29, August 2023</td>
                                    <td>8:30 pm</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
