<!DOCTYPE html>
<html lang="pt-BR">
<title>ERVA MATT ADMIN PAINEL</title>
<head>
<meta charset="utf-8">       
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<button type="button" onclick="test();">Click Me!</button>
    
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
function test(){
    dataString = [
		"1", 
		"Local do show", 
		"Rua 1", 
		"2017/03/01", 
		"10:20:00", 
		"porao.jpg"
    ];
	
var jsonString = JSON.stringify(dataString);

   $.ajax({
        type: "POST",
        url: "set_agenda.php",
        data: {ua : jsonString}, 
        cache: false,

        success: function(response){
            alert(response);
        }
    });
}


</script>
</body>
</html> 
