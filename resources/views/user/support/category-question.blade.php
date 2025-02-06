@extends('layouts.app')
@section('title')
Category Question

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
        /* box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px !important; */
    }

    .accordion-item:not(.active):not(:first-child) .accordion-header {
        /* border-top: none !important; */
    }

</style>
@endpush
@section('content')
<div class="row gy-4">

    <div class="col-12">
        <h3 class="card-title mb-sm-0 me-2">Category Related Questions</h3>

        <hr>
    </div>
    <div class="col-12 mb-6 mb-md-2">
        @if($faqs->count() > 0)
        <div class="card">
            <div class="accordion " id="accordionExample">
                @foreach($faqs as $faq)
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
        @else
        <p class="badge bg-label-secondary">No FAQs available for this category.</p>
    @endif
    </div>
    <div class="col-12 text-end " style="margin-top: 20px;">
        {{-- <button class="btn btn-outline-primary">I’m Satisfied</button> --}}
        <a href="{{ route('user.ticket') }}" class="btn btn-primary">Still Need help</a>
    </div>



</div>

@endsection
