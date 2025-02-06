@extends('layouts.app')
@section('title')
Support

@endsection

@push('css')
<style>
    .accordion-item {
        margin-bottom: 20px;
    }

    .accordion-item.active {
        box-shadow: none !important;
    }

    .card {
        box-shadow: none;
    }

    .accordion-item:not(.active):not(:first-child) .accordion-header {
        border-top: none !important;
    }
</style>
@endpush

@section('content')
<div class="row gy-4">
    <div class="col-12">
        <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h3 class="card-title mb-sm-0 me-2">Frequently Asked Questions</h3>
            <div class="action-btns">
                <a href="{{ route('user.ticket.list') }}" class="btn btn-primary waves-effect waves-light">
                    Ticket List
                </a>
                <a href="{{ route('user.support.category') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="menu-icon tf-icons mdi mdi-plus"></i>
                    Still Need help
                </a>
            </div>
        </div>
        <hr>
    </div>

    <div class="col-12 mb-6 mb-md-2">
        <div class="card">
            <div class="accordion" id="accordionExample">
                @foreach ($faqs as $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
