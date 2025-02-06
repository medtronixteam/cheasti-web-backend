@extends('layouts.app')
@section('title')
Dashboard
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
<style>
    .card-plan {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-plan .total-Subscribers {
        color: #344767;
        font-size: 28px;
        font-weight: 700;

    }

    .card-plan .Subscribers {
        color: #7B809A;
        font-size: 16px;
        font-weight: 300;
    }

    .card-plan .icon-custom {
        background-color: #ff6a00;
        border-radius: 10px;
        color: white;
        font-size: 24px;
        padding: 12px;
        margin-right: 10px;
        margin-top: -68px;
    }

    .card-plan .plan-count {
        font-size: 30px;
    }

    .card-plan .plan-text {
        font-size: 12px;
        color: #D4D4D4;
    }

</style>


@endpush
@section('content')
<div class="row gy-4 mt-5">
    <div class="col-md-4">
        <div class="card card-plan p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="icon-custom">

                    <img class="img-fluid" src="{{ url('assets/img/plan-user/chart-bar.png') }}" alt="not-show">
                </div>
                <div>
                    <div class="Subscribers">Subscribers</div>
                    <div class="total-Subscribers">{{ $totalPlanCount }}</div>
                </div>
            </div>
            <div class="mt-3">
                <hr class="m-0">

            </div>

            <div class="d-flex justify-content-between mt-3">
                <div class="text-center">
                    <div class="plan-count" style="color: #05CD74">{{ $basicPlanCount }}</div>
                    <div class="plan-text">Basic Plan</div>
                </div>
                <div class="text-center">
                    <div class="plan-count" style="color:#FF6B00;">{{ $proPlanCount }}</div>
                    <div class="plan-text"> Pro Plan</div>
                </div>
                <div class="text-center">
                    <div class="plan-count" style="color: #FF9900;">{{ $enterprisePlanCount }}</div>
                    <div class="plan-text">Enterprise Plan</div>
                </div>
            </div>
        </div>



    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center flex-wrap">
                    <div class="avatar me-4">
                        <div class="avatar-initial bg-label-primary rounded-3">
                            <i class="fa fa-user">
                            </i>
                        </div>
                    </div>
                    <div class="card-info">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 me-2">{{ $totalUsers }}</h5>

                        </div>

                        <p class="mb-0">Total user</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gy-4 mt-5">
        <div class="col-md-7 col-12">
            <div class="card">
                <h5 class="card-header"> Recent Subcription Users <span class="badge rounded-pill bg-label-warning me-1">{{ $totalPlanCount }}</span></h5>
                <div>
                    <hr>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-borderless">
                        <tbody>
                            @foreach ($subcriptionUsers as $user)
                            <tr>
                                <td><i class="fa fa-user text-danger me-4"></i><span class="fw-medium">{{ $user->first_name }} {{ $user->last_name }}</span></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <!-- Display user's plan -->
                                    @if ($user->current_plan === "basic")
                                    <span class="badge rounded-pill bg-label-primary me-1">{{ $user->current_plan }}</span>
                                    @elseif ($user->current_plan === "pro")
                                    <span class="badge rounded-pill bg-label-success me-1">{{ $user->current_plan }}</span>
                                    @elseif ($user->current_plan === "enterprise")
                                    <span class="badge rounded-pill bg-label-info me-1">{{ $user->current_plan }}</span>
                                    @endif
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-12">
            <div class="card">
                <h5 class="card-header"> All Users</h5>
                <div>
                    <hr>
                </div>
                <div class="table-responsive text-nowrap">
                    <table id="" class="table table-borderless">
                        <tbody>
                            @foreach ($unSubcriptionUsers as $user)
                            <tr>
                                <td><i class="fa fa-user text-danger me-4"></i><span class="fw-medium">{{ $user->first_name }} {{ $user->last_name }}</span></td>
                                <td>{{ $user->email }}</td>

                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>

    @push('js')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });

    </script>
    @endpush

    @endsection
