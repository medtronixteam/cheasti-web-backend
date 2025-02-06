@extends('layouts.app')
@section('title')
Categories

@endsection
@section('content')
<section class="all-ticket">
    <div class="container mt-3">
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <h3 class="font-weight-bold">Categories</h3>
                <button
                type="button"
                class="btn btn-primary btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#modalCenter">
                Add Category
              </button>
                </div>
                <hr>
            </div>
    </div>
    <div class="row">

        {{-- <a href="{{ route('categories.edit', $category) }}">Edit</a>
        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form> --}}
        <!-- Category 1 -->
        @foreach($categories as $category)
        <div class="col-md-4">
          <div class="card category-card">
            <div class="card-header p-2 bg-primary">
              <h5 class="text-white mt-2"> {{ $category->name }}</h5>
            </div>
            <div class="card-body">
              <ul class="mt-0">
                @if($category->children->count())
                @foreach($category->children as $child)
                <li>{{ $child->name }} <a class="" href="javascript:void(0)" onclick=""> <i class="text-primary mdi mdi-tooltip-edit"></i> </a></li>

                @endforeach
                @else
                <li>No sub cateogry</li>
                @endif
              </ul>
            </div>
          </div>
        </div>
        @endforeach

        {{-- @foreach($categories as $category)
            <div class="col-md-4">
                <x-category :category="$category" />
            </div>
        @endforeach --}}


      </div>
    </div>

 </section>

 <!--Add Modal -->
 <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <form action="{{route('admin.categories.store')}}" method="POST">
            @csrf
        <div class="modal-header">
          <h4 class="modal-title" id="modalCenterTitle">Manage Category</h4>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-4 mt-2">
              <div class="form-floating form-floating-outline">
                <input
                  type="text"
                  id="nameWithTitle"
                  class="form-control"
                  placeholder="Enter Name" name="name" />
                <label for="nameWithTitle">Name</label>
              </div>
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <div class="form-floating form-floating-outline">
                <select name="parent_id" class="form-control" id="">
                    <option value="">No Parent</option>
                    @foreach ($categoriesAll as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <label for="emailWithTitle">Select Parent</label>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div></form>
      </div>
    </div>
  </div>
@endsection
@push('js')
<script>

</script>
@endpush
