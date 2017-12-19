<!DOCTYPE html>
<html lang="pt-BR">
<title>ERVA MATT ADMIN PAINEL</title>
<head>
<meta charset="utf-8">       
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<button id="bt-select" type="button">Select cliente</button><p>

<button id="bt-update" type="button">Update cliente</button><p>

<button id="bt-delete" type="button">Delete cliente</button><p>

<button id="bt-insert" type="button">Insert cliente</button><p>

<p><div id="agenda_container">
    <div id="form_agenda">
        Local:<br><input id="local_text" type="text" size="26" placeholder="digite o nome" required><br>
        Data:<br><input id="date_text" type="date" value=""><br>
        Hora:<br><input id="time_text" type="time" value="20:00" ><br>
        Endereço:<br><input id="address_text" type="text" size="26" placeholder="digite o endereço"><br>
        Imagem:<br><input id="pic_text" type="text" size="26" placeholder="selecione abaixo" readonly="true"><br>                  
        <!--<input type="file" name="pic" accept="image/*">-->
    </div>

    <hr>
    Registro:<br><input id="c_id" type="text" size="5" placeholder="0"><p>

    <div id="show_list">
        <h3 class="w3-large w3-padding-small">Lista de shows</h3>
        <ul id="show-ul" class="w3-ul w3-small">
            <!--<li class="w3-padding-small">10/03/1981 - Santa Brasa</li>-->           
            
        </ul>
        <br>                
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
data = [
		"1", 
		"Novo Evento", 
		"Rua 1", 
		"2017/03/01", 
		"10:20:00", 
		"porao.jpg"
    ];
showListData = [];

function command(dataStr, cbFunction){   
    $.ajax({
        type: "POST",
        url: "set_agenda.php",
        data: dataStr,
        cache: false,

        success: function(response){
            //console.log(response);
            cbFunction(response);            
        }
    });
}

$('#bt-select').click(function(){	
    //data[0] = $('#c_id').val();//provisório
	command({ra:data[0]}, selectShow);           
});
$('#bt-update').click(function(){
	data[1] = $('#local_text').val();
    data[3] = $('#date_text').val();
    data[4] = $('#time_text').val();
    data[2] = $('#address_text').val();
    data[5] = $('#pic_text').val();
    var jsonString = JSON.stringify(data);
    command({ua:jsonString}, updateShow);	
});
$('#bt-delete').click(function(){
    var message = "Você tem certeza que deseja Excluir o evento:\n\n";
    var dt = formatDateTime(data[3], data[4]);
    message += data[1] + '\n';
    message += data[2] + '\n';
    message += dt.date + ' às ' + dt.time;        
    
    if(confirm(message) == true){
        command({da:data[0]}, deleteShow);        
    }        
});
$('#bt-insert').click(function(){		
    data[1] = $('#local_text').val();
    data[3] = $('#date_text').val();
    data[4] = $('#time_text').val();
    data[2] = $('#address_text').val();
    data[5] = $('#pic_text').val();
    var jsonString = JSON.stringify(data);
    command({ca:jsonString}, insertShow);    
});

//Callback Delete
function deleteShow(response){
    resp = JSON.parse(response);    
    if('error' in resp){
        console.log(resp);
    }
    else{
        var LAST_RECORD = "-1";
        command({ra:LAST_RECORD}, selectShow);
        LoadShowList();  
        //TODO: mensagem de sucesso
    }      
}

//Callback Select
function selectShow(response){
    resp = JSON.parse(response);
    if('error' in resp){
        //TODO: campo para mensagem de erro
        console.log(resp);
    }
    else if (resp.hasOwnProperty(length)){
        data = Object.values(resp[0]);
        //console.log(resp);    
        updateTextBox(data);
    }        
}

//Callback Insert
function insertShow(response){
    //console.log(response);
    resp = JSON.parse(response);
    if('error' in resp){
        console.log(resp);
        //TODO: criar campo para mensagem de erro
    }
    else{                
        data[0] = resp.inserted_id;
        LoadShowList();  
        //TODO: criar campo para mensagem de sucesso
    }        
}

//Callback Update
function updateShow(response){    
    resp = JSON.parse(response);
    if('error' in resp){
        console.log(resp);
        //TODO: criar campo para mensagem de erro
    }
    else{
        LoadShowList();          
        //TODO: criar campo para mensagem de sucesso
    }        
}

//CallBack to get show List
function getShowList(response){
    resp = JSON.parse(response);
    if('error' in resp){
        //TODO: campo para mensagem de erro
        console.log(resp);
    }
    else if (resp.hasOwnProperty(length)){
        showListData = [];
        $("#show-ul").empty();

        for(let i in resp){
            showListData.push(resp[i].id);
            var dt = formatDateTime(resp[i].date, "00:00:00");
            var item = dt.date + " - " + resp[i].name;
            $('#show-ul').append('<li>' + item + '</li>')
        }
    reloadListClick();
    }        
}

//Update Textboxes on agenda changes
function updateTextBox(data){    
    $('#local_text').val(data[1]);
    $('#date_text').val(data[3]);
    $('#time_text').val(data[4]);
    $('#address_text').val(data[2]);
    $('#pic_text').val(data[5]);    
}

/**
 *Get the date time for brazilian format
 *
 *@param {String} date - the date in international format
 * [Example] 1980-12-29
 *@param {String} time [Example] 22:15:01
 *@returns {Object} dt with two keys: dt.date and dt.time
  */
function formatDateTime(date, time){
    var d = new Date(date + 'T' + time);    
    month = '' + (d.getMonth() + 1);    
    day = '' + (d.getDate());
    year = d.getFullYear();
    hour = '' + d.getHours();
    minute = '' + d.getMinutes(); 

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    if (hour.length < 2) hour = '0' + hour;
    if (minute.length < 2) minute = '0' + minute;

    var dt = {date:[day, month, year].join('/')};
    dt.time = [hour, minute].join(':');    
    return dt;    
}

//Load text boxes with last event recorded
function firstTimeLoadAgenda(){
    var LAST_RECORD = "-1";
    command({ra:LAST_RECORD}, selectShow);
}

//load last 30 events in agenda to lista de shows
//Call getshowList() as callback
function LoadShowList(){
    command({sl:true}, getShowList);   
}

//Reload click listener for Lista de Shows
function reloadListClick(){
    $('#show-ul li').off('click');
    $('#show-ul li').click(function(){
        //When clicked, update textboxes 
        let eventId = $(this).index(); 
        command({ra:showListData[eventId]}, selectShow);        
    });
}

//Document Ready for first load of page
$(function(){
    firstTimeLoadAgenda();
    LoadShowList();          
});

</script>
</body>
</html> 
