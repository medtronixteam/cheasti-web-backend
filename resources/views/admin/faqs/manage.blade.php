@extends('layouts.app')
@section('title')
Add Faqs
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header">

        <div class="d-flex justify-content-between">
            <h3 class="font-weight-bold col-md-6">{{ isset($faq) ? 'Edit FAQ' : 'Add FAQ' }}</h3>
            <div class="text-end col-md-6"><a class="btn btn-primary" href="{{ route('admin.faqs.index') }}">FAQS</a>
            </div>
            <hr>

        </div>
    </div>
    <div class="card-body">
        <form action="{{ isset($faq) ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}" method="POST">
            @csrf
            @if(isset($faq))
            @method('PUT')
            @endif
            <div class="row form-group">
                <div class="col-sm-6">
                    <label class="form-label">Question</label>
                    <input type="text" name="question" class="form-control" placeholder="Write the Question" value="{{ old('question', $faq->question ?? '') }}" required>
                </div>
                <div class="col-sm-12 mt-2">
                    <label class="form-label">Answer</label>
                    <textarea rows="6" name="answer" class="form-control" placeholder="Write the Answer">{{ old('answer', $faq->answer ?? '') }}</textarea>
                    @error('answer')
                    <span class="text-danger">{{ $message }}</span>

                    @enderror
                </div>
                <div class="col-sm-6 mt-2">
                    <label class="form-label">Category</label>
                    <select class="form-control select2" name="category_id">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                        {!! renderCategoryOptions($category, old('category_id', $faq->category_id ?? '')) !!}
                        @endforeach
                    </select>

                </div>
                <div class="col-sm-12 mt-2">
                    <button type="submit" class="btn btn-primary float-right">{{ isset($faq) ? 'Update' : 'Save' }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

</script>
@endpush
