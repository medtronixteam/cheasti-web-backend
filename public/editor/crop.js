$(function() {
  // Function to update crop area size based on video dimensions
  function updateCropAreaSize() {
    var video = $('#video_player_sr'); // Get the video element
    var videoWidth = video.videoWidth;
    var videoHeight = video.videoHeight;
    
    // Set the size of the crop area based on the video dimensions
    $('#croppedArea').css({
      width: videoWidth + 'px',
      height: videoHeight + 'px'
    });
  }
  
  // Call the updateCropAreaSize function when the video is loaded
  $('#video_player_v').on('loadedmetadata', function() {
    updateCropAreaSize();
  });
  
  // Make the crop area resizable and draggable
  $('#croppedArea').resizable({
    aspectRatio: false, // maintain aspect ratio
    containment: 'parent', // restrict resizing to parent container
    start: function(event, ui) {
      // Get the dimensions of the video and the crop area
      var videoWidth = $('#video_player_v').width();
      var videoHeight = $('#video_player_v').height();
      
      // Set the maximum allowed dimensions for the crop area
      $(this).resizable('option', 'maxWidth', videoWidth);
      $(this).resizable('option', 'maxHeight', videoHeight);
    },
    stop: function(event, ui) {
      // Update the video size based on the crop area size
      var width = ui.size.width;
      var height = ui.size.height;

      
      // Update the position of the crop area
      var left = ui.position.left;
      var top = ui.position.top;
      $(this).css({
        left: left + 'px',
        top: top + 'px'
      });
       //setting box wxh
        
      
      $('#cropWidth').text(width);
      $('#cropHeight').text(height);
      convertToPercentages(width, height, ui.position.left, ui.position.top);
    }
  }).draggable({
    containment: 'parent', // restrict dragging to parent container
    drag: function(event, ui) {
      // Get the dimensions of the video and the crop area
      var videoWidth = $('#video_player_v').width();
      var videoHeight = $('#video_player_v').height();
      var cropWidth = $(this).width();
      var cropHeight = $(this).height();
      
      // Calculate the maximum allowed positions for the crop area
      var maxX = videoWidth - cropWidth;
      var maxY = videoHeight - cropHeight;
      
      // Ensure that the crop area does not go outside of the video bounds
      ui.position.left = Math.min(Math.max(ui.position.left, 0), maxX);
      ui.position.top = Math.min(Math.max(ui.position.top, 0), maxY);
    
      //setting postion topxleft in px
      $('#cropX').text(ui.position.left);
      $('#cropY').text( ui.position.top );
      convertToPercentages()
     
    }
  });
});
function convertToPercentages() {
  let croppedArea = $('#croppedArea');
  //it will get the video tag height and width
  let videoWidth = $('#video_player_v').width();
  let videoHeight = $('#video_player_v').height();


let top=$('#cropX').text();
let left=$('#cropY').text();
console.log(top,left);
  
  let widthPercentage = (croppedArea.width() / videoWidth) * 100;
  let heightPercentage = (croppedArea.height() / videoHeight) * 100;
  let leftPercentage = (top / videoWidth) * 100;
  let topPercentage = (left / videoHeight) * 100;

  convertToPixels(widthPercentage, heightPercentage, leftPercentage, topPercentage);
  console.log('width '+ widthPercentage.toFixed(2) + '%',
  'height '+ heightPercentage.toFixed(2) + '%',
  'left '+ leftPercentage.toFixed(2) + '%',
  'top '+ topPercentage.toFixed(2) + '%')
}
function convertToPixels(widthPercentage, heightPercentage, leftPercentage, topPercentage) {
 
    //get the video resolution
    let video = document.getElementById('video_player_v');
    let videoResolutionWidth = video.videoWidth;
    let videoResolutionHeight = video.videoHeight;

//convert the percentages to pixels 
  let widthPixels = (widthPercentage / 100) * videoResolutionWidth ;
  let heightPixels = (heightPercentage / 100) * videoResolutionHeight;
  let leftPixels = (leftPercentage / 100) * videoResolutionWidth ;
  let topPixels = (topPercentage / 100) * videoResolutionHeight;
  

  console.log('Video resolution: ' + videoResolutionWidth + 'x' + videoResolutionHeight);

  $('#crop_boxW').val(widthPixels);
  $('#crop_boxH').val(heightPixels);
  $('#crop_boxTop').val(leftPixels);
  $('#crop_boxLef').val(topPixels);
  console.log(
    "width "+ Math.round(widthPixels),
    "height "+ Math.round(heightPixels),
    "left "+ Math.round(leftPixels),
    "top "+ Math.round(topPixels)
  );
}
