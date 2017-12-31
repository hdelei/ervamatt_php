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
			$.notify("O arquivo excede o limite máximo de 1 Mega Byte!", "warn");
			//window.alert("O arquivo excede o limite máximo de 1 Mega Byte!");
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
		$.notify("Imagem enviada com sucesso", "success");
	}
	else{
		//Loga
		$('#log-ul').append('<li class="w3-padding-small">Erro: ' + resp.error + '</li>');   
		$.notify(resp.error, "error");
		//window.alert(resp.error);
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
		thumbClickable();
		thumbHoverable();
	});		
}

/* --------------------------------------------------
*	À partir daqui inicia-se o CRUD da agenda de shows
*/

data = [
	"1", 
	"Novo Evento", 
	"Rua 1", 
	"2017/03/01", 
	"10:20:00", 
	"porao.jpg"
];
showListData = [];

//Main ajax
function command(dataStr, cbFunction){   
$.ajax({
	type: "POST",
	url: "set_agenda.php",
	data: dataStr,
	cache: false,

	success: function(response){
		//console.log(response);
		cbFunction(response);		            
	}
});
}

// $('#bt-select').click(function(){	
// 	//data[0] = $('#c_id').val();//provisório
// 	command({ra:data[0]}, selectShow);           
// });

$('#bt-update').click(function(){
	data[1] = $('#local_text').val();
	data[3] = $('#datePicker').val();
	data[4] = $('#timePicker').val();
	data[2] = $('#address_text').val();
	data[5] = $('#pic_text').val();
	var jsonString = JSON.stringify(data);
	command({ua:jsonString}, updateShow);	
});

$('#bt-delete').click(function(){
	var message = "Você tem certeza que deseja Excluir o evento:\n\n";
	var dt = formatDateTime(data[3], data[4]);
	message += data[1] + '\n';
	message += data[2] + '\n';
	message += dt.date + ' às ' + dt.time;        

	if(confirm(message) == true){
		command({da:data[0]}, deleteShow);        
	}        
});

$('#bt-insert').click(function(){		
	data[1] = $('#local_text').val();
	data[3] = $('#datePicker').val();
	data[4] = $('#timePicker').val();
	data[2] = $('#address_text').val();
	data[5] = $('#pic_text').val();
	var jsonString = JSON.stringify(data);
	command({ca:jsonString}, insertShow);    
});

//Callback Delete
function deleteShow(response){
	resp = JSON.parse(response);    
	if('error' in resp){
		$.notify(resp.error, "error");
		$('#log-ul').append('<li class="w3-padding-small">' + resp.error +  '</li>');
		//console.log(resp);
	}
	else{
		var LAST_RECORD = "-1";
		command({ra:LAST_RECORD}, selectShow);
		LoadShowList();  
		$.notify("Evento deletado com sucesso.","success");	
		$('#log-ul').append('<li class="w3-padding-small">Evento deletado com sucesso.</li>');	
	}      
}

//Callback Select
function selectShow(response){
resp = JSON.parse(response);
if('error' in resp){
	$.notify(resp.error,"warn");
	$('#log-ul').append('<li class="w3-padding-small">'+ resp.error +'</li>');	
}
else if (resp.hasOwnProperty(length)){
	data = Object.values(resp[0]);
	//console.log(resp);    
	updateTextBox(data);	
}        
}

//Callback Insert
function insertShow(response){
	//console.log(response);
	resp = JSON.parse(response);
	if('error' in resp){
		//console.log(resp);
		$.notify(resp.error,"warn");
		$('#log-ul').append('<li class="w3-padding-small">' + resp.error + '</li>');	
	}
	else{                
		data[0] = resp.inserted_id;
		LoadShowList();  
		$.notify("Evento adicionado com sucesso.","success");
		$('#log-ul').append('<li class="w3-padding-small">Evento adicionado com sucesso.</li>');	
	}        
}

//Callback Update
function updateShow(response){    
	resp = JSON.parse(response);
	if('error' in resp){
		//console.log(resp);
		$.notify(resp.error,"error");
		$('#log-ul').append('<li class="w3-padding-small">'+ resp.error +'</li>');	
	}
	else{
		LoadShowList();          
		$.notify("Evento atualizado com sucesso.","success");
		$('#log-ul').append('<li class="w3-padding-small">Evento atualizado com sucesso.</li>');	
	}        
}

//CallBack to get show List
function getShowList(response){
resp = JSON.parse(response);
if('error' in resp){
	$.notify(resp.error,"error");
	$('#log-ul').append('<li class="w3-padding-small">'+ resp.error +'</li>');	
}
else if (resp.hasOwnProperty(length)){
	showListData = [];
	$("#show-ul").empty();

	for(let i in resp){
		showListData.push(resp[i].id);
		var dt = formatDateTime(resp[i].date, "00:00:00");
		var item = dt.date + " - " + resp[i].name;
		$('#show-ul').append('<li>' + item + '</li>')
	}
	reloadListClick();
	}        
}

//Update Textboxes on agenda changes
function updateTextBox(data){    
$('#local_text').val(data[1]);
$('#datePicker').val(data[3]);
$('#timePicker').val(data[4]);
$('#address_text').val(data[2]);
$('#pic_text').val(data[5]);  
$('#img_large').attr('src', '/img/agenda/' + data[5]);
}

/**
*Get the date time for brazilian format
*
*@param {String} date - the date in international format
* [Example] 1980-12-29
*@param {String} time [Example] 22:15:01
*@returns {Object} dt with two keys: dt.date and dt.time
*/
function formatDateTime(date, time){
var d = new Date(date + 'T' + time);    
month = '' + (d.getMonth() + 1);    
day = '' + (d.getDate());
year = d.getFullYear();
hour = '' + d.getHours();
minute = '' + d.getMinutes(); 

if (month.length < 2) month = '0' + month;
if (day.length < 2) day = '0' + day;
if (hour.length < 2) hour = '0' + hour;
if (minute.length < 2) minute = '0' + minute;

var dt = {date:[day, month, year].join('/')};
dt.time = [hour, minute].join(':');    
return dt;    
}

//Load text boxes with last event recorded
function firstTimeLoadAgenda(){
var LAST_RECORD = "-1";
command({ra:LAST_RECORD}, selectShow);
}

//load last 30 events in agenda to lista de shows
//Call getshowList() as callback
function LoadShowList(){
command({sl:true}, getShowList);   
}

//Reload click listener for Lista de Shows
function reloadListClick(){
	$('#show-ul li').off('click');
	$('#show-ul li').click(function(){
		//When clicked, update textboxes 
		let eventId = $(this).index(); 
		command({ra:showListData[eventId]}, selectShow);        
	});
}

/*
	Início da sessão de atualização da história
*/

$('#bt-historia-edit').click(function() {
	$('#historia-text').attr('contentEditable', true);
	$('#bt-historia-edit').text('Edição desbloqueada');
	$('#historia-text').focus();        
});

$('#bt-historia-save').click(function() {	     
	var text = $('#historia-text').html();
	text = text.replace(/<div>/gi, '<p class="recuo">');
	text = text.replace(/<\/div>/gi, '<p/>');
	commandHistoria({uh:text}, cbUpdateHistoria);        
});

//Update Historia callback
function cbUpdateHistoria(response){    
	resp = JSON.parse(response);
	if('error' in resp){            
		$.notify(resp.error,"error");
		$('#log-ul').append('<li class="w3-padding-small">'+ resp.error +'</li>');	
	}
	else{                  
		$.notify("Historia tualizada com sucesso.","success");
		$('#log-ul').append('<li class="w3-padding-small">Historia atualizada com sucesso.</li>');
		$('#historia-text').attr('contentEditable', false);        
		$('#bt-historia-edit').text('Editar');	
	}
}   

function loadHistoria(){
	commandHistoria({rh:true}, cbLoadHistoria);
}

function cbLoadHistoria(response){
	resp = JSON.parse(response);
	if('error' in resp){
		$('#log-ul').append('<li class="w3-padding-small">Error ao carregar história.</li>');	
	}            
	else{		
		$('#historia-text').html(resp.text);
	}
}

function commandHistoria(dataStr, cbFunction){   
	$.ajax({
		type: "POST",
		url: "set_historia.php",
		data: dataStr,
		cache: false,

		success: function(response){            
			cbFunction(response);	           	            
		}
	});
}


//Document Ready for first load of page
$(function(){
	firstTimeLoadAgenda();
	LoadShowList();
	loadHistoria();                
});