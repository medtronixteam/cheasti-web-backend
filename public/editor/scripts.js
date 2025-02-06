  
    const SERVER_URL="https://chesti.ihsancrm.com";
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    });
    
  
      function fetchPostJ() {
        fetch('/upload', {
            method: 'POST',
            body: formData
          })
          .then(response => {
            if (response.ok) {
              return response.json();
            }
            throw new Error('File upload failed.');
          })
          .then(data => {
            document.getElementById('uploadStatus').innerText = data;
            // Call function to get session values after successful upload
            getSessionValues();
          })
          .catch(error => {
            console.error('Error:', error);
          });
        }
  
    function showLoader(textToShow="Loading...") {
      $('#loader').remove();
        $('body').append(`<div id="loader" class="d-flex justify-content-center" style=" z-index: +9999; position:absolute;top: 50%;left: 50%; transform: translate(-50%, -50%);background-color: rgba(0, 0, 0, 0.8);width: 100%;height: 100%;">
            <div style="position:absolute;top: 50%;left: 50%;" class="spinner-border text-light"></div>
            <h6 style="position:absolute;top: 60%;left: 49%;color:white">`+textToShow+`</h6>
          

        </div>`);
    }

   
    