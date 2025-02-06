@extends('layouts.app')
@push('css')
    <style>
      .btn-outline-primary-50{
        border: 0.81px solid #FF6B00;
        background: #FF6B0033 !important;
    }
    </style>
@endpush
@section('content')
<div class="row gy-4">
  
  <div class="col-12">
    <div class=" d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
      <h3 class="card-title mb-sm-0 me-2">Brand List</h3>
      <div class="action-btns">
        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addBrandModal">
          <i class="menu-icon tf-icons mdi mdi-plus"></i>
          Add Brand
      </button>
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
                <th>Brands</th>
                <th>Content/Service</th>
                <th>Date</th>
                <th>Invoice</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <tr>
                <td><i class=" tf-icons mdi mdi-image text-dark mdi-48px"></td>
                <td class="td-text-dark"> <i class=" tf-icons mdi mdi-instagram text-gray me-1"></i>Dubai Short Video upload to tiktok
                <br>  <i class=" tf-icons mdi mdi-youtube text-danger me-1"></i>Top 10 Places to visit in Dubai
                </td>
                <td>23 June, 2023</td>
                <td><span class="badge rounded-pill bg-label-success">Paid</span></td>
            </tr>
            <tr>
                <td><i class=" tf-icons mdi mdi-image text-dark mdi-48px"></td>
                <td class="td-text-dark"> <i class=" tf-icons mdi mdi-instagram text-gray me-1"></i>Dubai Short Video upload to tiktok
                <br>  <i class=" tf-icons mdi mdi-youtube text-danger me-1"></i>Top 10 Places to visit in Dubai
                </td>
                <td>29 June, 2023</td>
                <td><span class="badge rounded-pill bg-label-warning">Pending</span></td>
            </tr>
            <tr>
                <td><i class=" tf-icons mdi mdi-image text-dark mdi-48px"></td>
                <td class="td-text-dark"> <i class=" tf-icons mdi mdi-instagram text-gray me-1"></i>Dubai Short Video upload to tiktok
                <br>  <i class=" tf-icons mdi mdi-youtube text-danger me-1"></i>Top 10 Places to visit in Dubai
                </td>
                <td>21 June, 2023</td>
                <td><span class="badge rounded-pill bg-label-danger">Overdue</span></td>
            </tr>
        </tbody>
    </table>
    
     </div>
     
  </div>
  </div>

  </div>



  <div class="modal fade" id="addBrandModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form class="modal-content">
            <div class="modal-header">
                <h3 id="addBrandModalLabel">Add Brand</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col">
                        <div class="">
                            <label class="form-label" for="brandName">Brand Name</label>
                            <input type="text" class="form-control" id="brandName" placeholder="Enter Brand Name">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="">
                            <label class="form-label" for="brandServices">Brand Services</label>
                            <input type="text" class="form-control" id="brandServices" placeholder="Enter Brand Services">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label form-label-lg mt-2" for="brandLogoDropzone">Uploaded Brand Logo (Optional)</label>
                        <hr class="mt-2">
                        <div class="dropzone needsclick border-0 " id="brandLogoDropzone">
                          <div class="dz-message needsclick text-center my-0">
                              <div class="mb-2">
                                  <i class="fa-2x fas fa-cloud-upload-alt text-secondary"></i>
                              </div>
                              <p class="mb-2">Drag and Drop your files here</p>
                              <p class="mb-2">OR</p>
                              <button class="btn btn-outline-primary btn-outline-primary-50{">Upload file</button>
                          </div>
                          <div class="fallback">
                              <input name="file" type="file" />
                          </div>
                      </div>
                      
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>



@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropzone = new Dropzone('#brandLogoDropzone', {
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
</script>
@endpush
