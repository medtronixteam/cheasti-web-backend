@extends('layouts.app')
@section('title')
Faqs
@endsection
@section('content')
<section class="FAQ-list">
    <div class="container mt-3">
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <h3 class="font-weight-bold">FAQ Listing</h3>
                    <div><a class="btn btn-primary float-right" href="{{ route('admin.faqs.create') }}">Add FAQ</a>
                    </div>

                </div>
                <hr>
            </div>
        </div>
        @foreach($faqs as $faq)
        <div class="card p-4 border-0 my-3">
            <div class="row">
                <div class="col-12 d-flex justify-content-between my-1">
                    <div>
                        <h5 class="font-weight-bold mb-0">{{ $faq->question }}</h5>
                        <p>Category Name : <span style="color: rgb(11, 70, 109)"> {{ $faq->category->name }}</span></p>

                        <p>{{ $faq->answer }}</p>

                    </div>
                    <div class="d-flex">
                        <span> <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-warning mx-1">Edit</a>
                        </span>
                        <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        @endforeach


        <div class="d-flex justify-content-center mt-5">
            {{ $faqs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
@endsection
