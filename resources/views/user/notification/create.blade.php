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
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        display: none; /* Initially hide the check icon */
}

    .image-radio input[type="radio"]:checked + .fa-image:before{
      background-color: rgba(0, 0, 0, 0.2);
    }
  </style>
    
@endpush
@section('content')
<div class="row g-8">

    <div class="col-12">
        <div class=" d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h3 class="card-title mb-sm-0 me-2">Content Scheduler</h3>
           
        </div>
        <hr>
    </div>

    <div class="col-md-6">

        <div class="card p-3">
            <div class="card-header">
                <h5 class="mb-0">Post to</h5>
                <hr class="my-1">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-5 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="facebookCheckbox">
                            <label class="form-check-label" for="facebookCheckbox">
                                Facebook
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tiktokCheckbox">
                            <label class="form-check-label" for="tiktokCheckbox">
                                Tiktok
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-5 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="youtubeCheckbox">
                            <label class="form-check-label" for="youtubeCheckbox">
                                YouTube
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="instagramCheckbox">
                            <label class="form-check-label" for="instagramCheckbox">
                                Instagram
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-6">

        <div class="card p-3">
            <div class="card-header">
              <h5  class="mb-0">Schedule</h5>
              <hr class="my-1">
            </div>
            <div class="card-body row">
                <div class="col-md-4 mb-1">
                  <label for="scheduleDate" class="form-label">Date</label>
                  <input type="date" class="form-control" id="scheduleDate" value="2023-05-25">
                </div>
                <div class="col-md-4 mb-1">
                  <label for="scheduleTime" class="form-label">Time</label>
                  <input type="time" class="form-control" id="scheduleTime" value="21:35">
                </div>
                <div class="col-md-4 mb-1">
                  <div class=" form-check mb-1">
                    <input class="form-check-input" type="checkbox" value="" id="scheduleReminder" onchange="toggleReminderSelect()">
                  <label class="form-check-label" for="scheduleReminder">
                    Reminder
                  </label>
                  </div>
                <div id="reminderSelectContainer">
                  <select class="form-select w-100 py-2" id="reminderSelect">
                    <option value="5">Before 5 minutes</option>
                    <option value="10">Before 10 minutes</option>
                    <option value="30">Before 30 minutes</option>
                    <option value="60">Before 1 hour</option>
                    <option value="120">Before 2 hours</option>
                  </select>
                </div>
                </div>
              </div>
              
          </div>
          
          

    </div>
    <div class="col-md-6">

        <div class="card p-3 dropzone needsclick" id="brandVideoDropzone">
            <div class="card-header">
                <h5  class="mb-0">Uploaded Video</h5>
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
                          <button class="btn btn-primary btn-outline-primary-50">Upload file</button>
                        </div>
                        <div class="fallback">
                          <input name="file" type="file" />
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
          
          
          

    </div>
    <div class="col-md-6">

       
          <div class="card p-3">
            <div class="card-header">
                <h5  class="mb-0">Select Thumbnail</h5>
                <hr class="my-1">
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-3 col-sm-6 mb-3">
                    <label class="image-radio" for="imageRadio1">
                      <input type="radio" id="imageRadio1" value="imageRadio1" name="thumbnail" class="d-none">
                      <i class="far fa-image fa-5x d-block mx-auto"></i>
                            <i class="fas fa-check fa-2x check-icon"></i>

                    </label>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-3">
                    <label class="image-radio" for="imageRadio2">
                      <input type="radio" id="imageRadio2" value="imageRadio2" name="thumbnail" class="d-none">
                      <i class="far fa-image fa-5x d-block mx-auto"></i>
                            <i class="fas fa-check fa-2x check-icon"></i>

                    </label>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-3">
                    <label class="image-radio" for="imageRadio3">
                      <input type="radio" id="imageRadio3" value="imageRadio3" name="thumbnail" class="d-none">
                      <i class="far fa-image fa-5x d-block mx-auto"></i>
                            <i class="fas fa-check fa-2x check-icon"></i>

                    </label>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-3">
                    <label class="image-radio" for="imageRadio4">
                      <input type="radio" id="imageRadio4" value="imageRadio4" name="thumbnail" class="d-none">
                      <i class="far fa-image fa-5x d-block mx-auto"></i>
                            <i class="fas fa-check fa-2x check-icon"></i>

                    </label>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-3">
                    <label class="image-radio" for="imageRadio5">
                      <input type="radio" id="imageRadio5" value="imageRadio5" name="thumbnail" class="d-none">
                      <i class="far fa-image fa-5x d-block mx-auto"></i>
                            <i class="fas fa-check fa-2x check-icon"></i>

                    </label>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-3">
                    <label class="image-radio" for="imageRadio6">
                      <input type="radio" id="imageRadio6" value="imageRadio6" name="thumbnail" class="d-none">
                      <i class="far fa-image fa-5x d-block mx-auto"></i>
                            <i class="fas fa-check fa-2x check-icon"></i>

                    </label>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-3">
                    <label class="image-radio" for="imageRadio7">
                      <input type="radio" id="imageRadio7" value="imageRadio7" name="thumbnail" class="d-none">
                      <i class="far fa-image fa-5x d-block mx-auto"></i>
                            <i class="fas fa-check fa-2x check-icon"></i>

                    </label>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-3">
                    <label class="image-radio" for="imageRadio8">
                      <input type="radio" id="imageRadio8" value="imageRadio8" name="thumbnail" class="d-none">
                      <i class="far fa-image fa-5x d-block mx-auto"></i>
                            <i class="fas fa-check fa-2x check-icon"></i>

                    </label>
                  </div>
                </div>
              </div>
              
          </div>
          
          

    </div>

    <div class="col-md-6">
        <label for="videoTitle" class="form-label pb-3">Title of Video</label>
        <div class="form-floating form-floating-outline mb-6">
            <textarea class="form-control  h-px-150 bg-white" id="videoTitle" rows="25" placeholder="Write the title of the Video" spellcheck="false" data-ms-editor="true">Our Dubai Trip, we had so much fun and learned about the culture</textarea>
            <label for="videoTitle">Write the title of the Video</label>
          </div>
        
      </div>
        <div class="col-md-6">
            <label for="videoDescription" class="form-label pb-3">Description of Video</label>
          <div class="form-floating form-floating-outline mb-6">
            <textarea class="form-control  h-px-150 bg-white" id="videoDescription" rows="3" placeholder="Write the Description of the Video" spellcheck="false" data-ms-editor="true"></textarea>
          </div>
        </div>


        <div class="col-md-12">

            <div class="card p-3">
                <div class="card-header">
                    <h5 class="mb-0">Write Caption / Text</h5>
                    <hr class="my-1">
                </div>
                <div class="card-body">
                    <textarea class="form-control  h-px-150 bg-white"  rows="3" id="caption_or_text" name="caption_or_text" spellcheck="false" data-ms-editor="true">Our Dubai Trip, we had so much fun and learned about the culture</textarea>

                </div>

            </div>
    
        </div>

        <div class="col-md-12">
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary me-3" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
      

</div>
@endsection


@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropzone = new Dropzone('#brandVideoDropzone', {
            url: '/file/upload', // Change this to your file upload URL
            maxFiles: 1,
            maxFilesize: 5, // in MB
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
    $('.Select2').select2({
    // Options if needed
  });
  $('.image-radio input[type="radio"]').change(function() {
    let checkIcon = $('.check-icon');
    checkIcon.hide(); // Hide all check icons
    if ($(this).prop('checked')) {
      $(this).siblings('.check-icon').show(); // Show check icon for the selected radio button
    }
});
});


</script>
@endpush