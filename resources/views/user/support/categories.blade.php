@extends('layouts.app')

@section('title')
Categories
@endsection

@push('css')
<style>
    .accordion-item {
        transition: 0.3s all cubic-bezier(0.4, 0, 0.2, 1);
        transition-property: margin-top, margin-bottom, border-radius, border;
        box-shadow: none !important;
        border: 0;
    }

    .accordion {
        box-shadow: none !important;
    }

    .category-card {
        box-shadow: none !important;
        box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px !important;
    }
    .accordion-button::after {

        color: white;
    }

</style>
@endpush

@section('content')
<div class="row gy-4 ">
    <div class="col-12">
        <h3 class="card-title mb-sm-0 me-2">Categories</h3>
        <hr>
    </div>

    @foreach($categories->chunk(2) as $chunk)
        @foreach($chunk as $category)
            @if($category->children->count() > 0)
                <div class="col-md-4">
                    <div class="card category-card">
                        {{-- <div class="card-header p-2 bg-primary">
                            <h5 class="text-white mt-2">{{ $category->name }}</h5>
                        </div> --}}
                        <div class="card-body">
                            <div class="accordion" id="accordion{{ $category->id }}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header  id="heading{{ $category->id }}">
                                        <button type="button" class="accordion-button collapsed py-3  " data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="false" aria-controls="collapse{{ $category->id }}">
                                            {{ $category->name }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#accordion{{ $category->id }}">
                                        <div class="accordion-body mt-3">
                                            <hr>
                                            @foreach($category->children as $child)
                                            <a class="text-dark" href="{{ route('user.category.question', ['id' => base64_encode($child->id)]) }}">
                                                <li>{{ $child->name }}</li>
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach

    <div class="col-12 text-end pt-5">
        {{-- <a class="btn btn-primary" href="{{ route('user.category.question') }}">Submit</a> --}}
    </div>
</div>
@endsection
