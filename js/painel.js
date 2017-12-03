/*
	Main JS for painel.php
*/
var def = $('#img_large').attr('src');

//Listen click for gallery
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

//Make image hover effect
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

//Handle the buttons behavior and filesize
$('input[name=arquivo]').change(function() {
	var simple_name = $(this).val().split('\\').pop(); 
	if(simple_name == "")
		$('#btChoose').text("Selecionar");   
	else
		$('#btChoose').text(simple_name);

	//check file size limit
	var file_size = 0;
	try {
		file_size = $('#file_input')[0].files[0].size;
		if(file_size > 1000000){
			$('#file_input')[0].value = "";
			window.alert("O arquivo excede o limite máximo de 1 Mega Byte!");
			$('#btChoose').text("Selecionar"); 
		}		
	}
	catch(err) {		
		$('#file_input')[0].value = "";		
	}
});

//Choose file
$('#btChoose').click(function() {
    $('input[name=arquivo]').click();
});

//Submit file
$('#btUpload').click(function() {
    $('input[type=submit]').click();
});

//Ajax request to send the image to server
$(document).ready(function() {     
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
		var htmlStr = '<div class="sl_thumb"><img class="thumb_a" src="/img/agenda/' 
						+ resp.img 
						+ '"></div>';		
				
		$('.thumb_a').first().replaceWith(htmlStr);
		thumbClickable();
		thumbHoverable();
			
		//set uploaded image in preview
		var uploadedImage = resp.img;		
		$('#img_large').attr('src', '/img/agenda/' + uploadedImage);
		$('#pic_text').val(uploadedImage);	
			
		//Loga 
		$('#log-ul').append('<li class="w3-padding-small">Imagem \"' + uploadedImage + '"\ enviada com sucesso.</li>');
	}
	else{
		//Loga
		$('#log-ul').append('<li class="w3-padding-small">Erro: ' + resp.error + '</li>');   
		window.alert(resp.error);
	}
}


//CHANGE IMAGE ON GALLERY
$('#next_gallery').click(function() {	
	galleryPosition += 12;	
    galleryResquest(galleryPosition);	
});

$('#previous_gallery').click(function() {	
	galleryPosition -= 12;	
    galleryResquest(galleryPosition);	
});

//LOAD NEXT IMAGES ON GALLERY
function galleryResquest(position){	
	var link = 'adm_galeria.php?position=' + position;
	$("#pic_slide").load(link, function(response){
		if(response == ''){
			galleryPosition = 0;
			galleryResquest(galleryPosition);
		}
		//$('#count_gallery').html((galleryPosition+1) + "-" + (galleryPosition+12));
		thumbClickable();
		thumbHoverable();
	});		
}