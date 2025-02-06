@extends('layouts.app')
@section('title')
Transactions
@endsection

@section('content')

<div class="card">
    <h5 class="card-header">All Transactions</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Product Name</th>
                    <th>Created At</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->first_name }} {{ $transaction->last_name ?? 'N/A' }}</td>
                    <td>

                        <span class="fw-medium">{{ $transaction->prod_name }}</span>
                    </td>
                    <td>{{ $transaction->created_at->format('m-d-Y') }}</td>
                    <td>{{ $transaction->currency }}. {{ $transaction->amount }}</td>
                     <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.transactions.show', $transaction->id) }}">
                                    <i class="mdi mdi-eye-outline me-1"></i> View
                                </a><br>
                                {{-- <a class="dropdown-item" href="{{ route('admin.transactions.edit', $transaction->id) }}">
                                    <i class="mdi mdi-pencil-outline me-1"></i> Edit
                                </a> --}}
                                <br>
                                {{-- <form action="{{ route('admin.transactions.destroy', $transaction->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this transaction?')">
                                        <i class="mdi mdi-trash-can-outline me-1"></i> Delete
                                    </button>
                                </form> --}}
                            </div>
                        </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
