  
 <?php

 //id and password for database
 include 'connection_data.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
	echo "Erro de conexão";
    die("Connection failed: " . $conn->connect_error);
} 

//Date comparison
$getDate = getdate(date("U"));
$formDate = date_create("$getDate[year]-$getDate[mon]-$getDate[mday]");
$today = date_format($formDate, "Y-m-d");
date_add($formDate, date_interval_create_from_date_string("30 days"));
$futureDay = date_format($formDate, "Y-m-d");

//query
$sql = "SELECT * FROM agenda WHERE date BETWEEN '$today' AND '$futureDay' LIMIT 0, 30 ";

$result = $conn->query($sql);

$agenda_array = array();

$agenda_empty = true;

//check if results > 0 to fill array
if(mysqli_num_rows($result) > 0){
	$agenda_empty = false;
	while($r = mysqli_fetch_assoc($result)){		
		$agenda_array[] = $r;		
	}
}

//Format date and time for Brazil
$len = count($agenda_array);
for($i = 0; $i < $len; $i++){	
	$agenda_array[$i]["date"] = date('d/m/Y', strtotime($agenda_array[$i]["date"]));	
	$agenda_array[$i]["time"] = date('H:i', strtotime($agenda_array[$i]["time"]));	
}

//$agenda_array[0]["date"] = "10/03/1981";

//echo $agenda_empty;

//Transforma em Json string
//$agenda_json = json_encode($agenda_array);
//echo $agenda_json;

//Transforma em objeto
//$object = json_decode($agenda_json);

//printa objeto pela posição e chave
//echo $object[0]->name . "<br>";
//echo $object[0]->address . "<br>";

//printa o valor do array
//$d = strtotime($agenda_array[0]["date"]);
//$agenda_array[0]["date"] = date('d-m-Y', $d);

$conn->close();

?>