loadDynamicContent("data.php?type=agenda", updateAgenda);

loadDynamicContent("data.php?type=historia", updateHistoria);

loadDynamicContent("data.php?type=youtube", updateYoutube);

function loadDynamicContent(url, cFunction){
	var xhttp;
	if (window.XMLHttpRequest) { //For most of modern web browsers
		xhttp = new XMLHttpRequest();
		// document.getElementById('sched').innerHTML = '<h4>Atualizando historia...</h4>';
		// document.getElementById('hist').innerHTML = '<h4>Atualizando historia...</h4>';
		// document.getElementById('video').innerHTML = '<h4>Atualizando historia...</h4>';
	}
	else if (window.ActiveXObject) { // for IE5, IE6
		xhttp = new ActiveXObject("Msxml2.XMLHTTP");
		// document.getElementById('sched').innerHTML = '<h4>Atualizando historia...</h4>';
		// document.getElementById('hist').innerHTML = '<h4>Atualizando historia...</h4>';
		// document.getElementById('video').innerHTML = '<h4>Atualizando historia...</h4>';
	}
	else {// for stone age web browsers
		// document.getElementById('sched').innerHTML = "<h4>Seu navegador não suporta este recurso</h4>";
		// document.getElementById('hist').innerHTML = "<h4>Seu navegador não suporta este recurso</h4>";
		// document.getElementById('video').innerHTML = "<h4>Seu navegador não suporta este recurso</h4>";
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
	
	var dataSlide = '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
	var carousel = "";	
	
	count = 0;
	for(l in agenda){		
		
		if(count == 0){			
			carousel += '<div class="carousel-inner">' +
          '<div class="item active">' +
            '<img src="img/agenda/' + agenda[l].picture + '" alt="' + agenda[l].name + '" style="width:300px;">' +
            '<div class="carousel-caption">' +
              '<h3>' + agenda[l].name + '</h3>' +
              '<p>' + agenda[l].date + ' às ' + agenda[l].time  + '</p>' +
              '<p>' + agenda[l].address + '</p>' +
            '</div>' +          
		  '</div>';
			
		}
		else{
			dataSlide += '<li data-target="#myCarousel" data-slide-to="' + count + '"></li>';
			
			carousel += '<div class="item">' +          
            '<img src="img/agenda/' + agenda[l].picture + '" alt="' + agenda[l].name + '" style="width:300px;">' +
            '<div class="carousel-caption">' +
              '<h3>' + agenda[l].name + '</h3>' +
              '<p>' + agenda[l].date + ' às ' + agenda[l].time  + '</p>' +
              '<p>' + agenda[l].address + '</p>' +
            '</div>' +          
		  '</div>';			
		}		
		
		count++;
	}
	
	document.getElementById('olist').innerHTML = dataSlide;	
	$('#olist').after(carousel);
}

function updateHistoria(xhttp){
	var historia = JSON.parse(xhttp.responseText);
	historia[0].text = '<p class="recuo">' + historia[0].text + '</p>';
	$("#historia_div").html(historia[0].text);
	//document.getElementById('historia_div').innerHTML = historia[0].text;
}

function updateYoutube(xhttp){
	//var youtube = JSON.parse(xhttp.responseText);
	//document.getElementById('video').innerHTML = youtube[0].video_key;
}