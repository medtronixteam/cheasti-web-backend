@extends('layouts.app')
@section('title')
Tickets
@endsection
@section('content')
<section class="all-ticket">
    <div class="container mt-3">
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="font-weight-bold">All Tickets</h3>
                <hr>
            </div>
        </div>
        @foreach($tickets as $ticket)
        <div class="card p-4 border-0 my-3">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between my-1 align-items-end">
                        <div>
                        <h5 class="font-weight-bold">Ticket # {{ $ticket->ticket_id  }}</h5>
                        <h6 class="mt-2">{{ $ticket->question }}</h6>
                        <p>{{ $ticket->reply }}</p>
                        <small>Posted at: {{ $ticket->created_at->format('h:i A') }}</small>
                    </div>
                <div>
                    <a href="{{ route('admin.tickets.respond', ['ticketId'=>$ticket->ticket_id ]) }}" class="btn btn-warning mx-1">Respond</a>
                </div>
            </div>
                </div>
            </div>
            <hr>
        </div>
        @endforeach

        <div class="d-flex justify-content-center">
            {{ $tickets->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
@endsection
