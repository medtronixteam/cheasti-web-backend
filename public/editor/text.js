function AddTexToVideo() {
    let textSize=$('#textSize').val();
    let textColor=$('#textColor').val();
    let textInput=$('#textInput').val();
  
    const formData = {
        textSize: textSize,
        textColor: textColor,
        textInput: textInput
    };
    
    fetch('/text/video', {
        method: 'POST',
        body: JSON.stringify(formData), // Make sure formData is properly populated
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
       
        if (data.success) {
            $('#video_player_sr').attr('src',data.output);
            document.getElementById('video_player_v').load();
            console.log('Request succeeded:', data); 
        }else{
            console.log('Request error:', data); 
        }
    
        // Log successful response data
    })
    .catch(error => {
        console.error('Request failed:', error); // Log detailed error information
    });
    
  }
  $('#textSize,#textColor,#textInput').keyup(function () {
    changeTextProperty();
  });
  $('#textSize,#textColor,#textInput').change(function () {
    changeTextProperty();
  });
 
  function changeTextProperty() {
    let textSize=$('#textSize').val();
    let textColor=$('#textColor').val();
    let textInput=$('#textInput').val();
    $('#result_text').text(textInput);
    $('#result_text').css('color',textColor);
    $('#result_text').css('font-size',textSize+"px");
  }
  $('#text_pos_x').change(function () {
    $('#result_text').css('left',$('#text_pos_x').val()+"px");
  });
  $('#text_pos_y').change(function () {
    $('#result_text').css('top',$('#text_pos_y').val()+"px");
  });
  
  
    // Make the crop area resizable and draggable
    $('#result_text').resizable({
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
          $('#text_pos_x').val(left + 'px')
          $('#text_pos_y').val(top + 'px')
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
          console.log( ui.position.left);
          $('#text_pos_x').val(ui.position.left)
          $('#text_pos_y').val(ui.position.top)
        }
      });