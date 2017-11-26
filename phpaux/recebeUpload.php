<?php

/******
 * Upload de imagens
 ******/
 
//error_reporting(0);
// verifica se foi enviado um arquivo
if (isset($_FILES['arquivo']['name']) && $_FILES['arquivo']['error'] == 0){
    //echo $_SERVER['CONTENT_LENGTH'] . '</br>';
	
	
    //cria um arquivo temporário
	$arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];	
	
	//obtém as dimensões da imagem	
	if(!getimagesize($arquivo_tmp)){
		echo '{"error":"Não é um arquivo de imagem válido!"}';
		exit;
	}
	
	$img_width = getimagesize($arquivo_tmp)[0];
	$img_height = getimagesize($arquivo_tmp)[1];
	
	//Tolerância na dimensão
	sizeTolerance($img_width, $img_height);
	
	//salva o nome real do arquivo e decodifica se necessário    
	$nome = standardizeFileName(utf8_decode($_FILES['arquivo']['name']));		
	
	//diretório de upload
	$directory = '../img/agenda/';
	
	//lista os arquivos existentes
	$files = array_values(array_diff(scandir($directory), array('..', '.')));	
	
	//Jsoniza os arquivos existentes
	$js = json_encode($files);	
	
	//se o nome já existe, retorna resposta
	if(in_array($nome, $files)){
		echo '{"error":"Este nome já existe! Escolha outro."}';
		return;		
	}
	
    // Pega a extensão
    $extensao = pathinfo($nome, PATHINFO_EXTENSION);
	
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if (strstr('.jpg;.jpeg;.gif;.png', $extensao)){
        
		// Concatena a pasta com o nome
        $destino = '../img/agenda/' . $nome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file($arquivo_tmp, $destino)){
			
			echo json_encode(array("img"  => $nome));			
        }
        else
            echo '{"error":"Sem permissão!"}';
    }
    else		
        echo '{"error":"Tipo de arquivo inválido!"}';
}
else{	
	echo '{"error":"Nenhum arquivo selecionado!"}';		
}
    

//Evitar imagens distorcidas
function sizeTolerance($width, $height) {	
	$bigger = max($width, $height);
	
	if($bigger > 320){
		echo '{"error":"Tamanho máximo permitido 320x320 pixels!"}';
		exit;
	}
	$smaller = min($width, $height);
	$remainder = $bigger - $smaller;	
	$hundred_perct = $bigger / 100;		
	$diff_perct = $remainder / $hundred_perct;	
		
	if($diff_perct > 21){
		echo '{"error":"O lado maior da imagem está fora do valor máximo tolerado! O ideal é 300x300 pixels."}';
		exit;
	}	
}

function standardizeFileName($string){
   // pegando a extensao do arquivo
   $partes 	= explode(".", $string);
   $extensao = $partes[count($partes)-1];	
   // somente o nome do arquivo
   $inome = preg_replace('/\.[^.]*$/', '', $string);	
   // removendo simbolos, acentos etc
   $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ?';
   $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr-';
   $inome = strtr($inome, utf8_decode($a), $b);
   $inome = str_replace(".","-",$inome);
   $inome = preg_replace( "/[^0-9a-zA-Z\.]+/",'-',$inome);
   return utf8_decode(strtolower($inome.".".$extensao));
}

