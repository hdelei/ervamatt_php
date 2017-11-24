<?php

/******
 * Upload de imagens
 ******/
 
// verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
    
    //cria um arquivo temporário
	$arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];	
	
	//obtém as dimensões da imagem
	$img_width = getimagesize($arquivo_tmp)[0];
	$img_height = getimagesize($arquivo_tmp)[1];
	
	sizeTolerance($img_width, $img_height);
	
	//salva o nome real do arquivo e decodifica se necessário
    $nome = utf8_decode($_FILES[ 'arquivo' ][ 'name' ]);
	
	//converte em minúsculo
	$nome = strtolower($nome);
	
	//diretório de upload
	$directory = '../img/agenda/';
	
	//lista os arquivos existentes
	$files = array_values(array_diff(scandir($directory), array('..', '.')));
	foreach($files as $i){
		$utf8_files[] = utf8_encode($i);
	}	
	
	//Jsoniza os arquivos existentes
	$js = json_encode($utf8_files);	
	
	//se o nome já existe, retorna resposta
	if(in_array($nome, $files)){
		echo '{"error":"Este nome já existe! Escolha outro."}';
		return;		
	}
	
    // Pega a extensão
    $extensao = pathinfo($nome, PATHINFO_EXTENSION);
 
    // Converte a extensão para minúsculo
    $extensao = strtolower($extensao);
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if (strstr('.jpg;.jpeg;.gif;.png', $extensao)){
        
		// Concatena a pasta com o nome
        $destino = '../img/agenda/' . strtolower($nome);
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
			
			$files = array_values(array_diff(scandir($directory), array('..', '.')));
			$json_files = [];
			
			//gera um array de nomes atualizados para devolver
			foreach($files as $img){				
				$files_array[] = utf8_encode($img);
			}
			echo json_encode($files_array);			
        }
        else
            echo '{"error":"Sem permissão!"}';
    }
    else
        echo '{"error":"Tipo de arquivo inválido!"}';
}
else
    echo '{"error":"Nenhum arquivo selecionado!"}';

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

