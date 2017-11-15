<?php

/******
 * Upload de imagens
 ******/
 
// verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
    //echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'arquivo' ][ 'name' ] . '</strong><br />';
    //echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'arquivo' ][ 'type' ] . ' </strong ><br />';
    //echo 'Tempororiamente foi salvo em: <strong>' . $_FILES[ 'arquivo' ][ 'tmp_name' ] . '</strong><br />';
    //echo 'Seu tamanho é: <strong>' . $_FILES[ 'arquivo' ][ 'size' ] . '</strong> Bytes<br /><br />';
 
    //cria um arquivo temporário
	$arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];	
	
	//salva o nome real do arquivo e decodifica se necessário
    $nome = utf8_decode($_FILES[ 'arquivo' ][ 'name' ]);
	
	//diretório de upload
	$directory = '../img/agenda/';
	
	//lista os arquivos existentes
	$files = array_values(array_diff(scandir($directory), array('..', '.')));
	foreach($files as $i){
		$utf8_files[] = utf8_encode($i);
	}	
	
	$js = json_encode($utf8_files);
	//echo json_decode($js)[8];//json_decode(utf8_decode($js[7]));
	
	//se o nome já existe, retorna resposta
	if(in_array($nome, $files)){
		//echo "O nome ja existe!";
		$img_width = getimagesize($arquivo_tmp)[0];
		$img_height = getimagesize($arquivo_tmp)[1];
		//echo "Tamanho: ", $img_width, "X", $img_height;
		//echo json_encode(array('error'=>'already_exists'));
		echo '{"error":"already_exists"}';
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
        $destino = '../img/agenda/' . $nome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
			
			//$destino = utf8_encode($destino);
            //echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
            //echo ' <img src="'. $destino .'"/>';
			$files = array_values(array_diff(scandir($directory), array('..', '.')));
			$json_files = [];
			foreach($files as $img){
				//echo '<img width="50" src="../img/agenda/'. utf8_encode($img) .'"><br />';
				$files_array[] = utf8_encode($img);
			}
			echo json_encode($files_array);			
        }
        else
            echo '{"error":"no_permission"}';
    }
    else
        echo '{"error":"invalid_file_type"}';
}
else
    echo '{"error":"no_file"}';
