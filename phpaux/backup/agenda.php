  
 <?php

 include 'connection_data.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
	echo "Erro de conexão";
    die("Connection failed: " . $conn->connect_error);
} 

$getDate = getdate(date("U"));
$formDate = date_create("$getDate[year]-$getDate[mon]-$getDate[mday]");
$today = date_format($formDate, "Y-m-d");
date_add($formDate, date_interval_create_from_date_string("30 days"));
$futureDay = date_format($formDate, "Y-m-d");

//echo $today . "<br>";
//echo $futureDay . "<br>";

$sql = "SELECT * FROM agenda WHERE date BETWEEN '$today' AND '$futureDay' LIMIT 0, 30 ";
$result = $conn->query($sql);

$agenda_array = array();


while($r = mysqli_fetch_assoc($result)){
	$agenda_array[] = $r;
}

//Transforma em Json string
$agenda_json = json_encode($agenda_array);
echo $agenda_json;

//Transforma em objeto
$object = json_decode($agenda_json);

//printa objeto pela posição e chave
//echo $object[0]->name . "<br>";
//echo $object[0]->address . "<br>";

//printa o valor do array
//echo $agenda_array[0]["name"];
//echo "<br>";

echo "<hr>";
 foreach($object as $key => $v){
	 echo "<div id='agenda_pic' style='background:#ffe299;'>";
	 echo $v->name . " || " . $v->address . " || " . $v->date . " " 
	 . "<img width='80' src='/img/agenda/" . $v->picture . "'></img></div><hr>";
 }

$conn->close();

?>