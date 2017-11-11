<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
#sched, #hist {
    border-radius: 10px;
    background: #73AD21;
    padding: 20px;     
	display:inline-block;    
	color:white;
	font-family: "Verdana";
}

img {
	width:30px;	
}
img:hover {
	transform: scale(3, 3); /** default is 1, scale it to 1.5 */
    opacity: 1;
}
</style>

</head>
<body>

<h1 id="h1">Testando requisição assíncrona</h1>

<div id="sched"></div><p>

<div id="hist"></div>

<script>

//agenda asynchronous request
var agr;
if (window.XMLHttpRequest) { //For most of modern web browsers
    agr = new XMLHttpRequest();
    document.getElementById('sched').innerHTML = '<h4>Atualizando agenda...</h4>';
}
else if (window.ActiveXObject) { // for IE5, IE6
    agr = new ActiveXObject("Msxml2.XMLHTTP");
    document.getElementById('sched').innerHTML = '<h4>Atualizando agenda...</h4>';
}
else {// for stone age web browsers
    document.getElementById('sched').innerHTML = "<h4>Seu navegador não suporta este recurso</h4>";
	}

agr.onreadystatechange = function () {
    if (agr.readyState < 4)   // while waiting response from server
        document.getElementById('sched').innerHTML = "Agenda carregando...";
    else if (agr.readyState === 4) { // 4 = Response from server has been completely loaded.
        if (agr.status == 200 && agr.status < 300){
			// http status between 200 to 299 are all successful
			var agenda = JSON.parse(agr.responseText);			
			
			var html = "";
			
			for(l in agenda){
				html += agenda[l].name + " dia " + agenda[l].date + " às " + 
				agenda[l].time + " - " + agenda[l].address + 
				" <img src='/img/agenda/" + agenda[l].picture + 
				"'></img><br>";  
						
			}
			document.getElementById('sched').innerHTML = html;	
			
		}		
    }
}	

agr.open('GET', 'data.php?type=agenda'); 
agr.send(null);
	
</script>


<script>
//historia asynchronous request
var hir;
if (window.XMLHttpRequest) { //For most of modern web browsers
    hir = new XMLHttpRequest();
    document.getElementById('hist').innerHTML = '<h4>Atualizando historia...</h4>';
}
else if (window.ActiveXObject) { // for IE5, IE6
    hir = new ActiveXObject("Msxml2.XMLHTTP");
    document.getElementById('hist').innerHTML = '<h4>Atualizando historia...</h4>';
}
else {// for stone age web browsers
    document.getElementById('hist').innerHTML = "<h4>Seu navegador não suporta este recurso</h4>";
	}

hir.onreadystatechange = function () {
    if (hir.readyState < 4)   // while waiting response from server
        document.getElementById('hist').innerHTML = "História carregando...";
    else if (hir.readyState === 4) { // 4 = Response from server has been completely loaded.
        if (hir.status == 200 && hir.status < 300){
			// http status between 200 to 299 are all successful
			var historia = JSON.parse(hir.responseText);			
			
			// var html = "";
			
			// for(l in agenda){
				// html += agenda[l].name + " dia " + agenda[l].date + " às " + 
				// agenda[l].time + " - " + agenda[l].address + 
				// " <img src='/img/agenda/" + agenda[l].picture + 
				// "'></img><br>";  
				//var texto = hir.responseText;
				
				document.getElementById('hist').innerHTML = historia[0].text;			
		}		
    }
}	

hir.open('GET', 'data.php?type=historia'); 
hir.send(null);


</script>

</body>
</html>