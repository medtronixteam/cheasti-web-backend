@extends('layouts.app')
@push('css')

<style>
 .form-check-input:checked {
    background-color: #20d83e !important;
    border-color: #20d83e !important;
}
</style>
@endpush
@section('content')
<div class="row gy-4">

    <div class="col-12">
        <div class=" d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h3 class="card-title mb-sm-0 me-2">Create Invoice </h3>

        </div>
        <hr>
    </div>
    <div class="col-md-5">
        <div>
            <label for="Username" class="form-label">Enter First Name</label>
            <select id="Username" class="form-select form-select-sm" style="background-color: #F2F2F2">
                <option>Select Your Username</option>
                <option  value="1">One</option>
                <option value="2">Two</option>
                <option  value="3">Three</option>
                <option class="text-primary" value="3"> <a  href="">+ Create New User</a> </option>
            </select>
        </div>


    </div>

    <div class="col-12 d-none">
        <div class="card mb-6">
            <h5 class="card-header">Add User</h5>
            <hr>
            <div class="card-body demo-vertical-spacing demo-only-element">

                <form action="">
                    <div class="row">

                        <div class="col-md-6 col-lg-4 mb-5 ">
                            <label for="First_Name">First Name</label>
                            <input type="text" class="form-control mt-1" id="First_Name" placeholder="Enter your username">
                        </div>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <label for="Last_Name">Last Name</label>
                            <input type="text" class="form-control mt-1" id="Last_Name" placeholder="Enter your Last Name ">
                        </div>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control mt-1" id="Email" placeholder="Enter your email">
                        </div>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <label for="Business_Name">Business Name</label>
                            <input type="text" class="form-control mt-1" id="Business_Name" placeholder="Enter your Business Name">
                        </div>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <label for="Service_Item">Service / Item</label>
                            <input type="text" class="form-control mt-1" id="Service_Item" placeholder="Enter Service Name">
                        </div>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <label for="Quantity">Quantity</label>
                            <input type="text" class="form-control mt-1" id="Quantity" placeholder="Enter Quantity">
                        </div>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <label for="Rate">Rate</label>
                            <input type="text" class="form-control mt-1" id="Rate" placeholder="Enter Rate">
                        </div>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <label for="Total_Amount">Total Amount</label>
                            <input type="text" class="form-control mt-1" id="Total_Amount" placeholder="Total Amount">
                        </div>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <input class="form-check-input" type="checkbox" value="" id="Tax">
                            <label class="form-check-label" for="Tax">
                                Tax
                            </label>
                            <input type="text" class="form-control mt-1" id="Total_Amount" placeholder="Enter Percentage for Tax % ">
                        </div>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <input class="form-check-input" type="checkbox" value="" id="GST">
                            <label class="form-check-label" for="GST">
                                GST
                            </label>
                            <input type="text" class="form-control mt-1" id="Total_Amount" placeholder="Enter Percentage for GST %">
                        </div>

                        <div class="col-md-6 col-lg-4 mb-5">
                            <input class="form-check-input" type="checkbox" value="" id="Late_Fee">
                            <label class="form-check-label" for="Late_Fee">
                                Late Fee
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="Text input with dropdown button">
                                <button class="btn btn-outline-primary dropdown-toggle waves-effect" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                  <li><a class="dropdown-item waves-effect" href="javascript:void(0);">Action</a></li>
                                  <li><a class="dropdown-item waves-effect" href="javascript:void(0);">Another action</a></li>
                                  <li><a class="dropdown-item waves-effect" href="javascript:void(0);">Something else here</a></li>
                                  <li>
                                    <hr class="dropdown-divider">
                                  </li>
                                  <li><a class="dropdown-item waves-effect" href="javascript:void(0);">Separated link</a></li>
                                </ul>
                              </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <div>
                                <label for="Username" class="form-label"> <img class="img-fluid" src="{{ url('assets/img/currency/Currency-icon.png') }}" alt=""> Currency</label>
                                <select id="Username" class="form-select  form-select-sm">
                                    <option>Select Your Username</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 mb-5">
                            <div>
                                <label for="Billing_Address" class="form-label"> Billing Address</label>
                               <textarea class="form-control" name="" id="Billing_Address" rows="5" placeholder="Enter your Billing Address"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <input class="form-check-input" type="checkbox" value="" id="Save_Details">
                            <label class="form-check-label" for="Save_Details">
                                Save Details for later
                            </label>
                        </div>
                        <div class="col-12 mt-5 text-end">
                            <button type="button" class="btn btn-outline-primary waves-effect">Cancel</button>
                            <button type="button" class="btn btn-secondary waves-effect waves-light">Save</button>
                        </div>
                    </div>


                </form>




            </div>
        </div>
    </div>



</div>

@endsection
