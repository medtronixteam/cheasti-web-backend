@extends('layouts.app')
@section('title','Invoice List')
@section('content')
<link rel="stylesheet" href="{{url('assets/vendor/libs/toastr/toastr.css')}}">
<div class="row gy-4">

    <div class="col-12 d-flex justify-content-between">
        <div class="">
            <h3 class="card-title mb-sm-0 me-2">Invoices List</h3>
            <p>List of all your Invoices are given below</p>

        </div>
        <div class="">
            <a class="btn btn-primary float-right" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#backDropModal">Create</a>
        </div>

    </div>

    <div class="col-12">

        <div class="card p-3">
            <div class="table-responsive text-nowrap mb-5" id="invoiceTable">
                <table class="table">
                    <thead>
                        <tr class="h5">
                            <th>No. </th>
                            <th>Date</th>
                            <th>Billing To</th>
                            <th>Billing From</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($invoices as $invoice)


                        <tr>
                            <td> {{$loop->iteration}}</td>

                            <td>{{$invoice->issue_date}}</td>
                            <td>{{$invoice->business_name}}</td>
                            <td>{{$invoice->billing_address }}</td>
                            <td>{{$invoice->amount}}</td>
                            <td>{{$invoice->due_date}}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="editInvoice(`{{$invoice->invoice_id}}`)" class="text-danger text-opacity-75 pe-1 border-2 border-end border-danger"><i class="fas fa-edit"></i></a>
                                <form action="#" method="POST" style="display: inline;">
                                    <button type="submit" class="btn p-0 text-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>



    </div>

</div>
<!-- Extra Large Modal -->
<div class="modal fade" id="backDropModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel4">Manage Invoice</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="billing_to" name="billing_to" class="form-control" placeholder="Enter Name" />
                                <label for="billing_to">Billing To</label>
                            </div>
                        </div>
                        <input type="hidden" value="" name="invoice_id">
                        <div class="col-12 col-sm-6 mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="billing_from" name="billing_from" class="form-control" placeholder="Enter Name" />
                                <label for="billing_from">Billing From</label>
                            </div>
                        </div>
                    </div>
                    {{-- end of row --}}
                    <div class="row g-2">
                        <div class="col-12 col-sm-5 mb-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="emailExLarge" class="form-control" name="service_item" placeholder="Enter Service/Item" />
                                <label for="emailExLarge">Service/Item</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2 mb-2">
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="quantity_in" class="form-control" name="quantity" placeholder="Quantity" />
                                <label for="emailExLarge">Quantity</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-2">
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="rate_in" name="rate" class="form-control" placeholder="Rate" />
                                <label for="emailExLarge">Rate</label>
                            </div>
                        </div>
                        {{-- <div class="col-12 col-sm-2 mb-2">
                            <div class="form-floating form-floating-outline">
                                <input readonly type="number" id="amount_in" name="amount" class="form-control" placeholder="Amount" />
                                <label for="emailExLarge">Amount</label>
                            </div>
                        </div> --}}
                        {{-- end of row --}}
                        <hr>
                        <div class="row">
                            {{-- <div class="col-sm-6 mx-auto my-1">
                                <div class="form-floating form-floating-outline">
                                    <input type="date" readonly value="{{ date('Y-m-d') }}" name="issue_date" class="form-control" id="">
                            <label for="emailExLarge">Issue Data (Readonly)</label>
                        </div>

                    </div> --}}
                    {{-- <div class="col-sm-6 mx-auto my-1">
                                <div class="form-floating form-floating-outline">
                                    <input type="date" name="due_date" value="{{ \Carbon\Carbon::now()->addDays(7)->toDateString() }}" class="form-control" id="">
                    <label for="emailExLarge">Due Data</label>
                </div>

        </div> --}}
    </div>
    {{-- end of row --}}
    <div class="row">

        <div class="col-sm-4">
            <div class="form-floating form-floating-outline">
                <input type="number" id="tax" name="tax_percentage" class="form-control" placeholder="Tax" />
                <label for="emailExLarge">Tax</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-floating form-floating-outline">
                <input type="number" id="gst" name="gst_percentage" class="form-control" placeholder="GST" />
                <label for="emailExLarge">GST</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-floating form-floating-outline">
                <input type="number" id="late_fee" name="late_fee_amount" class="form-control" placeholder="Late Fee" />
                <label for="emailExLarge">Late Fee</label>
            </div>
        </div>
        <div class="col-sm-8 mt-5">
            <div class="form-floating form-floating-outline">
                <textarea style="height: 80px" class="form-control" name="additional_notes" id="additionalNotes" cols="30" rows="10"></textarea>
                <label for="additionalNotes">Additional Notes</label>
            </div>
        </div>
    </div>
    {{-- end of row --}}
</div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button id="btn_attend" type="submit" class="btn btn-primary">Save changes</button>
</div>
</form>
</div>
</div>
</div>

@endsection
@push('js')
<script src="{{url('assets/vendor/libs/toastr/toastr.js')}}"></script>
<!-- Page JS -->
<script src="{{url('assets/js/ui-toasts.js')}}"></script>
<script>
    $("form").on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        // only neccessary if something above is listening to the (default-)event too
        //form.attr('action')
        var form = $(this);
        $.ajax({
            type: 'POST'
            , url: "{{route('user.invoice.store')}}"
            , data: new FormData(this)
            , contentType: false
            , cache: false
            , processData: false
            , dataType: 'json'
            , beforeSend: function() {
                toastr["info"]('Saving...');
                $('#btn_attend').prop("disabled", true);
                $('#btn_attend').text("Saving...");
            }
            , success: function(response) {
                console.log(response);
                if (response.code === 201) {
                    $('#backDropModal').modal('hide');
                    toastr["success"](response.message);
                } else {
                    toastr["error"](response.message);
                }

                $("#invoiceTable").load(location.href + " #invoiceTable > *");
                $('#btn_attend').prop("disabled", false);
                $('#btn_attend').text("Save Changes");

            }
        }); //ajax call
    }); //main

    $('#rate_in,#quantity_in').keyup(function() {
        let rate = $('#rate_in').val();
        let quantity = $('#quantity_in').val();

        $('#amount_in').val(rate * quantity);
    });

    function editInvoice(invoice_Id) {
        console.log(invoice_Id);

        $.ajax({
            url: "{{route('user.invoice.edit')}}"
            , method: "POST"
            , headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            , }
            , dataType: "json"
            , data: {
                invoice_Id: invoice_Id
            }
            , beforeSend: function(request) {
                return request.setRequestHeader(
                    "X-CSRF-Token"
                    , $("meta[name='csrf-token']").attr("content")
                );
            }
            , success: function(response) {
                if (response.code === 200) {
                    $('#backDropModal').modal('show');
                    $('input[name="invoice_id"]').val(response.message.invoice_id);
                    $('input[name="billing_to"]').val(response.message.business_name);
                    $('input[name="billing_from"]').val(response.message.billing_address);
                    $('input[name="due_date"]').val(response.message.due_date);
                    $('input[name="issue_date"]').val(response.message.issue_date);
                    $('input[name="tax_percentage"]').val(response.message.tax_percentage);
                    $('input[name="gst_percentage"]').val(response.message.gst_percentage);
                    $('input[name="late_fee_amount"]').val(response.message.late_fee_amount);
                    $('input[name="service_item"]').val(response.message.service_item);
                    $('input[name="quantity"]').val(response.message.quantity);
                    $('input[name="rate"]').val(response.message.rate);
                    let quantity = parseFloat($('input[name="quantity"]').val());
                    let rate = parseFloat($('input[name="rate"]').val());
                    $('input[name="amount"]').val(quantity * rate);

                } else {
                    toastr["error"](response.message);
                }
                console.log(response);

            }
        , });
    }
</script>
@endpush
