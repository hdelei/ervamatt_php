<?php

include 'db_class.php';

$db = new Db();

//SELECT HISTORIA UNIQUE RECORD
if(isset($_POST['rh'])){
	$validator = $_POST['rh'];
	$m_query = "";
	if(!empty($validator)){
		//Return the last event on agenda
		$m_query = "SELECT `text` FROM `historia` WHERE `id`= 1 ;";
	}
	else{
        echo '{"error":"Consulta invalida!"}';
        return;        
	}	
	
	$result = $db->select($m_query);

	if($result){
		echo json_encode($result[0]);
	}
	else{
		echo '{"error":"Nenhum resultado para a pesquisa!"}';
	}	
}
//UPDATE HISTORIA
elseif(isset($_POST['uh'])){
	$text = $_POST['uh'];
    
    $m_query = "UPDATE `historia` SET `text` = " . $db->quote($text) . 
               " WHERE id = '1';";

    $result = $db->query($m_query);		

    echo resultCheck($result);    
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