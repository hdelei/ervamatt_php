  
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

$sql = "SELECT text from historia ORDER BY id LIMIT 1;";

$result = $conn->query($sql);

$historia_row = array();

$historia_empty = true;

if(mysqli_num_rows($result) > 0){
	$historia_empty = false;
	while($r = mysqli_fetch_assoc($result)){
		$historia_row[] = $r;
	}
}

$conn->close();
?>