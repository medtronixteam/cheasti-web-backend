@extends('layouts.app')

@section('content')

<div class="card">
    <h5 class="card-header">Edit Transaction</h5>
    <div class="card-body">
        <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{ $transaction->first_name }}">
                </div>
                <div class="col">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{ $transaction->last_name }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="prod_name">Product Name</label>
                    <input type="text" class="form-control" name="prod_name" value="{{ $transaction->prod_name }}">
                </div>
                <div class="col">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" name="amount" value="{{ $transaction->amount }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="currency">Currency</label>
                    <input type="text" class="form-control" name="currency" value="{{ $transaction->currency }}">
                </div>
                <div class="col">
                    <label for="bill_interval">Bill Interval</label>
                    <input type="date" class="form-control" name="bill_interval" value="{{ $transaction->bill_interval }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $transaction->email }}">
                </div>
                <div class="col">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" value="{{ $transaction->city }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="postal_code">Postal Code</label>
                    <input type="text" class="form-control" name="postal_code" value="{{ $transaction->postal_code }}">
                </div>
                <div class="col">
                    <label for="processed">Processed</label>
                    <select class="form-control" name="processed">
                        <option value="1" {{ $transaction->processed == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $transaction->processed == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection
