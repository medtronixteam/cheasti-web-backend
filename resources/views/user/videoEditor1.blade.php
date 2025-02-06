

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- boxicons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="{{url('editor/assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="{{url('editor/assets/css/trim.css')}}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <title>Video Editor</title>
  <style>
    * {
      margin: 0px;
      padding: 0px;
      text-decoration: none;
      list-style: none;
      word-wrap: break-word;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    a:hover {
      text-decoration: none;
    }

    img {
      max-width: 100%;
    }

    body {
      background-color: #222;
    }

    .btn {
      min-width: 110px;
      font-size: 14px;
      border: none !important;
      border-radius: 0px;
      margin-bottom: 3px;
    }

    .btn:focus,
    .btn:active,
    .btn:hover {
      outline: none;
      box-shadow: none;
    }

    .btn-primary {
      background: #FF6B00;
      border-color: #FF6B00;
      color: white;

    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active {
      background: #888787cb;
      border-color: #201f1f;
      border: 1px solid #f7f5f5;
      color: white;

    }


    .form-control:focus {
      box-shadow: none;
      outline: none;
    }



    .bg-dark {
      color: white;
    }

    .scrollbar {
      height: 320px;
      overflow-y: scroll;
    }

    #source_ul::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
      border-radius: 10px;
      background-color: #F5F5F5;
    }

    #source_ul::-webkit-scrollbar {
      width: 12px;
      /* background-color: #F5F5F5; */
    }

    #source_ul::-webkit-scrollbar-thumb {
      border-radius: 10px;
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
      background-color: #535151;
      height: 100px;
    }

    .video_editor .source .delete {
      min-width: 5px;
    }

    .time-line-photo {
      width: 60px;
      height: 60px;
    }

    #videoContainer {
      position: relative;
    }

    #croppedArea {
      border: 2px solid #fff;
      position: absolute;
      top: 20%;
      left: 20%;
      width: 200px;
      /* set the width of the cropped area */
      height: 200px;
      /* set the height of the cropped area */
      overflow: hidden;
      /* hide overflowing content */
      pointer-events: auto;
      display: none;
    }

    #result_text {
      border: 2px solid #fff;
      position: absolute;
      top: 0%;
      left: 10%;
      display: none;
      pointer-events: auto;
    }

    .text_box {
      display: none;
      overflow: hidden;
    }

    #track {
      display: none;
    }

    .btn {
      min-width: 102px;
    }

    .video_editor .adjust {
      font-size: 11px;

    }


    .video_editor .adjust {
      font-size: 9px;

    }
  </style>
</head>

<body>
  <!-- main -->
  <main>
    <section class="mt-2 video_editor">
      <div class="container-fluid">
        <!-- Navbar -->
        <nav class="p-2 navbar-dark bg-dark">
          <div class="row">
            <div class="col-12">
              <input id="file_upload_input" class="form-control d-none" type="file" accept="video/mp4">
              <button type="button" id="file_upload_btn" class="btn btn-primary">
                <span><i class='bx bx-import mr-1'></i></span>File Upload</button>
              <button type="button" class="btn btn-primary " id="text_btn_trigger"><span><i
                    class='bx bx-edit-alt mr-1'></i></span>Text</button>
              <button type="button" class="btn btn-primary" id="trim_btn_trigger"> <span><i
                    class='bx bx-trim mr-1'></i></span>Trim</button>
              <button id="crop_btn_trigger" type="button" class="btn btn-primary"> <span><i
                    class='bx bx-crop mr-1'></i></span>Crop</button>
              <button type="button" id="save_btn" class="btn btn-primary"> <span><i
                    class='bx bx-save mr-1'></i></span>Save</button>
              <button type="button" id="upload_btn" class="btn btn-primary"><span><i
                    class='bx bx-cloud-upload mr-1'></i></span>Upload</button>

                    <a href="{{route('user.dashboard')}}" id="upload_btn" class="btn btn-primary float-right"><span><i
                        class='bx bx-cloud-upload mr-1'></i></span>Back to Home</a>

            </div>
          </div>

        </nav>
        <div class="row mt-2 ">
          <div class="col-md-4 col-12  order-md-1 order-3">
            <div class="source bg-dark p-2 fix-height">


              <div class=" " id="">
                <div id="detail_box">

                </div>
                <div class="text_box">
                  <p>Text</p>
                  <div class="row form-group">
                    <div class="col-10">

                      <label for="textInput">Enter Text</label>
                      <textarea name="" class="form-control" id="textInput">This Text Dummy Text</textarea>

                    </div>
                  </div>

                  <div class="row form-group">
                    <div class="col-5">

                      <label for="textInput">Text Color</label>
                      <input type="color" class="form-control" id="textColor">
                    </div>
                    <div class="col-5">

                      <label for="textInput">Text Size</label>
                      <input type="number" min="0" value="15" class="form-control" id="textSize">
                    </div>
                  </div>
                  <!-- <div class="row form-group">
                    <div class="col-7">
                      <label for="customRange3" class="form-label">Position X-axis</label>
                      <input type="range" class="form-range" min="0" max="330" step="0.5" id="text_pos_x">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-7">
                      <label for="customRange3" class="form-label">Position Y-axis</label>
                      <input type="range" class="form-range" min="0" max="345" step="0.5" id="text_pos_y">
                    </div>
                  </div> -->
                </div>
                <!-- end of text box -->

              </div>
              <!-- end of scrooller -->
            </div>

          </div>
          <div class="col-md-8  col-12 order-md-2 order-1">
            <div class="bg-dark p-2 fix-height">
              <div id="videoContainer">
                <video id="video_player_v" class="w-100" controls height="330">
                  <source id="video_player_sr" type="video/mp4" src="">
                </video>
                <div id="croppedArea"></div>
                <div id="result_text" style="overflow-y: auto; white-space: pre-wrap; "></div>
              </div>
              <div class="d-flex justify-content-between">

                <span> <i class="fa-solid fa-circle-pause"></i> </span>
                <p class="text-white ml-3 mt-2 adjust"> <b>Crop X :</b> <span id="cropWidth"></span> </p>
                <p class="text-white ml-3 mt-2 adjust"> <b>Crop Y :</b> <span id="cropHeight"></span> </p>
                <p class="text-white ml-3 mt-2 adjust"> <b>POS X :</b> <span id="cropX"></span> </p>
                <p class="text-white ml-3 mt-2 adjust"> <b>POS Y :</b> <span id="cropY"></span> </p>
                <p class="text-white ml-3 mt-2 adjust"> <b>Start :</b> <span id="startLabel"></span> </p>
                <p class="text-white ml-3 mt-2 adjust"> <b>End :</b> <span id="endLabel"></span> </p>
                <input type="hidden" name="crop" id="text_pos_x" value="0">
                <input type="hidden" name="crop" id="text_pos_y" value="0">


                <input type="hidden" name="crop-react" id="crop_boxW" value="0">
                <input type="hidden" name="crop-react" id="crop_boxH" value="0">
                <input type="hidden" name="crop-react" id="crop_boxTop" value="0">
                <input type="hidden" name="crop-react" id="crop_boxLef" value="0">

              </div>

            </div>
          </div>

          <div class="col-12 my-3 order-md-3 order-2">
            <div class="bg-dark ">
              <div class="bg-dark p-3 d-flex " style="overflow-x: auto;" id="timeLines">
                <div id="track">
                  <div id="startArrow" class="arrow"></div>
                  <div id="endArrow" class="arrow"></div>
                  <div id="line"></div>
                </div>
              </div>
            </div>


          </div>
        </div>



      </div>
    </section>

  </main>
  <input type="hidden" id="authKey" value="">

</body>

</html>

<script src="{{url('editor/assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{url('editor/assets/js/propper.js')}}"></script>
<script src="{{url('editor/assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('editor/assets/js/jquery-ui.min.js')}}"></script>
<script src="{{url('editor/touch.js')}}"></script>
<script src="{{url('editor/scripts.js')}}"></script>
<script src="{{url('editor/crop.js')}}"></script>
<script src="{{url('editor/trim.js')}}"></script>
<script src="{{url('editor/text.js')}}"></script>
<script>
  function getTokenValueFromCurrentURL() {
   // const urlParams = new URLSearchParams(window.location.search);
   const urlParams = new URLSearchParams(new URL(window.location).search);
  //  alert(urlParams);
    return urlParams.get('token');

  }
  const authKey ='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTcyMjMxNDQ2NywianRpIjoiNTY1MmFkMzMtMjA1Mi00ODc2LWJhMjgtNzEzZDVmMDE2NWJiIiwidHlwZSI6ImFjY2VzcyIsInN1YiI6MTgsIm5iZiI6MTcyMjMxNDQ2NywiY3NyZiI6ImE3Yzk5MmJhLWQ0MDYtNDdkMC1iOWM3LWY0YTExOTVlOGZhOSIsImV4cCI6MTcyMjQ4NzI2N30.PsAhS6LyKmynbca848spo5e5dkRV1R5GQftej6I0jJ4';

  $('#authKey').val(authKey);
  jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
  let trim_flag = localStorage.setItem('trim_flag', false);
  let text_flag = localStorage.setItem('text_flag', false);
  let crop_flag = localStorage.setItem('crop_flag', false);
  localStorage.setItem('file_name', null);
  localStorage.setItem('orignal_name', null);
  localStorage.setItem('list_remove', JSON.stringify([]));


  if (authKey == '') {
    Toast.fire({
      icon: "error",
      title: "Auth key not found."
    });
  }
  $('#crop_btn_trigger').click(function () {

    if ($('#croppedArea').css('display') == "none") {
      if (isFileAvailable()) {
        localStorage.setItem('crop_flag', true);
        $('#croppedArea').css('display', 'block');
      } else {
        Toast.fire({
          icon: "info",
          title: "No file is Selected"
        });
      }
    } else {
      localStorage.setItem('crop_flag', false);
      $('#croppedArea').css('display', 'none');

    }
  });
  $('#text_btn_trigger').click(function () {

    if ($('.text_box').css('display') == "none") {
      if (isFileAvailable()) {
        localStorage.setItem('text_flag', true);
        $('#result_text').css('display', 'block');
        $('.text_box').css('display', 'block');
        $('#detail_box').css('display', 'none');

        changeTextProperty();
      } else {
        Toast.fire({
          icon: "info",
          title: "No file is Selected"
        });
      }

    } else {

      $('#detail_box').css('display', 'block');
      localStorage.setItem('text_flag', false);
      $('#result_text').css('display', 'none');
      $('.text_box').css('display', 'none');
    }


  });
  $('#trim_btn_trigger').click(function () {

    if ($('#track').css('display') == "none") {
      if (isFileAvailable()) {
        $('#track').css('display', 'block');
        loadTrimingTrack();
        console.log($('#track').css('display'));
        localStorage.setItem('trim_flag', true);
      } else {
        Toast.fire({
          icon: "info",
          title: "No file is Selected"
        });
      }

    } else {
      localStorage.setItem('trim_flag', false);

      $('#track').css('display', 'none');
    }


  });
  $('#save_btn').click(function () {
    if (isFileAvailable()) {
      let trim_flag = localStorage.getItem('trim_flag');
      let text_flag = localStorage.getItem('text_flag');
      let crop_flag = localStorage.getItem('crop_flag');

      let trim_Data = text_Data = crop_Data = null;
      if (trim_flag == "true") {
        let new_startLabel = $('#startLabel').text();
        let new_endLabel = $('#endLabel').text();
        let videFile = localStorage.getItem('file_name');

        let start_format = formatSecondsConvert(parseInt(new_startLabel));
        let end_format = formatSecondsConvert(parseInt(new_endLabel));

        start_format = (start_format != "00:00:00") ? start_format : "00:00:01";


        trim_Data = {
          start_point: start_format,
          end_point: end_format,
          fileNewName: videFile
        };

      }
      if (text_flag == "true") {
        let textSize = $('#textSize').val();
        let textColor = $('#textColor').val();

        let textInput = $('#textInput').val();
        let text_pos_x = $('#text_pos_x').val();
        let text_pos_y = $('#text_pos_y').val();
        let video = document.getElementById('video_player_v');
        let duration = video.duration;

        text_Data = {
          textSize: textSize,
          textColor: textColor,
          textInput: textInput,
          text_pos_x: text_pos_x,
          text_pos_y: text_pos_y,
          start_point:1,
          end_point:duration
        };
      }
      if (crop_flag == "true") {

       // let cropWidth = $('#cropWidth').text();
       // let cropHeight = $('#cropHeight').text();
       // let cropX = $('#cropX').text();
       // let cropY = $('#cropY').text();

        let cropWidth=$('#crop_boxW').val();
        let cropHeight=$('#crop_boxH').val();
        let posTop=$('#crop_boxTop').val();
        let postLeft=$('#crop_boxLef').val();

        crop_Data = {
          cropHeight: cropHeight ? cropHeight : 0,
          cropWidth: cropWidth ? cropWidth : 0,
          cropX: posTop ? posTop : 0,
          cropY: postLeft ? postLeft : 0
        };

      }


      const final_data = {
        text_flag,
        text_flag,
        crop_flag,
        crop_flag,
        trim_flag,
        trim_flag,
        trim_Data,
        trim_Data,
        text_Data,
        text_Data,
        crop_Data,
        crop_Data,
        fileNewName: localStorage.getItem('file_name'),
        authKey:authKey

      };
      showLoader("Procesing Video...");

      if(authKey!=''){

      fetch('https://video.ihsancrm.com/save/video', {
          method: 'POST',
          body: JSON.stringify(final_data), // Make sure formData is properly populated
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Request failed with status ' + response.status);
          }
          return response.json(); // Assuming response is JSON
        })
        .then(data => {
          console.log(data);

          if (data.success) {
            Toast.fire({
              icon: 'info',
              title: 'Loading Video Wait a moment ',
            });
           // $('#video_player_sr').attr('src', data.output);

           localStorage.setItem('file_name',data.output);
           let files=JSON.parse(localStorage.getItem('list_remove'));
           files.push(data.output);
           localStorage.setItem('list_remove',JSON.stringify(files));

            getServerUrl(data.output);
          } else {
            Toast.fire({
              icon: 'info',
              title: 'Unable to process your request Try Again',
            });

            console.log('Request error:', data);
          }
          $('#loader').remove();
          // Log successful response data
        })
        .catch(error => {
          console.error('Request failed:', error); // Log detailed error information
        });
      }else{
        Toast.fire({
          icon: 'warning',
          title: 'Token has been expired or destory ',
        });
      }
      console.log(final_data);
    } else {
      Toast.fire({
        icon: "info",
        title: "No file is Selected"
      });
    }
  });


  function formatSecondsConvert(seconds) {
    var hours = Math.floor(seconds / 3600);
    seconds = seconds % 3600;
    var minutes = Math.floor(seconds / 60);
    var seconds = seconds % 60;

    // Ensure two-digit format for hours, minutes, and seconds
    hours = hours.toString().padStart(2, "0");
    minutes = minutes.toString().padStart(2, "0");
    seconds = seconds.toString().padStart(2, "0");

    return hours + ":" + minutes + ":" + seconds;
  }

  async function uploadToServer() {
    const { value: fileName } = await Swal.fire({
      title: "Upload your video at server",
      input: "text",
      inputLabel: "Enter Video Title",
      inputPlaceholder: "Enter title",
      showCancelButton: true,
      confirmButtonText: `
      Upload&nbsp;<i class="fa fa-arrow-up"></i>`,
    });
    if (fileName) {

    if (isFileAvailable()) {
          if (authKey != '') {
            sendFileToAPI(fileName);
          } else {
            $('#loader').remove();
            Toast.fire({
              icon: 'warning',
              title: 'Token has been expired or destory ',
            });
          }
    } else {
      Toast.fire({
        icon: "info",
        title: "No file is Selected"
      });
    }
  }else{
    Toast.fire({
      icon: "info",
      title: "Video Title is required"
    });
  }


  }
  // Function to send file to API
  function sendFileToAPI(file_name) {
    // Create FormData object
    const myHeaders = new Headers();
    myHeaders.append("Authorization", "Bearer " + authKey);

  // removing from list of same name to file name...
  let array=JSON.parse(localStorage.getItem('list_remove'));
  const index = array.indexOf(localStorage.getItem('file_name'));
if (index > -1) {
  array.splice(index, 1);
}

  // Create FormData object...
    const formdata = new FormData();
    formdata.append("orignal_name", localStorage.getItem('orignal_name'));
    formdata.append("list_remove",JSON.stringify(array));
    formdata.append("save_vidoe", localStorage.getItem('file_name'));
    formdata.append("video_title", file_name);


    console.log('form:', formdata);
    fetch(SERVER_URL+'/chesteei/v1/vidoe/upload_vidoe', {
        method: 'POST',
        body: formdata,
        headers: myHeaders,
      })
      .then(response => {
        if (!response.ok) {
          Toast.fire({
            icon: 'error',
            title: 'Unable to upload file Try Again..',
          });
        }
        return response.json();
      })
      .then(data => {
        $('#loader').remove();
        Toast.fire({
          icon: data.status,
          title: data.message
        });

        console.log('File uploaded successfully:', data);
      })
      .catch(error => {
        $('#loader').remove();
        Toast.fire({
          icon: error.status,
          title: error.message
        });
        console.error('Error uploading file:', error);
      });
  }

  $('#upload_btn').click(function () {
    uploadToServer();
  });

  $('#file_upload_btn').click(function () {
    $('#file_upload_input').trigger('click');

  })

  $('#file_upload_input').change(function () {
    var file = this.files[0];
    if (file) {
      var fileName = file.name;
      if (fileName.toLowerCase().endsWith('.mp4')) {

        Toast.fire({
          icon: 'info',
          title: 'Uploading file ',
        });
        showLoader();
        var formData = new FormData();
        var fileInput = document.getElementById('file_upload_input');
        formData.append('file', fileInput.files[0]);

        const myHeaders = new Headers();
        myHeaders.append("Authorization", "Bearer " + authKey);

        const formdata = new FormData();
        formdata.append('video', file, file.name);
        console.log('form:', formdata);
        // Make POST request using Fetch API
        if (authKey != '') {

          fetch(SERVER_URL + '/chesteei/v1/video/add', {
              method: 'POST',
              body: formdata,
              headers: myHeaders,
            })
            .then(response => {
              if (!response.ok) {

                Toast.fire({
                  icon: 'error',
                  title: 'Network response was not ok',
                });
              }

              return response.json();
            })
            .then(data => {
              if (data.Status == 200) {
                Toast.fire({
                  icon: "info",
                  title: "File Uploaded Retreving its URL ",
                });
                localStorage.setItem('file_name', data.file_name);
                localStorage.setItem('orignal_name', data.file_name);

                getServerUrl(data.file_name);

              } else {
                Toast.fire({
                  icon: "error",
                  title: "Token has been expired or destory ",
                });
              }

            })
            .catch(error => {
              $('#loader').remove();
              Toast.fire({
                icon: error.status,
                title: error.message
              });
              console.error('Error uploading file:', error);
            });
        } else {
          $('#loader').remove();
          Toast.fire({
            icon: 'error',
            title: 'Token has been expired or destoyed.',
          });
        }

      } else {
        $('#loader').remove();
        Toast.fire({
          icon: 'error',
          title: 'The selected file is either not an MP4 file or does not exist.',
        });
      }
    }


  })

  function isFileAvailable() {
    let fileNewName = $('#video_player_sr').attr('src');
    if (fileNewName != '') {
      return true;
    }
    return false;
  }



//let fileNewName='13_2024-05-16_04-38-23_text_crop.mp4';


//getServerUrl(fileNewName);
  function getServerUrl(file_name) {
    showLoader("Retrieving Video...");
    const myHeaders = new Headers();
    myHeaders.append("Authorization", "Bearer " + authKey);
    const formdata = new FormData();
    formdata.append('file_name', file_name);
    console.log('form:', formdata);
    // Make POST request using Fetch API
    fetch(SERVER_URL + '/chesteei/v1/vidoe/getservervidoes', {
        method: 'POST',
        body: formdata,
        headers: myHeaders,
      })
      .then(response => {
        if (!response.ok) {

          Toast.fire({
            icon: 'error',
            title: 'Network response was not ok',
          });
        }

        return response.blob();
      })
      .then(data => {

        const videoUrl = URL.createObjectURL(data);
        //  localStorage.setItem('file_name', data.file_name);
        $('#video_player_sr').attr('src', videoUrl);
        document.getElementById('video_player_v').load();
        $('#croppedArea,.text_box,#track').css('display','none');

        setTimeout(function () {
          loadTrimingTrack();
        },2000)
        console.log('File:', data);
        $('#loader').remove();
      })
      .catch(error => {
        $('#loader').remove();
        Toast.fire({
          icon: error.status,
          title: error.message
        });
        console.error('Error uploading file:', error);
      });


  }
</script>
