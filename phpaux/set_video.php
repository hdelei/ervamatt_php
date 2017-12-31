<?php

include 'db_class.php';

$db = new Db();

//CREATE VIDEO RECORD
if(isset($_POST['cv'])){	
	$video_key = $_POST['cv'];
	if($video_key == ''){
		echo '{"error":"campo vazio!"}';
		return;
	}	
	
	$m_query = "INSERT INTO `youtube` 
		(
			`id`, 
			`video_key`			
		)
		VALUES 
		(
			'', "
            . $db->quote($video_key)."
        );"; 
			

	$result = $db->query($m_query);
	
	echo '{"inserted_id":"'. $result .'"}';		
}
//SELECT VIDEO RECORD
elseif(isset($_POST['rv']) && is_numeric($_POST['rv'])){
	$id = $_POST['rv'];
	$m_query = "";
	if($id == -1){
		//Return the last event on agenda
		$m_query = "SELECT * FROM `youtube` WHERE `id`=(SELECT MAX(`id`) FROM `youtube`);";
	}
	else{
		$m_query = "SELECT * FROM `youtube` WHERE `id`=". $db->quote($id) .";";
	}	
	
	$result = $db->select($m_query);

	if($result){
		echo json_encode($result);
	}
	else{
		echo '{"error":"Nenhum video com este ID!"}';
	}
	
}
//DELETE VIDEO
elseif(isset($_POST['dv']) && is_numeric($_POST['dv'])){ 
	$id = $_POST['dv'];
	$m_query = "DELETE FROM `youtube` WHERE `id` = ". $db->quote($id) .";";	
	$result = $db->query($m_query);	
	echo resultCheck($result);				
}
//GET VIDEO LIST
elseif(isset($_POST['sv']) && $_POST['sv'] == True){
	$m_query = "SELECT `id`, `video_key` FROM `youtube`
				ORDER BY `id` DESC
			    LIMIT 30;";			    
	
	$result = $db->select($m_query);	
	
	if($result){		
		echo json_encode($result);
	}
	else{
		echo '{"error":"Nenhum resultado para a consulta!"}';
	}
	//echo $_GET['sl'];
}
else{
	echo '{"error":"erro de preenchimento!"}';
}

//RETURN RESULT
function resultCheck($result){ 
	if($result > 0){
		return '{"success":"Comando executado com sucesso!"}';
	}
	else{
		return '{"error":"Nenhuma modificacao foi feita!"}';
	}	
}