@extends('layouts.app')
@section('title','Shorts Generator')
@section('content')
<h3>
    Shorts Generator
</h3>
<div class="card">
    <div class="card-body">
        <form action="" method="POST" id="mainForm">
            <div class="row form-group">
                <div class="col-sm-6">
                    <label for="url" class="form-label">Enter Youtube Url </label>
                    <input type="text" class="form-control" name="url" id="url" placeholder="Enter Url">
                    <span class="text-warning"> <b>Please Note </b> : Only Youtube Url that have Captions (Subtitles)</span>
                </div>
                <div class="col-sm-5">
                    <br>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card mt-2">
<div class="card-body">

</div>
</div>
    <!--/ row -->


  </div>

@endsection

@push('js')
<script>
    $('#mainForm').on('submit',function name(event) {

        event.preventDefault();

        const urlInput = document.getElementById('url').value;
        $('form').find("button[type='submit']").prop('disabled', true);
        $('form').find("button[type='submit']").text('Submiting....');

        // fetch('/api/shorts', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //     },
        //     body: JSON.stringify({ url: urlInput })
        // })
        // .then(response => response.json())
        // .then(data => {
        //     console.log('Success:', data);
        //     // Handle the response data here
        // })
        // .catch((error) => {
        //     console.error('Error:', error);
        //     // Handle the error here
        // });
    });
    </script>
@endpush
