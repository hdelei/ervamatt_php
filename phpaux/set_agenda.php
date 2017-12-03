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

print_r($result);

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