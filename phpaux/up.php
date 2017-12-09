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

data = [
		"10", 
		"Novo Cliente", 
		"Rua 1", 
		"2017/03/01", 
		"10:20:00", 
		"porao.jpg"
    ];

function command(dataStr){   
    $.ajax({
        type: "POST",
        url: "set_agenda.php",
        data: dataStr,
        cache: false,

        success: function(response){
            alert(response);
        }
    });
}



$('#bt-select').click(function(){	
	command({ra:data[0]});
});
$('#bt-update').click(function(){
	var jsonString = JSON.stringify(data);	
	command({ua:jsonString});	
});
$('#bt-delete').click(function(){	
	command({da:data[0]});
});
$('#bt-insert').click(function(){
	var jsonString = JSON.stringify(data);	
	command({ca:jsonString});
});


</script>
</body>
</html> 
