<?php 

$directory = "../img/agenda/";
$images = glob($directory . "*.{jpg,png,gif,JPG,PNG,GIF}", GLOB_BRACE);

$start = $_GET['position'];
$imgList = array();

foreach($images as $image){
	$imgList[] = basename($image);
}

$imgList = array_slice($imgList, $start, 3);

echo json_encode(array($imgList, array('pos' => '1')));