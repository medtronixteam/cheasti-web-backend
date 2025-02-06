@extends('layouts.app')

@section('content')

<div class="card">
    <h5 class="card-header">View Transaction</h5>
    <div class="card-body">

        <div class="row mb-3">
            <div class="col">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" value="{{ $transaction->first_name }}" readonly>
            </div>
            <div class="col">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" value="{{ $transaction->last_name }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="prod_name">Product Name</label>
                <input type="text" class="form-control" name="prod_name" value="{{ $transaction->prod_name }}" readonly>
            </div>
            <div class="col">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" name="amount" value="{{ $transaction->amount }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="currency">Currency</label>
                <input type="text" class="form-control" name="currency" value="{{ $transaction->currency }}" readonly>
            </div>
            <div class="col">
                <label for="bill_interval">Bill Interval</label>
                <input type="date" class="form-control" name="bill_interval" value="{{ $transaction->bill_interval }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $transaction->email }}" readonly>
            </div>
            <div class="col">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" value="{{ $transaction->city }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="postal_code">Postal Code</label>
                <input type="text" class="form-control" name="postal_code" value="{{ $transaction->postal_code }}" readonly>
            </div>
            <div class="col">
                <label for="processed">Processed</label>
                <input type="text" class="form-control" name="processed" value="{{ $transaction->processed == 1 ? 'Yes' : 'No' }}" readonly>
            </div>
        </div>

        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

@endsection
