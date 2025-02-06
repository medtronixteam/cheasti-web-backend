@extends('layouts.app')
@section('title')
Subscription

@endsection
@section('content')
<h4>Your Plans</h4>
<!-- Pricing Plans -->
<div class="pricing-plans row mx-0 gy-3 px-lg-5">
    <!-- Basic -->
    <div class="col-lg mb-md-0 mb-4">
        <div class="card border rounded shadow-none">
            <div class="card-body">
                <div class="my-3 pt-2 text-center">
                    <img src="../../assets/img/illustrations/pricing-basic.png" alt="Basic Image" height="100" />
                </div>
                <h3 class="card-title text-center text-capitalize mb-1">Basic</h3>
                <p class="text-center pb-2 d-none">A simple start for everyone</p>
                <div class="text-center">
                    <div class="d-flex justify-content-center">
                        <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-body fw-normal">$</sup>
                        <h1 class="display-3 mb-0 text-primary">85</h1>
                        <sub class="h6 pricing-duration mt-auto mb-2 text-body fw-normal">/month</sub>
                    </div>
                </div>

                <ul class="list-group ms-4 my-4 pt-2">
                    <li class="mb-1">Auto Scheduler</li>
                    <li class="mb-1">Editor Software</li>
                    <br><br><br><br><br>
                    <br>
                </ul>


                @if (auth()->user()->is_plan_active==0)
                <a href="{{route('user.subscription.plan',['plan'=>'basic'])}}" class="btn btn-outline-primary d-grid w-100">Upgrade</a>
                @else

                <a href="javascript:void(0)" class="btn btn-outline-success d-grid w-100">Your Current Plan</a>
                @endif


            </div>
        </div>
    </div>

    <!-- Standard -->
    <div class="col-lg mb-md-0 mb-4">
        <div class="card border-primary border shadow-none">
            <div class="card-body position-relative">
                <div class="position-absolute end-0 me-4 top-0 mt-4">
                    <span class="badge bg-label-primary rounded-pill">Popular</span>
                </div>
                <div class="my-3 pt-2 text-center">
                    <img src="{{url('assets/img/illustrations/pricing-standard.png')}}" alt="Standard Image" height="100" />
                </div>
                <h3 class="card-title text-center text-capitalize mb-1">Pro</h3>
                <p class="text-center d-none">For small to medium businesses</p>
                <div class="text-center">
                    <div class="d-flex justify-content-center">
                        <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-body fw-normal">$</sup>
                        <h1 class="price-toggle price-yearly display-3 text-primary mb-0">100</h1>
                        <sub class="h6 text-body pricing-duration mt-auto mb-2 fw-normal">/month</sub>
                    </div>

                </div>

                <ul class="list-group ms-4 my-4 pt-3">
                    <li class="mb-1">Auto Scheduler</li>
                    <li class="mb-1">Editor Software</li>
                    <li class="mb-1">Admin Owner</li>
                    <li class="mb-1">Multiple Platform Link</li>
                    <li class="mb-1">Automation</li>
                    <br>
                    <br>

                </ul>
                @if (auth()->user()->is_plan_active==0)
                <a href="{{route('user.subscription.plan',['plan'=>'pro'])}}" class="btn btn-primary d-grid w-100">Upgrade</a>
                @else

                <a href="javascript:void(0)" class="btn btn-outline-success d-grid w-100">Your Current Plan</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Enterprise -->
    <div class="col-lg">
        <div class="card border rounded shadow-none">
            <div class="card-body">
                <div class="my-3 pt-2 text-center">
                    <img src="../../assets/img/illustrations/pricing-enterprise.png" alt="Enterprise Image" height="100" />
                </div>
                <h3 class="card-title text-center text-capitalize mb-1">Enterprise</h3>
                <p class="text-center d-none">Solution for big organizations</p>

                <div class="text-center">
                    <div class="d-flex justify-content-center">
                        <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-body fw-normal">$</sup>
                        <h1 class="price-toggle price-yearly display-3 text-primary mb-0">120</h1>
                        <h1 class="price-toggle price-monthly display-3 text-primary mb-0 d-none">19</h1>
                        <sub class="h6 pricing-duration mt-auto mb-2 fw-normal text-body">/month</sub>
                    </div>
                </div>

                <ul class="list-group ms-4 my-4 pt-3">
                    <li class="mb-1">Invoices</li>

                    <li class="mb-1">Notes</li>

                    <li class="mb-1">Planner Scheduler</li>
                    <li class="mb-1">Editor Software</li>
                    <li class="mb-1">Auto Content</li>
                    <li class="mb-1">Multiple Platform Link</li>
                    <li class="mb-1">Automation Cloud Data</li>


                </ul>
                @if (auth()->user()->is_plan_active==0)
                <a href="{{route('user.subscription.plan',['plan'=>'enterprise'])}}" class="btn btn-outline-primary d-grid w-100">Upgrade</a>
                @else

                <a href="javascript:void(0)" class="btn btn-outline-success d-grid w-100">Your Current Plan</a>
                @endif
            </div>
        </div>
    </div>
</div>
<!--/ Pricing Plans -->


@endsection
