<!DOCTYPE html>
<html lang="pt-BR">
<title>ERVA MATT ADMIN PAINEL</title>
<head>
<meta charset="utf-8">       
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<button id="bt-select" type="button">Select cliente 1</button><p>

<button id="bt-update" type="button">Update cliente 1</button><p>

<button id="bt-delete" type="button">Delete cliente 1</button><p>

<button id="bt-insert" type="button">Insert cliente</button><p>

<p><div id="agenda_container">
    <div id="form_agenda">
        Local:<br><input id="local_text" type="text" size="26" placeholder="digite o nome"><br>
        Data:<br><input id="date_text" type="date" value="" ><br>
        Hora:<br><input id="time_text" type="time" value="20:00" ><br>
        Endereço:<br><input id="adress_text" type="text" size="26" placeholder="digite o endereço"><br>
        Imagem:<br><input id="pic_text" type="text" size="26" placeholder="selecione abaixo" readonly="true"><br>                  
        <!--<input type="file" name="pic" accept="image/*">-->
    </div>
  
    
<!--  Load jquery from cdn -->
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
</script>

<!--  Load jquery form plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<!--<script src="/js/jquery.form.js"></script>-->


<script>
var resp = "teste";
data = [
		"1", 
		"Novo Cliente", 
		"Rua 1", 
		"2017/03/01", 
		"10:20:00", 
		"porao.jpg"
    ];

function command(dataStr, cbFunction){   
    $.ajax({
        type: "POST",
        url: "set_agenda.php",
        data: dataStr,
        cache: false,

        success: function(response){
            cbFunction(response);
        }
    });
}

$('#bt-select').click(function(){	
	command({ra:data[0]}, selectShow);    
});
$('#bt-update').click(function(){
	var jsonString = JSON.stringify(data);	
    command({ua:jsonString});
    //create callback function	
});
$('#bt-delete').click(function(){	
	command({da:data[0]});
});
$('#bt-insert').click(function(){
	var jsonString = JSON.stringify(data);	
	command({ca:jsonString});
});

function selectShow(response){
    alert(response);
}


</script>
</body>
</html> 
