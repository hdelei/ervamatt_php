loadDynamicContent("phpaux/data.php?type=agenda", updateAgenda);

loadDynamicContent("phpaux/data.php?type=historia", updateHistoria);

loadDynamicContent("phpaux/data.php?type=youtube", updateYoutube);

function loadDynamicContent(url, cFunction) {
	var xhttp;
	if (window.XMLHttpRequest) { //For most of modern web browsers
		xhttp = new XMLHttpRequest();
		waitMessage(url);
	}
	else if (window.ActiveXObject) { // for IE5, IE6
		xhttp = new ActiveXObject("Msxml2.XMLHTTP");
		waitMessage(url);
	}
	else {// for stone age web browsers
		document.getElementById('sched').innerHTML = "<h4>Seu navegador não suporta este recurso</h4>";
		document.getElementById('hist').innerHTML = "<h4>Seu navegador não suporta este recurso</h4>";
		document.getElementById('player').innerHTML = "<h4>Seu navegador não suporta este recurso</h4>";
	}

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200 && this.status < 300) {
			cFunction(this);
		}
	};
	xhttp.open("GET", url, true);
	xhttp.send();
}

function waitMessage(url) {
	if (url.indexOf('agenda') !== -1) {
		document.getElementById('agenda_title').innerHTML = 'Carregando Agenda...';
	}
	else if (url.indexOf('historia') !== -1) {
		document.getElementById('historia_title').innerHTML = 'Carregando História...';
	}
	else if (url.indexOf('youtube') !== -1) {
		document.getElementById('videos_title').innerHTML = 'Carregando Vídeos...';
	}
}

function updateAgenda(xhttp) {
	var agenda = JSON.parse(xhttp.responseText);

	var dataSlide = '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
	var carousel = "";

	count = 0;
	for (l in agenda) {

		if (count == 0) {
			carousel += '<div class="carousel-inner">' +
				'<div class="item active">' +
				'<img src="img/agenda/' + agenda[l].picture + '" alt="' + agenda[l].name + '" style="width:300px;">' +
				'<div class="carousel-caption">' +
				'<h3>' + agenda[l].name + '</h3>' +
				'<p>' + agenda[l].date + ' às ' + agenda[l].time + '</p>' +
				'<p>' + agenda[l].address + '</p>' +
				'</div>' +
				'</div>';

		}
		else {
			dataSlide += '<li data-target="#myCarousel" data-slide-to="' + count + '"></li>';

			carousel += '<div class="item">' +
				'<img src="img/agenda/' + agenda[l].picture + '" alt="' + agenda[l].name + '" style="width:300px;">' +
				'<div class="carousel-caption">' +
				'<h3>' + agenda[l].name + '</h3>' +
				'<p>' + agenda[l].date + ' às ' + agenda[l].time + '</p>' +
				'<p>' + agenda[l].address + '</p>' +
				'</div>' +
				'</div>';
		}

		count++;
	}

	document.getElementById('olist').innerHTML = dataSlide;
	$('#olist').after(carousel);

	document.getElementById('agenda_title').innerHTML = 'Agenda';
}

function updateHistoria(xhttp) {
	var historia = JSON.parse(xhttp.responseText);
	historia[0].text = '<p class="recuo">' + historia[0].text + '</p>';
	$("#historia_div").html(historia[0].text);

	document.getElementById('historia_title').innerHTML = 'História';
}

var video = [];
function updateYoutube(xhttp) {
	json_video = JSON.parse(xhttp.responseText);

	for (v in json_video) {
		video.push(json_video[v].video_key);
	}
	document.getElementById('videos_title').innerHTML = 'Vídeos';

	//Load the youtube iframe after ajax response
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}

var actualVideo = 0;
// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
//firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;
// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
function onYouTubeIframeAPIReady() {
	player = new YT.Player('player', {
		height: '100%',
		width: '100%',
		videoId: video[0],
		playerVars: { 'rel': 0 }
	});
}

function stopVideo() {
	player.stopVideo();
}

function proxVideo() {
	actualVideo = actualVideo + 1;
	if (actualVideo > -1 && actualVideo < video.length) {
		player.cueVideoById(video[actualVideo]);

	}
	else if (actualVideo <= video.length) {
		actualVideo = 0;
		player.cueVideoById(video[actualVideo]);
	}
}

function antVideo() {
	actualVideo = actualVideo - 1;
	if (actualVideo > -1 && actualVideo < video.length) {
		player.cueVideoById(video[actualVideo]);

	}
	else if (actualVideo < 0) {
		actualVideo = video.length - 1;
		player.cueVideoById(video[actualVideo]);
	}
}