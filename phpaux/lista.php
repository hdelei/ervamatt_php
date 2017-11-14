<?php
$directory = '../img/agenda/';
$files = array_values(array_diff(scandir($directory), array('..', '.')));

//echo $files[0];
//print_r($files);
?>

<form method="post" enctype="multipart/form-data" action="recebeUpload.php">
   Selecione uma imagem: <input name="arquivo" type="file" />
   <br />
   <input type="submit" value="Salvar" />
</form>