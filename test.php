<!DOCTYPE html>
<html lang="pt-BR">
<head>
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="utf-8">
<title>teste ajax request</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
#sched, #hist, #video {
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

<div id="hist"></div><p>

<div id="video"></div>

<script src="ajax2.js"></script>

</body>
</html>