@extends('layouts.app')
@push('css')

<style>
 .form-check-input:checked {
    background-color: #20d83e !important;
    border-color: #20d83e !important;
}
</style>
@endpush
@section('content')
<div class="row gy-4">

    <div class="col-12">
        <div class=" d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h3 class="card-title mb-sm-0 me-2">Edit Ticket </h3>

        </div>
        <hr>
    </div>


    <div class="col-12">
        <div class="card mb-6">
            <h5 class="card-header">Edit Ticket</h5>
            <hr>
            <div class="card-body demo-vertical-spacing demo-only-element">

                <form action="{{ route('user.ticket.update',$ticket->ticket_id) }}" method="post">
                    @csrf
                    <div class="row">


                        <div class="col-md-6 col-lg-6 mb-5 ">
                            <div>
                                <label for="Categories" class="form-label">Question</label>
                                <input value="{{ $ticket->question }}" name="question" type="text" class="form-control" placeholder="Enter Question">
                                @error('question')
                                <span class="text-danger">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>
                     


                        <div class="col-md-8 mb-5">
                            <div>
                                <label for="reply" class="form-label"> Explain your reply ?</label>
                               <textarea value="{{ $ticket->reply }}"   name="reply" class="form-control" id="reply" rows="5" placeholder="Write your reply?">{{ $ticket->reply }}</textarea>
                               </div>
                               @error('reply')
                               <span class="text-danger">{{ $message }}</span>

                               @enderror
                        </div>

                        <div class="col-12 mt-5 text-end">

                            <button  type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                        </div>
                    </div>


                </form>




            </div>
        </div>
    </div>



</div>

@endsection
