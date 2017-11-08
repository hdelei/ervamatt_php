	//var video = ['8hZ2nIWfN5A', 'NfYvYZsG-_s', 'nMUfsQEv4sU'];
    var video = ['8hZ2nIWfN5A'];
	var actualVideo = 0;
	
	// 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
	  
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '100%',
          width: '100%',		  
          videoId: video[0],
		  playerVars: {'rel': 0}
        });
		
      }
	  
      function stopVideo() {
        player.stopVideo();
      }	
		
	function proxVideo(){
		actualVideo = actualVideo + 1;
		if(actualVideo > -1 && actualVideo < video.length){						
			player.cueVideoById(video[actualVideo]);	
				
		}		
		else if (actualVideo <= video.length){
			actualVideo = 0;
			player.cueVideoById(video[actualVideo]);
		}
		
	}
	
	function antVideo(){
		actualVideo = actualVideo - 1;
		if(actualVideo > -1 && actualVideo < video.length){						
			player.cueVideoById(video[actualVideo]);
			
		}
		else if (actualVideo < 0){
			actualVideo = video.length - 1;
			player.cueVideoById(video[actualVideo]);
		}
	}
	
	