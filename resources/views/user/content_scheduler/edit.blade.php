@extends('layouts.app')

@push('css')
<style>
  .image-radio {
    position: relative;
    display: block;
    cursor: pointer;
  }

  .image-radio input[type="radio"] {
    position: absolute;
    visibility: hidden;
  }

  .check-icon {
    background-color: rgba(0, 0, 0, 0.5);
    position: absolute;
    top: 50%;
    left: 40%;
    transform: translate(-50%, -50%);
    color: white;
    display: none;
  }

  .image-radio input[type="radio"]:checked+.fa-image:before {
    background-color: rgba(0, 0, 0, 0.2);
  }

  .is-invalid {
    border-color: #e3342f;
  }

  .invalid-feedback {
    display: block;
  }
</style>
@endpush

@section('content')
<form action="{{ route('user.content.update', $content->video_id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="row g-8">

    <div class="col-12">
      <div class=" d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
        <h3 class="card-title mb-sm-0 me-2">Edit Content Scheduler</h3>
      </div>
      <hr>
    </div>

    <div class="col-md-6">
      <div class="card p-3">
        <div class="card-header">
          <h5 class="mb-0">Post to*</h5>
          <hr class="my-1">
        </div>
        <div class="card-body">
          <div class="row">
            {{-- @foreach(['facebook', 'tiktok', 'youtube', 'instagram'] as $platform)
              <div class="col-md-6 col-lg-5 mb-1">
                <div class="form-check">
                  <input class="form-check-input @error('platforms') is-invalid @enderror" name="platforms[]" value="{{ $platform }}" type="checkbox" id="{{ $platform }}Checkbox" @if(in_array($platform, json_decode($content->platforms))) checked @endif>
                  <label class="form-check-label" for="{{ $platform }}Checkbox">{{ ucfirst($platform) }}</label>
                </div>
              </div>
            @endforeach --}}

            @foreach(['facebook', 'tiktok', 'youtube', 'instagram'] as $platform)
              <div class="col-md-6 col-lg-5 mb-1">
                <div class="form-check">
                  <input class="form-check-input platform-radio @error('platforms') is-invalid @enderror" name="platforms" value="{{ $platform }}" type="radio" id="{{ $platform }}Checkbox" @if(in_array($platform, json_decode($content->platforms))) checked @endif>
                  <label class="form-check-label" for="{{ $platform }}Checkbox">{{ ucfirst($platform) }}</label>
                </div>
              </div>
            @endforeach

          </div>
          @error('platforms')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>
    
    <!-- Categories Section -->
    <div class="col-md-6">
      <div class="card p-3">
        <div class="card-header">
              <h5 class="mb-0">Video Category*</h5>

          <hr class="my-1">
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-12">
              <div class="form-group">
                
              <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                <option disabled>Select Content Category</option>
                  @foreach($categories as $category)
                      <option value="{{ $category->id }}" data-platform="{{ $category->platform }}" @if(old('category', $content->category) == $category->id) selected @endif>{{ $category->name }}</option>
                  @endforeach
              </select>
                @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="col-md-12">
      <div class="card p-3">
        <div class="card-header">
          <h5 class="mb-0">Schedule*</h5>
          <hr class="my-1">
        </div>
        <div class="card-body row">
          @php
              // Get current date and time
              $currentDate = date('Y-m-d');
          @endphp
          <div class="col-md-4 mb-1">
            <label for="scheduleDate" class="form-label">Date</label>
            <input type="date" class="form-control @error('schedule_date') is-invalid @enderror" id="scheduleDate" name="schedule_date" value="{{ old('schedule_date', \Carbon\Carbon::parse($content->scheduled_at)->format('Y-m-d')) }}" min="{{ $currentDate }}">
            @error('schedule_date')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-4 mb-1">
            <label for="scheduleTime" class="form-label">Time</label>
            <input type="time" class="form-control @error('schedule_time') is-invalid @enderror" id="scheduleTime" name="schedule_time" value="{{ old('schedule_time', \Carbon\Carbon::parse($content->scheduled_at)->format('H:i')) }}">
            @error('schedule_time')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-4 mb-1">
            <div class="form-check mb-1">
              <input class="form-check-input" type="checkbox" value="" id="scheduleReminder" onchange="toggleReminderSelect()" @if(old('reminder') || $content->reminder) checked @endif>
              <label class="form-check-label" for="scheduleReminder">Reminder</label>
            </div>
            <div id="reminderSelectContainer">
              <select class="form-select w-100 py-2 @error('reminder') is-invalid @enderror" id="reminderSelect" name="reminder" @if(!old('reminder') && !$content->reminder) disabled @endif>
                <option value="5" @if(old('reminder', $content->reminder) == 5) selected @endif>Before 5 minutes</option>
                <option value="10" @if(old('reminder', $content->reminder) == 10) selected @endif>Before 10 minutes</option>
                <option value="30" @if(old('reminder', $content->reminder) == 30) selected @endif>Before 30 minutes</option>
                <option value="60" @if(old('reminder', $content->reminder) == 60) selected @endif>Before 1 hour</option>
                <option value="120" @if(old('reminder', $content->reminder) == 120) selected @endif>Before 2 hours</option>
              </select>
              @error('reminder')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card p-3 dropzone needsclick" id="brandVideoDropzone">
        <div class="card-header">
          <div class="row align-items-center">
          <div class="col-md-12">
            <h5 class="mb-0">Uploaded Video*</h5>
          </div>
          </div>
          <hr class="my-1">
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col">
              <div>
                <div class="dz-message needsclick text-center my-2">
                  <div class="mb-2">
                    <i class="fa-2x fas fa-cloud-upload-alt text-secondary"></i>
                  </div>
                  <p class="mb-2">Drag and Drop your files here</p>
                  <p class="mb-2">OR</p>
                  <button type="button" class="btn btn-primary btn-outline-primary-50">Upload file</button>
                </div>
                <div class="fallback">
                  <input name="file_path" type="file" accept="video/*" class="form-control @error('file_path') is-invalid @enderror" />
                  @error('file_path')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          @if($content->file_path)
            <div class="row mb-3">
              <div class="col">
                <video width="100%" controls>
                  <source src="{{ asset('storage/' . $content->file_path) }}" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card p-3">
        <div class="card-header">
          <h5 class="mb-0">Select Thumbnail*</h5>
          <hr class="my-1">
        </div>
        <div class="card-body">
          <div class="row">
            @for ($i = 1; $i <= 8; $i++)
              <div class="col-md-3 col-sm-6 mb-3">
                <label class="image-radio" for="imageRadio{{ $i }}">
                  <input type="radio" id="imageRadio{{ $i }}" value="imageRadio{{ $i }}" name="thumbnail" class="d-none @error('thumbnail') is-invalid @enderror" @if(old('thumbnail', $content->thumbnail) == 'imageRadio' . $i) checked @endif>
                  <i class="far fa-image fa-5x d-block mx-auto"></i>
                  <i class="fas fa-check fa-2x check-icon"></i>
                </label>
                @error('thumbnail')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            @endfor
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <label for="videoTitle" class="form-label pb-3">Title of Video*</label>
      <div class="form-floating form-floating-outline mb-6">
        <textarea class="form-control h-px-150 bg-white @error('title') is-invalid @enderror" id="videoTitle" name="title" rows="25" placeholder="Write the title of the Video" spellcheck="false">{{ old('title', $content->title) }}</textarea>
        <label for="videoTitle">Write the title of the Video</label>
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="col-md-6">
      <label for="videoDescription" class="form-label pb-3">Description of Video*</label>
      <div class="form-floating form-floating-outline mb-6">
        <textarea class="form-control h-px-150 bg-white @error('description') is-invalid @enderror" id="videoDescription" name="description" rows="3" placeholder="Write the Description of the Video" spellcheck="false">{{ old('description', $content->description) }}</textarea>
        @error('description')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="col-md-12">
      <div class="card p-3">
        <div class="card-header">
          <h5 class="mb-0">Write Caption / Text</h5>
          <hr class="my-1">
        </div>
        <div class="card-body">
          <textarea class="form-control h-px-150 bg-white @error('caption_or_text') is-invalid @enderror" rows="3" id="caption_or_text" name="caption_or_text" spellcheck="false">{{ old('caption_or_text', $content->caption) }}</textarea>
          @error('caption_or_text')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>

      <!-- Tags Input -->
      <div class="col-md-12">
        <label for="tags" class="form-label pb-3">Tags</label>
        <div class="form-floating form-floating-outline mb-6">
          <select class="form-control h-px-150 @error('tags') is-invalid @enderror" id="tags" name="tags[]" multiple="multiple">
            @if(old('tags', $content->tags))
            @foreach(explode(',', old('tags', $content->tags)) as $tag)
              <option value="{{ $tag }}" selected>{{ $tag }}</option>
            @endforeach
          @endif
          </select>
          @error('tags')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

    <div class="col-md-12">
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary me-3">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>

  </div>
</form>
@endsection

@push('js')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    new Dropzone('#brandVideoDropzone', {
      url: '/file/upload',
      maxFiles: 1,
      maxFilesize: 5,
      acceptedFiles: 'video/*', // Restrict to video files
      addRemoveLinks: true,
      init: function() {
        this.on("success", function(file, response) {
          console.log("File uploaded successfully");
        });
        this.on("error", function(file, response) {
          console.log("File upload error");
        });
      }
    });
  });

  $(document).ready(function() {
    $('.Select2').select2();
    $('.image-radio input[type="radio"]').change(function() {
      $('.check-icon').hide();
      if ($(this).prop('checked')) {
        $(this).siblings('.check-icon').show();
      }
    });

    $('#tags').select2({
      tags: true,
      tokenSeparators: [',', ' '],
      placeholder: 'Add tags',
      allowClear: true,
      maximumInputLength: 500

    });
  });

  function toggleReminderSelect() {
    const reminderSelectContainer = $('#reminderSelectContainer');
    const reminderSelect = $('#reminderSelect');

    if ($('#scheduleReminder').is(':checked')) {
      reminderSelect.prop('disabled', false); // Enable the select dropdown
    } else {
      reminderSelect.prop('disabled', true); // Disable the select dropdown
    }
  }


  // Event listener for platform radio buttons
  $('.platform-radio').on('change', function() {
            var selectedPlatform = $(this).val();
            filterCategories(selectedPlatform);
        });

        function filterCategories(platform) {
            $('#category option').each(function() {
                var optionPlatform = $(this).data('platform');
                
                if (optionPlatform === platform || !platform) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('#category').val(''); // Reset category selection
        }

       // Initial filter on page load
       var initialSelectedPlatform = $('.platform-radio:checked').val();
        if (initialSelectedPlatform) {
            filterCategories(initialSelectedPlatform);
        }
</script>
@endpush
