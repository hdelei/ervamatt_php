<!DOCTYPE html>
<html lang="pt-BR">
<title>ERVA MATT ADMIN PAINEL</title>
<head>
<meta charset="utf-8">       
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/adm.css">
<link rel="stylesheet" href="/css/adm-theme-teal.css">

<style>

#video_list {        
        max-height: 278px;		
        padding:5px;                
        background-color: #eaebed;
        margin-left: 0;
        margin-right: 3px;
        margin-bottom: 5px;
        border: 1px solid lightgray;
        color:gray;    
        overflow-x: auto;
        min-width: 260px;		
		    flex: 1;		
    }
    #video_list li{
      cursor:pointer;
    }
    #video_list li:hover{
      background-color: #408c45;
      color:#FFF;
      border-radius: 3px;
    }
	@media screen and (max-width:890px) { 
		#video_list {			
			min-width:250px;
		}
	}
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
body{
    margin:20px;
}
</style>

</head>
<body>
<input id="video-id-txt" type="text" size="26" placeholder="cole o ID">
<a id="bt-insert-video" class="w3-button w3-theme w3-hover-white">Incluir</a><p>
<a id="bt-delete-video" class="w3-button w3-theme-red w3-hover-white">Deletar</a>
<div class="video">
<div class="videoWrapper">    
    <iframe id="video-id" width="560" height="349" src="http://www.youtube.com/embed/QGNsLtOa3Uo?rel=0&hd=1" frameborder="0"></iframe>
</div>
    <h3 id="video-title"></h3>
</div>
<p>
<!--<div><img id="actual-thumb" src=""></div>-->


<div id="video_list">
        <h3 class="w3-large w3-padding-small">Lista de Vídeos</h3>
        <ul id="video-ul" class="w3-ul w3-small">
            <li class="w3-padding-small video-list">Nenhum vídeo cadastrado</li>
        </ul>
        <br>                
    </div>
  </div>
    
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
    //Muda o vídeo, solicita o titulo
    function changeVideo(newId){
        var srcUrl = "http://www.youtube.com/embed/"+ newId +"?rel=0&hd=1";        
        $('#video-id').attr('src', srcUrl);

        var linkForTitle = 'https://www.googleapis.com/youtube/v3/videos?id=';
        linkForTitle += newId;
        linkForTitle += '&key=AIzaSyApyjodUSvYUvqYFB3r41ebNpg_LVc9R9Q&fields=items';
        linkForTitle += '(id,snippet(title),statistics)&part=snippet,statistics';

        titleRequest(linkForTitle);  
        
        //setThumb('https://img.youtube.com/vi/'+ newId +'/3.jpg');     
    }
    
    //Ajax request na api do Youtube
    function titleRequest(link){
        $.ajax({
            url: link            
          }).done(function(response) {                 
            if(response.items.length > 0){
                var title = response.items[0].snippet.title;
                $('#video-title').text(title);
            }            
        });
    }

    //Ajax principal de cadastro e exclusão de videos
    function videoAjaxRequest(dataStr, cbFunction){   
        $.ajax({
            type: "POST",
            url: "set_video.php",
            data: dataStr,
            cache: false,
        
            success: function(response){
                //console.log(response);
                cbFunction(response);		            
            }
        });
    }

    $('#bt-insert-video').click(function(){		
        var youtubeID = $('#video-id-txt').val();                
        //cv: create video
        videoAjaxRequest({cv:youtubeID}, cbInsertVideo);            
    });

    $('#bt-delete-video').click(function(){
        var message = "Você tem certeza que deseja Excluir o vídeo:\n\n";
        
        message += $('#video-title').text();	

        if(confirm(message) == true){
            videoAjaxRequest({dv:videoData[0]}, deleteVideo);        
        }        
    });

    function deleteVideo(response){
        resp = JSON.parse(response);    
        if('error' in resp){
            $.notify(resp.error, "error");
            $('#log-ul').append('<li class="w3-padding-small">' + resp.error +  '</li>');
            //console.log(resp);
        }
        else{
            var LAST_RECORD = "-1";
            videoAjaxRequest({rv:LAST_RECORD}, selectVideo);
            loadVideoList();  
            $.notify("Vídeo deletado com sucesso.","success");	
            $('#log-ul').append('<li class="w3-padding-small">Vídeo deletado com sucesso.</li>');	
        }      
    }



    //Callback: Insert Video
    function cbInsertVideo(response){     
        resp = JSON.parse(response);        
        if('error' in resp){
            //console.log(resp);
            $.notify(resp.error,"error");
            $('#log-ul').append('<li class="w3-padding-small">' + resp.error + '</li>');	
        }
        else if(resp.inserted_id == '0'){
            $.notify("Esse vídeo já existe!.","warn");
        }
        else{                        
            $.notify("Video adicionado com sucesso.","success");
            $('#log-ul').append('<li class="w3-padding-small">Video adicionado com sucesso.</li>');	
            loadVideoList();  
            changeVideo(resp.video_key);
        }
    }

    //Carregar a Lista de videos
    function loadVideoList(){
        videoAjaxRequest({sv:true}, cbGetVideoList);
    }

    //Global var: Lista de videos
    videoListData = [];
    
    //callback: Lista de videos
    function cbGetVideoList(response){
        resp = JSON.parse(response);
        if('error' in resp){
            $.notify(resp.error,"error");
            $('#log-ul').append('<li class="w3-padding-small">'+ resp.error +'</li>');	
        }
        else if (resp.hasOwnProperty(length)){
            videoListData = [];
            $("#video-ul").empty();
        
            for(let i in resp){
                videoListData.push(resp[i].id);                
                var item = resp[i].video_key;
                //TODO: Obter os nomes dos videos
                $('#video-ul').append('<li>' + item + '</li>')
            }
            reloadVideoListClick();
        }        
    }   
    
    //Global var: actual video
    videoData = ['1', 'QGNsLtOa3Uo'];

    //Callback Select Video
    function selectVideo(response){
        resp = JSON.parse(response);        
        if('error' in resp){
            $.notify(resp.error,"warn");
            $('#log-ul').append('<li class="w3-padding-small">'+ resp.error +'</li>');	
        }
        else{
            var temp = videoData[1];
            videoData = Object.values(resp[0]);            
            if(temp != videoData[1]){
                changeVideo(videoData[1]);
            }            	
        }        
    }    
    
    //Carregar o primeiro video
    function videoRequest(){        
        var id = 'Q0oIoR9mLwc';
        changeVideo(id);        
    }

    function setThumb(url){
        $('#actual-thumb').attr('src', url);
    }

    //Load text boxes with last video recorded
    function firstTimeLoadVideo(){
        var LAST_RECORD = "-1";
        //rv: read video
        videoAjaxRequest({rv:LAST_RECORD}, selectVideo);        
    }

    //Reload click listener for Lista de Videos
    function reloadVideoListClick(){
        $('#video-ul li').off('click');
        $('#video-ul li').click(function(){
            let videoId = $(this).index();            
            
            videoAjaxRequest({rv:videoListData[videoId]}, selectVideo);
            
	    });
    }

    /*
    First load of videos
    */
    $(function(){
        firstTimeLoadVideo();
        loadVideoList();        
        videoRequest();
        
    });
</script>

<!-- Load Notify.js-->
<script src="/js/notify.min.js"></script>


</script>
</body>
</html> 
