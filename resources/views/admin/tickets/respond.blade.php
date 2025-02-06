@extends('layouts.app')
@section('title')
Ticket Details
@endsection
@section('content')
<section class="ticket-section">
    <div class="container mt-3">
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="font-weight-bold">Ticket Details</h3>
                <hr>
            </div>
        </div>
        <div class="card p-4 border-0 bg-white">
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <h5>Ticket # {{ $ticket->ticket_id }}</h5>
                    <p>posted at {{ $ticket->created_at->format('H:i a') }}</p>
                </div>
                <div class="col-12 mt-4">
                    <h4 class="font-weight-bold">{{ $ticket->question }}</h4>
                    <p class="mt-3">{{ $ticket->reply }}</p>
                </div>
            </div>
        </div>
        <div class="card p-4 border-0 bg-white mt-4">
            <h3 class="mt-3">Reply to Ticket</h3>
            <form action="{{ route('admin.tickets.saveResponse', $ticket->ticket_id) }}" method="POST">
                @csrf
                <div class="row mt-5">
                    <div class="col-12 col-md-6">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control bg-light" required>
                            <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                    <div class="col-12 mt-5">
                        <label for="reply">Reply to Ticket:</label>
                        <textarea name="reply" id="reply" rows="5" class="form-control bg-light" placeholder="Write the reply here" required>{{ old('reply', $ticket->reply) }}</textarea>
                        <button class="btn btn-warning px-5 mt-3 font-weight-bold ticket-btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>

</section>


@endsection
