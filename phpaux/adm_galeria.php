<?php

//APRESENTA AS IMAGENS DEFAULT NA GALERIA

$directory = "../img/agenda/";
$images = glob($directory . "*.{jpg,png,gif,JPG,PNG,GIF}", GLOB_BRACE);
array_splice($images, 12);

if($images){
	foreach($images as $image)
	{
		$img_name = utf8_encode(basename($image));
		echo '<div class="sl_thumb"><img class="thumb_a" src="/img/agenda/' 
			. $img_name .'" alt="'. $img_name .'"></div>', PHP_EOL;  
	}
}
else{
	echo 'Nenhuma imagem para exibir';
}

?>