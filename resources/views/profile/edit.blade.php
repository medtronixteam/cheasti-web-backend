@extends('layouts.app')
@section('title','Profile')

@section('content')


<div class="row ">
    <div class="col-md-12">
        <div class="card mb-4">
            <h4 class="card-header">Profile Details</h4>

            <div class="card-body pt-2  ">
                <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                    @csrf
                    <div class="row  gy-4">
                        <div class="col-md-6 fv-plugins-icon-container">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="firstName" name="first_name" value="{{ $user->first_name }}" autofocus="">
                                <label for="firstName">First Name</label>
                            </div>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <div class="col-md-6 fv-plugins-icon-container">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" name="last_name" id="lastName" value="{{ $user->last_name }}">
                                <label for="lastName">Last Name</label>
                            </div>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="phone" name="phone" class="form-control" value="{{ $user->phone }}">
                                    <label for="phone">Phone Number</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary waves-effect">Cancel</button>
                    </div>
                    <input type="hidden">
                </form>
            </div>
            <!-- /Account -->
        </div>
    </div>
</div>
     <!-- Password Reset Section -->
        <div class="card mb-4">
            <h4 class="card-header">Reset Password</h4>
            <div class="card-body pt-2">
                <!-- Password Reset Form -->
                <form id="formResetPassword" method="POST" action="{{ route('profile.reset.password') }}" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-6 fv-plugins-icon-container">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="password" id="password" name="password" autofocus="">
                                <label for="password">New Password</label>
                            </div>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <div class="col-md-6 fv-plugins-icon-container">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                                <label for="password_confirmation">Confirm Password</label>
                            </div>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Reset Password</button>
                    </div>
                </form>
                <!-- /Password Reset Form -->
            </div>
        </div>
        <!-- /Password Reset Section -->
    </div>
</div>

@endsection
