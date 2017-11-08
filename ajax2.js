loadDynamicContent("data.php?type=agenda", updateAgenda);

loadDynamicContent("data.php?type=historia", updateHistoria);

loadDynamicContent("data.php?type=youtube", updateYoutube);

function loadDynamicContent(url, cFunction){
	var xhttp;
	if (window.XMLHttpRequest) { //For most of modern web browsers
		xhttp = new XMLHttpRequest();
		document.getElementById('sched').innerHTML = '<h4>Atualizando historia...</h4>';
		document.getElementById('hist').innerHTML = '<h4>Atualizando historia...</h4>';
		document.getElementById('video').innerHTML = '<h4>Atualizando historia...</h4>';
	}
	else if (window.ActiveXObject) { // for IE5, IE6
		xhttp = new ActiveXObject("Msxml2.XMLHTTP");
		document.getElementById('sched').innerHTML = '<h4>Atualizando historia...</h4>';
		document.getElementById('hist').innerHTML = '<h4>Atualizando historia...</h4>';
		document.getElementById('video').innerHTML = '<h4>Atualizando historia...</h4>';
	}
	else {// for stone age web browsers
		document.getElementById('sched').innerHTML = "<h4>Seu navegador não suporta este recurso</h4>";
		document.getElementById('hist').innerHTML = "<h4>Seu navegador não suporta este recurso</h4>";
		document.getElementById('video').innerHTML = "<h4>Seu navegador não suporta este recurso</h4>";
	}		

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200 && this.status < 300){
			cFunction(this);
		}
	};
	xhttp.open("GET", url, true);
	xhttp.send();
}

function updateAgenda(xhttp){
	var agenda = JSON.parse(xhttp.responseText);
	
	var html = "";
			
	for(l in agenda){
		html += agenda[l].name + " dia " + agenda[l].date + " às " + 
		agenda[l].time + " - " + agenda[l].address + 
		" <img src='/img/agenda/" + agenda[l].picture + 
		"'></img><br>";  
	}	
	document.getElementById('sched').innerHTML = html;	
}

function updateHistoria(xhttp){
	var historia = JSON.parse(xhttp.responseText);
	document.getElementById('hist').innerHTML = historia[0].text;
}

function updateYoutube(xhttp){
	var youtube = JSON.parse(xhttp.responseText);
	document.getElementById('video').innerHTML = youtube[0].video_key;
}