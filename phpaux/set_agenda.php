<?php

include 'db_class.php';

$db = new Db();

//CREATE AGENDA RECORD
if(isset($_POST['ca'])){	
	$data = json_decode($_POST['ca']);
	foreach($data as $d){
		if($d == ''){
			echo '{"error":"campo vazio!"}';
			return;
		}
	}
	
	$m_query = "INSERT INTO `agenda` 
		(
			`id`, 
			`name`, 
			`address`, 
			`date`, 
			`time`, 
			`picture`
		)
		VALUES 
		(
			'', "
			. $db->quote($data[1]) ."," 
			. $db->quote($data[2]) ."," 
			. $db->quote($data[3]) ."," 
			. $db->quote($data[4]) .","
			. $db->quote($data[5]) .");";

	$result = $db->query($m_query);
	//echo resultCheck($result);		
	echo '{"inserted_id":"'. $result .'"}';		
}
//SELECT AGENDA RECORD
elseif(isset($_POST['ra']) && is_numeric($_POST['ra'])){
	$id = $_POST['ra'];
	$m_query = "";
	if($id == -1){
		//Return the last event on agenda
		$m_query = "SELECT * FROM `agenda` WHERE `id`=(SELECT MAX(`id`) FROM `agenda`);";
	}
	else{
		$m_query = "SELECT * FROM `agenda` WHERE `id`=". $db->quote($id) .";";
	}	
	
	$result = $db->select($m_query);

	if($result){
		echo json_encode($result);
	}
	else{
		echo '{"error":"Nenhum cliente com este numero!"}';
	}
	
}
//UPDATE AGENDA
elseif(isset($_POST['ua'])){
	$data = json_decode($_POST['ua']);
	foreach($data as $d){
		if($d == ''){
			echo '{"error":"campo vazio!"}';
			return;
		}
	}
	if(is_numeric($data[0])){
		$m_query = "UPDATE `agenda` SET `name` = " . $db->quote($data[1]) . "," .
				   "`address` = " . $db->quote($data[2]) . ",".
				   "`date` = ". $db->quote($data[3]) .",".
				   "`time` = ". $db->quote($data[4]) .",".
				   "`picture` = ". $db->quote($data[5]) ." " .
				   "WHERE `id` = ". $db->quote($data[0]) .";";
			
		$result = $db->query($m_query);		
		
		echo resultCheck($result);		
	}
		//exemplo de update
		//http://localhost/phpaux/set_agenda.php
		//?ua[]=1
		//&ua[]=Bar%20CCU%20do%20Padre
		//&ua[]=Rua%20dos%20L\u00edrios%20250%20-%20Ipiranga
		//&ua[]=2017-11-28
		//&ua[]=22:31:00
		//&ua[]=cudopadre.jpg	
}
//DELETE AGENDA
elseif(isset($_POST['da']) && is_numeric($_POST['da'])){ 
	$id = $_POST['da'];
	$m_query = "DELETE FROM agenda WHERE `id` = ". $db->quote($id) .";";	
	$result = $db->query($m_query);	
	echo resultCheck($result);				
}
//GET AGENDA LIST
elseif(isset($_POST['sl']) && $_POST['sl'] == True){
	$m_query = "SELECT `date`, `name`, id FROM agenda
				ORDER BY `date` DESC
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