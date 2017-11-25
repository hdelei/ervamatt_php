<!DOCTYPE html>
<html lang="pt-BR">
<title>ERVA MATT ADMIN PAINEL</title>
<head>
<meta charset="utf-8">       
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/adm.css">
<link rel="stylesheet" href="/css/adm-theme-teal.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    
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
	@media screen and (max-width:890px) { 
		#show_list {			
			min-width:250px;
		}
	}
    
    #agenda_container{
        display:flex;
        flex-wrap: wrap;
        
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
	
  <!--<a class="w3-bar-item w3-button" target="_blank" href="tryw3css_templates_black.htm"><img src="/img/agenda/1.jpg" style="width:100%;"></a>
  <a class="w3-bar-item w3-button" target="_blank" href="tryw3css_examples_album.htm"><img src="img_demo_summer.jpg" style="width:100%;"></a>
  <a class="w3-bar-item w3-button" target="_blank" href="tryw3css_examples_blog.htm"><img src="img_demo_blog.jpg" style="width:100%;"></a>-->
  
  <div id="pic_slide">
	<?php include 'adm_galeria.php' ?>
       <!-- <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/1.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/2.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/3.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/1.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/2.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/3.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/1.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/2.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/3.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/1.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/2.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/3.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/1.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/2.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/3.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/1.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/2.jpg"></div>
        <div class="sl_thumb"><img class="thumb_a" src="/img/agenda/3.jpg"></div>-->
    </div>
	
	<div style="padding:5px">
	Ou envie uma imagem nova: <p>
	<form id="upIMage" method="post" enctype="multipart/form-data" action="recebeUpload.php">		
		<a id="btChoose" class="w3-button w3-theme-d5 w3-hover-green" name="arquivo" type="file">Selecionar</a>
		<input name="arquivo" type="file" style="display:none;"/><p>		
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
        Local:<br><input type="text" size="26" placeholder="digite o nome"><br>
        Data:<br><input id="datePicker" type="date" value="" ><br>
        Hora:<br><input id="timePicker" type="time" value="20:00" ><br>
        Endereço:<br><input type="text" size="26" placeholder="digite o endereço"><br>
        Imagem:<br><input id="pic_text" type="text" size="26" placeholder="selecione abaixo" readonly="true"><br>                  
        <!--<input type="file" name="pic" accept="image/*">-->
    </div>
    <div id="preview_agenda">
        <img id="img_large" style="padding-left:5px;max-width: 255px;margin-left:auto;margin-right:auto;display:block;" src="/img/agenda/empty.jpg">
        <br>                
    </div>
    
    <div id="show_list">
        <h3 class="w3-large w3-padding-small">Lista de shows</h3>
        <ul class="w3-ul w3-small">
            <li class="w3-padding-small">10/03/1981 - Santa Brasa</li>
            <li class="w3-padding-small">10/03/1981 - Porão do Rock</li>
            <li class="w3-padding-small">10/03/1981 - Favela Chik</li>
            <li class="w3-padding-small">10/03/1981 - Santa Brasa</li>
            <li class="w3-padding-small">10/03/1981 - João Rock</li>
            <li class="w3-padding-small">10/03/1981 - Santa Brasa</li>
            <li class="w3-padding-small">10/03/1981 - Porão do Rock</li>
            <li class="w3-padding-small">10/03/1981 - Favela Chik</li>
            <li class="w3-padding-small">10/03/1981 - Santa Brasa</li>
            <li class="w3-padding-small">10/03/1981 - João Rock</li>
        </ul>
        <br>                
    </div>
	
	<p>
	<a class="w3-button w3-theme w3-hover-white" onclick="addShow()">Incluir</a>
	<a class="w3-button w3-theme-d4 w3-hover-white" onclick="updateShow()">Atualizar</a>
	<a class="w3-button w3-theme-red w3-hover-white" onclick="deleteShow()">Deletar</a>
    <a class="w3-button w3-theme-d1 w3-hover-white" href="javascript:void(0)" onclick="w3_open();openNav('nav02')">Foto</a>
    
  </div>   
    
</div>

<div id="historia" class="w3-container w3-padding-large w3-section w3-light-grey">
  <h1 class="w3-jumbo">História</h1>
  <p class="w3-xlarge">Fale sobre a banda Erva Matt</p>
  <a href="/js/default.asp" class="w3-button w3-theme w3-hover-white">LEARN JS</a>
  <a href="/jsref/default.asp" class="w3-button w3-theme w3-hover-white">JS REFERENCE</a>

  <p><div class="w3-code jsHigh notranslate">
   // Click the button to change the color of this paragraph<br><br>function myFunction() {<br>
      var x;<br>
      x = document.getElementById("demo");<br>
      x.style.fontSize = "25px"; <br>
      x.style.color = "red"; <br>}
  </div>
  <a class="w3-button w3-theme w3-hover-white" href="/js/tryit.asp?filename=tryjs_default" target="_blank">Try it Yourself</a>
</div>

<div id="youtube" class="w3-container w3-padding-large w3-section w3-light-grey">
  <h1 class="w3-jumbo">Vídeos</h1>
  <p class="w3-xlarge">Sua lista de vídeos do Youtube</p>
  <a class="w3-button w3-theme w3-hover-white" href="/css/default.asp">LEARN CSS</a>
  <a class="w3-button w3-theme w3-hover-white" href="/cssref/default.asp">CSS REFERENCE</a>
  <p class="w3-large">
  <p><div class="w3-code cssHigh notranslate">
  body {<br>
      background-color: #d0e4fe;<br>}<br>h1 {<br>
      color: orange;<br>
      text-align: center;<br>}<br>p {<br>
      font-family: "Times New Roman";<br>
      font-size: 20px;<br>}
  </div>
  <a class="w3-button w3-theme w3-hover-white" href="/css/tryit.asp?filename=trycss_default" target="_blank">Try it Yourself</a>
</div>

<footer class="w3-container w3-padding-large w3-light-grey w3-justify w3-opacity">
  <p><nav>
  <a href="/forum/default.asp" target="_blank">FORUM</a> |
  <a href="/about/default.asp" target="_top">ABOUT</a>
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
<script src="https://www.w3schools.com/lib/w3codecolor.js"></script>
<script>
w3CodeColor();
</script>
    
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
</script>
    
<script>
//Change image on click perform
var def = $('#img_large').attr('src');

function thumbClickable(){
	$('.thumb_a').click(function(){
		var imgName = $(this).attr('src');
		def = imgName;
		$('#img_large').attr('src', imgName);
		//console.log(imgName);
		imgName = imgName.split('\/');    
		$('#pic_text').val(imgName[imgName.length-1]);
		//blink color of background
		setTimeout(function(){
			$('#pic_text').css('background-color', 'white');;
		}, 1200);
		$('#pic_text').css('background-color', '#4dff4d');
	});	
}

function thumbHoverable(){
	//Change image hover effect
	$('.thumb_a').hover(function(){    
		var img1 = $(this).attr('src');
		$('#img_large').attr('src', img1);
		}, function(){    
		$('#img_large').attr('src', def);
	});
}

thumbClickable();
thumbHoverable();
    

function addShow(){
    window.alert("Show adicionado");
}
function updateShow(){
    window.alert("Show atualizado");
}
function deleteShow(){
    window.alert("Show deletado");
}
    
//set default date and time for agenda
var now = new Date();
var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);
var today = now.getFullYear()+"-"+(month)+"-"+(day);
$('#datePicker').val(today);

//Upload de imagens
$('input[name=arquivo]').change(function() {
	simple_name = $(this).val().split('\\').pop(); 
	if(simple_name == "")
		$('#btChoose').text("Selecionar");   
	else
		$('#btChoose').text(simple_name);   
});

$('#btChoose').click(function() {
    $('input[name=arquivo]').click();
});

$('#btUpload').click(function() {
    $('input[type=submit]').click();
});
    
</script>

<!--<script src="http://malsup.github.com/jquery.form.js"></script> -->
<script src="/js/jquery.form.js"></script>

<script> 
    // wait for the DOM to be loaded 
    $(document).ready(function() { 
        // bind 'myForm' and provide a simple callback function 
        $('#upIMage').ajaxForm({                 
			complete: function(xhr) {				
				manageResponse(xhr.responseText);				
			},			
			error: function(xhr){				
				xhr.responseText = '{"error":"Erro desconhecido! Se o problema persistir, contate o administrador."}';
			}
        }); 
    });
	
	function manageResponse(response){
		var resp = JSON.parse(response);	
		
		if(!("error" in resp)){
			var htmlStr = "";
			for (i in resp){
				//console.log(resp[i]);
				htmlStr += '<div class="sl_thumb"><img class="thumb_a" src="/img/agenda/' + resp[i] + '"></div>';				
			}			
			$('#pic_slide').html(htmlStr);
			thumbClickable();
			thumbHoverable();
			
			//set uploaded image in preview
			uploadedImage = $('#btChoose').text().toLowerCase();
			$('#img_large').attr('src', '/img/agenda/' + uploadedImage);
			$('#pic_text').val(uploadedImage);
			
			//corrige a margem após o upload
			$('.sl_thumb').css('margin-right','5px');
			
			//Loga 
			$('#log-ul').append('<li class="w3-padding-small">Imagem \"' + uploadedImage + '"\ enviada com sucesso.</li>');
		}
		else{
			$('#log-ul').append('<li class="w3-padding-small">Erro: ' + resp.error + '</li>');   
			window.alert(resp.error);
		}
	}
</script> 

<script>
	
</script>

</body>
</html> 
