<?php

//APRESENTA AS IMAGENS DEFAULT NA GALERIA

$directory = "../img/agenda/";
$images = glob($directory . "*.{jpg,png,gif,JPG,PNG,GIF}", GLOB_BRACE);

if($images){
	foreach($images as $image)
	{
		echo '<div class="sl_thumb"><img class="thumb_a" src="/img/agenda/' 
			. basename($image) .'"></div>', PHP_EOL;  
	}
}
else{
	echo 'Nenhuma imagem para exibir';
}

?>