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

$sql = "SELECT video_key from youtube ORDER BY id DESC LIMIT 0 , 15;";

$result = $conn->query($sql);

$video_row = array();

$video_empty = true;

if(mysqli_num_rows($result) > 0){
	$video_empty = false;
	while($r = mysqli_fetch_assoc($result)){
		$video_row[] = $r;
	}
}

$conn->close();

?>