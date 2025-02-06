

 function loadTrimingTrack() {
    console.log('called:');
    let video = document.getElementById('video_player_v');
    const track = document.getElementById('track');

    const startArrow = document.getElementById('startArrow');
    const endArrow = document.getElementById('endArrow');
    const startLabel = document.getElementById('startLabel');
  const endLabel = document.getElementById('endLabel');
  const line = document.getElementById('line');
  var TotalWidth=0;
  let durationGap=8;
    
    // Listen for when metadata is loaded to get the video duration
    
      const duration = video.duration;
      if (duration < 10) {
        durationGap= 16;

      }else if(duration >=10 && duration < 60){
        durationGap= 12;
      }else if(duration >=60 && duration < 120){
        durationGap= 8;
      }
      else if(duration >=120 && duration < 240){
        durationGap= 8;
      }else{
        durationGap= 4;
      }
      const trackWidth = (duration * durationGap); 
      TotalWidth=trackWidth;
      // Set the width of the track based on video duration
      track.style.width = `${trackWidth}px`;
      console.log('Duration:', duration);
      // Move start arrow to the beginning
      startArrow.style.left = '0';
      
      // Move end arrow to the end
      endArrow.style.right = '0';
      endArrow.style.left = '100%';
      for (let i = 0; i <= duration; i += 10) {
        const marker = document.createElement('div');
        marker.className = 'marker';
        marker.style.left = `${(i / duration) * 100}%`;
        marker.textContent = i;
        track.appendChild(marker);
      }
      updateLabels();
     // updateLine();
     line.style.width = `100%`;
    
    function updateLabels() {
      let video = document.getElementById('video_player_v');
      const duration = video.duration;
      const trackWidth = track.offsetWidth;
      //console.log(duration*8);
     // const startTime = Math.floor((parseFloat(startArrow.style.left) / trackWidth)*duration );
      let startTime =  Math.floor((parseFloat(startArrow.style.left) * TotalWidth) / (durationGap*100));
      let endTime =  Math.floor((parseFloat(endArrow.style.left) * TotalWidth) / (durationGap*100)) ;
     // console.log("start time "+startTime);
      //const endTime = Math.floor((parseFloat(endArrow.style.left) / trackWidth) *duration);
      //console.log("end time "+endTime);
      startLabel.textContent = startTime + 's';
      endTime=endTime?endTime: Math.floor(duration);
      endLabel.textContent = endTime + 's';
    }
    function handleDrag(e, arrow) {
      e.preventDefault();
      const rect = track.getBoundingClientRect();
      let x = e.clientX - rect.left;
      
      // Ensure arrow stays within the track bounds
      if (x < 0) {
        x = 0;
      } else if (x > track.offsetWidth) {
        x = track.offsetWidth;
      }
      
      // Prevent the left arrow from crossing the midpoint
      if (arrow === startArrow && x > (track.offsetWidth / 2)) {
        x = track.offsetWidth / 2;
      }
      if (arrow === endArrow && x < (track.offsetWidth / 2)) {
        x = track.offsetWidth / 2;
      }
      
      const percentage = (x / track.offsetWidth) * 100;
      arrow.style.left = `${percentage}%`;
      updateLabels();
      updateLine();
    }
    function updateLine() {
      const Metrack = document.getElementById('track');
      const startLeft = parseFloat(startArrow.style.left) || 0;
      const endLeft = parseFloat(endArrow.style.left) || Metrack.offsetWidth;
      const lineWidth = endLeft - startLeft;
  
      line.style.left = `${startLeft}%`;
      line.style.width = `${lineWidth}%`;
    }
    
    // Event listeners for arrow dragging
    startArrow.addEventListener('mousedown', function(e) {
      isDraggingStart = true;
      document.addEventListener('mousemove', handleStartDrag);
    });
    
    endArrow.addEventListener('mousedown', function(e) {
      isDraggingEnd = true;
      document.addEventListener('mousemove', handleEndDrag);
    });
    
    document.addEventListener('mouseup', function() {
      isDraggingStart = false;
      isDraggingEnd = false;
      document.removeEventListener('mousemove', handleStartDrag);
      document.removeEventListener('mousemove', handleEndDrag);
    });
    
    function handleStartDrag(e) {
      if (isDraggingStart) {
        handleDrag(e, startArrow);
      }
    }
    
    function handleEndDrag(e) {
      if (isDraggingEnd) {
        handleDrag(e, endArrow);
      }
    }
  }
  
  function formatSeconds(seconds) {
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
