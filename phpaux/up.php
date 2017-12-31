<!DOCTYPE html>
<html lang="pt-BR">
<title>ERVA MATT ADMIN PAINEL</title>
<head>
<meta charset="utf-8">       
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.videoWrapper {
	position: relative;
	padding-bottom: 56.25%; /* 16:9 */
	padding-top: 25px;
	height: 0;
}
.videoWrapper iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
.video{
    max-width:300px;
}
</style>

</head>
<body>
<div class="video">
<div class="videoWrapper">
    <!-- Copy & Pasted from YouTube -->
    <iframe id="video-id" width="560" height="349" src="http://www.youtube.com/embed/iEVsOzn2xZU?rel=0&hd=1" frameborder="0"></iframe>
</div>
<h3 id="video-title"></h3>
</div>
<p>
<div><img id="actual-thumb" src=""></div>
<input type="button" name="teste" value="Teste" onclick="videoRequest();">
    
<!--  Load jquery from cdn -->
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
</script>

<!--  Load jquery form plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<!--<script src="/js/jquery.form.js"></script>-->


<script>
    function changeVideo(newId){
        var srcVideo = $('#video-id').attr('src');
        var idInit = srcVideo.search('embed/') + 6;
        var idEnd = srcVideo.search('rel=') - 1;
        var actualId = srcVideo.substring(idInit, idEnd);        
        //newId = 'Q0oIoR9mLwc';
        srcVideo = srcVideo.replace(actualId, newId);
        $('#video-id').attr('src', srcVideo);

        var link = 'https://www.googleapis.com/youtube/v3/videos?id=';
        link += newId;
        link += '&key=AIzaSyApyjodUSvYUvqYFB3r41ebNpg_LVc9R9Q&fields=items';
        link += '(id,snippet(title),statistics)&part=snippet,statistics';
        titleRequest(link);   
        setThumb('https://img.youtube.com/vi/'+ newId +'/3.jpg');     
    }

    function titleRequest(link){
        $.ajax({
            url: link            
          }).done(function(response) {                 
            if(response.items.length > 0){
                var title = response.items[0].snippet.title;
            }
            $('#video-title').text(title);
          });
    }

    function videoRequest(){        
        var id = 'Q0oIoR9mLwc';
        changeVideo(id);        
    }

    function setThumb(url){
        $('#actual-thumb').attr('src', url);
    }

    /*
    First load of videos
    */
    $(function(){        
        videoRequest();
        
});
</script>


</script>
</body>
</html> 
