<?php

include 'db_class.php';

$db = new Db();

//UPDATE 
// $m_query = 'UPDATE agenda SET address = "Avenida Francisco Junqueira",' .
		   // 'time = "00:59:00"'.
		   // 'WHERE name= "Bar Cu do Padre";';
// $result = $db->query($m_query);


//DELETE
// $m_query = 'DELETE FROM agenda WHERE name = "Bar Oasis";';
// $result = $db->query($m_query);


//INSERT
// $m_query = 'INSERT INTO agenda (id, name, address, date, time, picture)' .
		   // 'VALUES ("", "Bar Oasis", "Rua 3", "2017-12-04", "15:00:00",' .
		   // '"1.jpg");';

// $result = $db->query($m_query);


//SELECT		   
$m_query = 'SELECT * FROM agenda';

$result = $db->select($m_query);

//print_r($result);

// if ($result){
	// foreach($result as $r){
		// echo "json ". json_encode($r) ;
		// echo '<br> array ';
		// print_r($r);
	// }
	// //echo json_encode($result);
// }
// else{
	// echo json_encode(array('error'=>'Nenhum resultado para exibir'));
// }



// // Our database object
// $db = new Db();    

// // Quote and escape form submitted values
// $name = $db -> quote($_POST['username']);
// $email = $db -> quote($_POST['email']);

// // Insert the values into the database
// $result = $db -> query("INSERT INTO `users` (`name`,`email`) VALUES (" . $name . "," . $email . ")");

if(isset($_GET['ca'])){//CREATE AGENDA
	print_r($_GET['ca']);	
}
elseif(isset($_GET['ra']) && is_numeric($_GET['ra'])){//SELECT AGENDA
	$id = $_GET['ra'];
	$m_query = 'SELECT * FROM `agenda` WHERE `id` = '.$id.';';
	$result = $db->select($m_query);
	echo json_encode($result);	
}
elseif(isset($_GET['ua']) && is_numeric($_GET['ua'][0])){//UPDATE AGENDA
	$data = $_GET['ua'];
	$m_query = 'UPDATE agenda SET name = "'. $data[1] .'",' .
		   'address = "'. $data[2] .'",'.
		   'date = "'. $data[3] .'",'.
		   'time = "'. $data[4] .'",'.
		   'picture = "'. $data[5] .'" '.
		   'WHERE id = '. $data[0] .';';
	
	$result = $db->query($m_query);
	
	echo resultCheck($result);
	
	//exemplo de update
	//http://localhost/phpaux/set_agenda.php
	//?ua[]=1
	//&ua[]=Bar%20CCU%20do%20Padre
	//&ua[]=Rua%20dos%20L\u00edrios%20250%20-%20Ipiranga
	//&ua[]=2017-11-28
	//&ua[]=22:31:00
	//&ua[]=cudopadre.jpg
	
	//print_r($_GET['ua']);	
}
elseif(isset($_GET['da']) && is_numeric($_GET['da'])){
	print_r($_GET['da']);	
}

function resultCheck($result){
	if($result > 0){
		return '{"success":"Comando executado com sucesso!"}';
	}
	else{
		return '{"error":"Nenhum modificação foi feita!"}';
	}
	
}






