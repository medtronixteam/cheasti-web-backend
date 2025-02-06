@extends('layouts.app')
@section('title')
Content-Scheduler

@endsection
@push('css')

<link rel="stylesheet" href="{{url('assets/vendor/libs/sweetalert2/sweetalert2.css')}}">
<style>
    .icon-instagram {
        background: linear-gradient(45deg,
                #405DE6,
                #5851DB,
                #833AB4,
                #C13584,
                #E1306C,
                #FD1D1D,
                #F56040,
                #F77737,
                #FCAF45,
                #FFDC80);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

</style>
@endpush
@section('content')
<div class="row gy-4">

    <div class="col-12">
        <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h3 class="card-title mb-sm-0 me-2">Content Scheduler</h3>
            <div class="action-btns">
                <a href="{{ route('user.content.create') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="menu-icon tf-icons mdi mdi-plus"></i>
                    Add Content
                </a>
            </div>
        </div>
        <hr>
    </div>

    <div class="col-12">
        <div class="card p-3">
            <div class="table-responsive text-nowrap mb-5">
                <table class="table">
                    <thead>
                        <tr class="h5 text-capitalize">
                            <th>Content/Service</th>
                            <th>Social Media</th>
                            <th>Attachments</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($contents as $content)
                        <tr>
                            <td>{{ $content->title }}</td>
                            <td>
                                <p class="mb-0">
                                    @foreach ($content->platforms as $platform)
                                    @php
                                    $iconClass = '';
                                    $iconColor = '';
                                    switch ($platform) {
                                    case 'facebook':
                                    $iconClass = 'fab fa-facebook-square';
                                    $iconColor = 'color: #3b5998;'; // Facebook blue color
                                    break;
                                    case 'tiktok':
                                    $iconClass = 'fab fa-tiktok';
                                    $iconColor = 'color: #000000;'; // TikTok blue color
                                    break;
                                    case 'youtube':
                                    $iconClass = 'fab fa-youtube';
                                    $iconColor = 'color: #ff0000;'; // YouTube red color
                                    break;
                                    case 'instagram':
                                    $iconClass = 'fa-brands fa-square-instagram icon-instagram';
                                    // $iconColor = 'color: #e4405f;'; // Instagram pink color
                                    break;
                                    default:
                                    $iconClass = 'fab fa-globe';
                                    $iconColor = 'color: #888;'; // Default color for unknown platforms
                                    break;
                                    }
                                    @endphp
                                    <i class="{{ $iconClass }} mx-1" style="{{ $iconColor }} font-size:21px"></i>
                                    @endforeach
                                </p>
                            </td>


                            <td>{{ $content->attachments ? 'Yes' : 'No' }}</td>
                            <td>{{ \Carbon\Carbon::parse($content->scheduled_at)->format('d F, Y') }}</td>
                            <td>
                                @if ($content->status === 'uploaded')
                                <span class="badge rounded-pill bg-label-success"><i class="fas fa-check me-1"></i>Uploaded</span>
                                @else
                                <span class="badge rounded-pill bg-label-danger"><i class="fas fa-dot-circle me-1"></i>Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('user.content.edit', $content->video_id) }}" class="text-danger text-opacity-75 pe-1 border-2 border-end border-danger"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('user.content.destroy', $content->video_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn p-0 text-danger delete_content_btn"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{url('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.delete_content_btn').on('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?'
                , text: "You won't be able to revert this!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonText: 'Yes, delete it!'
                , customClass: {
                    confirmButton: "btn btn-danger"
                    , cancelButton: "btn btn-success"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
    });

</script>

@endpush
