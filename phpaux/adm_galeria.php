<?php
//APRESENTA AS IMAGENS DEFAULT NA GALERIA

$directory = "../img/agenda/";
$images = glob($directory . "*.{jpg,png,gif,JPG,PNG,GIF}", GLOB_BRACE);
$start = $_GET['position'];
$newImages = array();


if($start > -1 && $start < count($images)){
	$newImages = array_slice($images, $start, 12);
	renderHtml();
}
else{
	echo '';
}

function renderHtml(){
	global $images, $newImages;
	if($images){
		foreach($newImages as $image)
		{
			$img_name = utf8_encode(basename($image));
			echo '<div class="sl_thumb"><img class="thumb_a" src="/img/agenda/' 
				. $img_name .'" alt="'. $img_name .'"></div>', PHP_EOL;  
		}
	}
	else{
		echo '';
	}
}
?>