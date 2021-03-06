<?php

$auth = parse_ini_file('users.ini');
$valid_passwords = array ($auth['user1'] => $auth['pass1'], $auth['user2'] => $auth['pass2']);
$valid_users = array_keys($valid_passwords);

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
  header('WWW-Authenticate: Basic realm="My Realm"');
  header('HTTP/1.0 401 Unauthorized');
  die ("Not authorized");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<title>ERVA MATT ADMIN PAINEL</title>
<head>
<meta charset="utf-8">       
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/adm.css">
<link rel="stylesheet" href="/css/adm-theme-teal.css">
<!--<link rel="stylesheet" href="/css/font-awesome.min.css">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
<style>
    #pic_slide {        
        max-height: 260px;
		max-width:96%;
        background-color: gainsboro;        
        overflow: auto;
		margin: 5px;
		padding: 5px;
    }    
    #pic_slide > div {
        display: inline-block;		
        }    
    .sl_thumb{
        width: 60px; 
        height: 60px;
		margin-right:0;
		margin-top:2px;
    }
	.thumb_a {
        max-width: 100%;
        max-height: 100%;    
		opacity: 0.8;		
    }
    .thumb_a:hover {
     opacity:1;	 
     transition:500ms;
    }	
	#pic_name {
        width: auto;
        height: 30px;
        background-color: whitesmoke;        
    }    
    #form_agenda, #preview_agenda {
        display:inline-block;
        padding:5px;                
        background-color: #eaebed;
        margin-left: 0;
        margin-right: 10px;
        margin-bottom: 5px;
        border: 1px solid lightgray;
        color:gray;    
        /*overflow: auto; */
		    flex: 1;
    }    
    #show_list {        
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
    #show_list li{
      cursor:pointer;
    }
    #show_list li:hover{
      background-color: #408c45;
      color:#FFF;
      border-radius: 3px;
    }
	@media screen and (max-width:890px) { 
		#show_list {			
			min-width:250px;
		}
	}    
  #agenda_container{
    display:flex;
    flex-wrap: wrap;        
  }    
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
  margin:auto;
  max-width:400px;
  min-width:150px;
}
.txt-boxes{
  padding:7px 3px;
  display:inline-block;  
  vertical-align:middle;
}

</style>    
</head>
<body>

<div class="w3-sidebar w3-collapse w3-white w3-animate-left w3-large" style="z-index:3;width:300px;" id="mySidebar">

<div class="w3-bar w3-black w3-center">
  <a class="w3-bar-item w3-button" style="width:33.33%" href="javascript:void(0)" 
	onclick="openNav('nav01')" title="Menu principal">
  <i class="fa fa-bars w3-xlarge"></i></a>  
  <a class="w3-bar-item w3-button" style="width:33.33%" href="javascript:void(0)" 
	onclick="openNav('nav02')" title="Upload de imagens">
  <i class="fa fa-upload w3-xlarge"></i></a>
  <a class="w3-bar-item w3-button" style="width:33.33%" href="javascript:void(0)" 
	onclick="openNav('nav03')" title="Log">
  <i class="fa fa-file w3-xlarge"></i></a>
</div>

<div id="nav01" class="w3-bar-block">
  <a class="w3-button w3-hover-teal w3-hide-large w3-large w3-right" href="javascript:void(0)" onclick="w3_close()">×</a>
  <a class="w3-bar-item w3-button w3-border-bottom w3-large" href="http://www.ervamatt.com.br" target="_blank"><img src="/img/devon.png" style="width:80%;"></a>
  <a class="w3-bar-item w3-button" href="#agenda">Agenda de shows</a>
  <a class="w3-bar-item w3-button" href="#historia">História da banda</a>
  <a class="w3-bar-item w3-button" href="#youtube">Vídeos do Youtube</a>  
</div>

<div id="nav02">
	<div style="padding:5px">
	Selecione uma imagem:
	</div>	
  <!--<a class="w3-bar-item w3-button" target="_blank" href="tryw3css_templates_black.htm">
  <img src="/img/agenda/1.jpg" style="width:100%;"></a>-->
	
  <div id="pic_slide">
  <?php 
	$_GET['position'] = 0;
	include 'adm_galeria.php'
	?>	
       <!-- <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/1.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/2.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/3.jpg"></div>-->
    </div>
	<div style="padding-left:5px;padding-right:5px;text-align:center;">
	<div id="previous_gallery" class="w3-button w3-theme-d5 w3-hover-blue" style='display:inline-block;'>
		<i class="fa fa-arrow-left" aria-hidden="true"></i>	
	</div>
	<!--<div id="count_gallery" style='display:inline-block;text-align:center;'>1-2</div>-->
	<div id="next_gallery" class="w3-button w3-theme-d5 w3-hover-blue" style='display:inline-block;'>
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
	</div>
	</div>
	
	<div style="padding:5px">
	Ou envie uma imagem nova: <p>
	<form id="upIMage" method="post" enctype="multipart/form-data" action="recebeUpload.php">		
		<a id="btChoose" class="w3-button w3-theme-d5 w3-hover-green" name="arquivo" type="file">Selecionar</a>
		<input id="file_input" name="arquivo" type="file" style="display:none;"/><p>		
		<input type="submit" value="Upload" style="display:none;" />
		<a id="btUpload" class="w3-button w3-theme-d5 w3-hover-green" type="submit">Upload</a>
	</form>
	</div>
	
</div>

<div id="nav03">
  <div class="w3-container w3-border-bottom">
    <h1 class="w3-text-theme">LOG</h1>	
  </div>
  <ul id="log-ul" class="w3-ul w3-small">  
   <li class="w3-padding-small"><h3 class="w3-text-theme">registro de ações:</h1></li>
  </ul>
</div>
</div>

<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<div class="w3-main" style="margin-left:300px;"> 

<div class="w3-top w3-theme w3-large w3-hide-large">
  <i class="fa fa-bars w3-button w3-teal w3-xlarge" onclick="w3_open()"></i>
</div>

<header class="w3-container w3-theme w3-padding-small w3-center">
  <h1 class="w3-xxxlarge w3-padding-16">Banda Erva Matt</h1>
  <h3 class="w3-xxxmedium w3-padding-16">Painel de administração</h3>
</header>

<div id="agenda" class="w3-container w3-padding-large w3-section w3-light-grey">
  <h1 class="w3-jumbo">Agenda</h1>
  <p class="w3-large">Cadastre seus próximos shows</p>
  
  <p class="w3-large">
  <p><div id="agenda_container">
    <div id="form_agenda">
        Local:<br><input id="local_text" type="text" size="26" placeholder="digite o nome"><br>
        Data:<br><input id="datePicker" type="date" value="" ><br>
        Hora:<br><input id="timePicker" type="time" value="20:00" ><br>
        Endereço:<br><input id="address_text" type="text" size="26" placeholder="digite o endereço"><br>
        Imagem:<br><input id="pic_text" type="text" size="26" placeholder="selecione abaixo" readonly="true"><br>                  
        <!--<input type="file" name="pic" accept="image/*">-->
    </div>
    <div id="preview_agenda">
        <img id="img_large" style="padding-left:5px;max-width: 255px;margin-left:auto;margin-right:auto;display:block;" src="/img/agenda/empty.jpg">
        <br>                
    </div>
    
    <div id="show_list">
        <h3 class="w3-large w3-padding-small">Lista de shows</h3>
        <ul id="show-ul" class="w3-ul w3-small">
            <li class="w3-padding-small event-list">Sem eventos nos próximos dias</li>
        </ul>
        <br>                
    </div>
  </div>  
  
  <div>
	<a id="bt-insert" class="w3-button w3-theme w3-hover-white">Incluir</a>
	<a id="bt-update" class="w3-button w3-theme-d4 w3-hover-white">Atualizar</a>
	<a id="bt-delete" class="w3-button w3-theme-red w3-hover-white">Deletar</a>
    <a class="w3-button w3-theme-d1 w3-hover-white" href="javascript:void(0)" onclick="w3_open();openNav('nav02')">Foto</a>
  </div>    
</div>

<div id="historia" class="w3-container w3-padding-large w3-section w3-light-grey">
  <h1 class="w3-jumbo">História</h1>
  <p class="w3-xlarge">Fale sobre a banda Erva Matt</p>
  <a id="bt-historia-edit" class="w3-button w3-theme w3-hover-white">Editar</a>
  <a id="bt-historia-save" class="w3-button w3-theme-d4 w3-hover-white">Salvar</a>

  <p><div id="historia-text" class="w3-code jsHigh notranslate" contentEditable="false">
    História não definida
  </div>  
</div>

<div id="youtube" class="w3-container w3-padding-large w3-section w3-light-grey">
  <h1 class="w3-jumbo">Vídeos</h1>
  <p class="w3-large">Cadastre seus vídeos</p>
  
  <p class="w3-large"><p>
    <div id="agenda_container">
      <div id="form_agenda">                
          <div class="video">
            <div class="videoWrapper">    
              <iframe id="video-id" width="560" height="349" 
              src="http://www.youtube.com/embed/QGNsLtOa3Uo?rel=0&hd=1" frameborder="0"></iframe>                
            </div>
            <h3 id="video-title">Teste de titulo</h3><br>
            <a id="bt-delete-video" class="w3-button w3-theme-red w3-hover-white">Deletar</a>
          </div>
        </div>
      <div id="video_list">
        <h3 class="w3-large w3-padding-small">Lista de Vídeos</h3>
        <ul id="video-ul" class="w3-ul w3-small">
          <li class="w3-padding-small video-list">Nenhum vídeo cadastrado</li>
        </ul>
        <br>                
      </div>
    </div>     
    <input id="video-id-txt" class="txt-boxes" type="text" size="35" placeholder="Cole o link aqui">
    <a id="bt-insert-video" class="w3-button w3-theme w3-hover-white">Incluir</a><br>
</div>

<footer class="w3-container w3-padding-large w3-light-grey w3-justify w3-opacity">
  <p><nav>
  <div class="w3-button w3-hover-black" style="position:static; padding:2px; color:#090000; margin:auto;">
	  Desenvolvido por Dev<span style="color:green; font-weight: bold;">O</span>n
  </div>
  <!--<a href="#" target="_blank">FORUM</a> |
  <a href="#" target="_top">ABOUT</a>-->
  </nav></p>
</footer>

</div>

<script>
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
openNav("nav01");
function openNav(id) {
    document.getElementById("nav01").style.display = "none";
    document.getElementById("nav02").style.display = "none";
    document.getElementById("nav03").style.display = "none";
    document.getElementById(id).style.display = "block";
}
</script>
    
<!--  Load jquery from cdn -->
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
</script>

<!--  Load jquery form plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<!--<script src="/js/jquery.form.js"></script>-->

<!-- Load Notify.js-->
<script src="/js/notify.min.js"></script>

<!--  Load main javascript -->
<script src="/js/painel.js"></script>

<script type="text/javascript" src="/js/jquery.lazyloadxt.min.js"></script>
	
	<script>
		$.extend($.lazyLoadXT, {
			selector: 'img',
			srcAttr: 'src',
		});	
	</script>
	
	
	<script>
		galleryPosition = 0;
	</script>

</body>
</html> 