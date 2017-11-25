/*
	Main JS for painel.php
*/

var def = $('#img_large').attr('src');

//Change image on click perform
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

//Change image hover effect
function thumbHoverable(){
	$('.thumb_a').hover(function(){    
		var img1 = $(this).attr('src');
		$('#img_large').attr('src', img1);
		}, function(){    
		$('#img_large').attr('src', def);
	});
}

thumbClickable();
thumbHoverable();    

//Ainda não implementado
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

// wait for the DOM to be loaded 
$(document).ready(function() {     
    $('#upIMage').ajaxForm({                 
		complete: function(xhr) {				
			manageResponse(xhr.responseText);	
			console.log(xhr.responseText)
		},			
		error: function(xhr){				
			xhr.responseText = '{"error":"Erro desconhecido! Se o problema persistir, contate o administrador."}';
		}
    }); 
});
	
//Gerencia a resposta da requisição de upload de imagem
function manageResponseOld(response){
	var resp = JSON.parse(response);	
		
	if(!("error" in resp)){
		var htmlStr = "";
		for (i in resp){			
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
		//Loga
		$('#log-ul').append('<li class="w3-padding-small">Erro: ' + resp.error + '</li>');   
		window.alert(resp.error);
	}
}

function manageResponse(response){
	var resp = JSON.parse(response);	
		
	if(!("error" in resp)){
		var htmlStr = '<div class="sl_thumb"><img class="thumb_a" src="/img/agenda/' 
						+ resp.img 
						+ '"></div>';
		console.log(htmlStr);
		
		$('#pic_slide').append(htmlStr);
		thumbClickable();
		thumbHoverable();
			
		//set uploaded image in preview
		uploadedImage = resp.img;
		$('#img_large').attr('src', '/img/agenda/' + uploadedImage);
		$('#pic_text').val(uploadedImage);
	
		//corrige a margem após o upload
		$('.sl_thumb').css('margin-right','5px');
			
		//Loga 
		$('#log-ul').append('<li class="w3-padding-small">Imagem \"' + uploadedImage + '"\ enviada com sucesso.</li>');
	}
	else{
		//Loga
		$('#log-ul').append('<li class="w3-padding-small">Erro: ' + resp.error + '</li>');   
		window.alert(resp.error);
	}
}