<?php

if($_GET['type'] == 'agenda'){ //Retorna a agenda de shows
	include 'get_agenda.php';
	
	//Array if no data is returned
	$empty_agenda = array(
	array(
		"name" => "SEM SHOWS POR ENQUANTO...", 
		"date" => "<a href='https://www.facebook.com/erva.matt.5'>contate-nos</a>", 
		"time" => "",
		"address" => "",
		"picture" => "empty.jpg"
		)
	);

	//json encode result
	$agenda_json = "";
	if (!$agenda_empty){
		$agenda_json = json_encode($agenda_array);
	}
	else{
		$agenda_json = json_encode($empty_agenda);
	}

	//debugging porpouses
	//sleep(1);	

	//return result
	echo $agenda_json;
}
else if($_GET['type'] == 'historia'){	//Retorna a história da banda
	include 'get_historia.php';
	
	//debugging porpouses
	//sleep(1);
		
	if($historia_empty){
		$empty_historia = array(
			array(
				"text" => "Ocorreu um erro. Não há uma história..."		
			)
	);
		echo json_encode($empty_historia);
	}
	else{
		echo json_encode($historia_row);
	}
}
else if($_GET['type'] == 'youtube'){	//Retorna os vídeos do youtube
	include 'get_video.php';
	
	//debugging porpouses
	//sleep(1);
		
	if($video_empty){
		$empty_video = array(
			array(
				"text" => "Ocorreu um erro. Não há vídeos..."		
			)
	);
		echo json_encode($empty_video);
	}
	else{
		echo json_encode($video_row);
	}
}
else{
	echo "<h1>Você esqueceu o parâmetro: type=agenda, type=historia ou type=youtube</h1>";
}

?>