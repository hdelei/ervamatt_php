	<?php	
	
	include 'get_agenda.php';
	
	
	//$agenda_empty = false;
	
	// $agenda_json = '[{"id":"2","name":"Favela Chic","address":"Av. da Saudade, 1200",
					// "date":"2017-11-04","time":"20:30","picture":"favela.jpg"},
					// {"id":"3","name":"Por\u00e3o do Rock","address":"Travessa Leila, 10 - Centro",
					// "date":"2017-11-04","time":"20:30","picture":"porao.jpg"}, 
					// {"id":"3","name":"Bar Cu do Padre","address":"Rota 66, 10 - Centro",
					// "date":"2017-11-04","time":"20:30","picture":"cudopadre.jpg"}]';
	
					
	// $agenda_array = json_decode($agenda_json, true);
	
	//data-slide dynamic code
	$slide = "";	
	for($i = 1; $i < count($agenda_array); $i++){
		$slide .= '<li data-target="#myCarousel" data-slide-to="' . $i .'"></li>' . "\n";
	}	
	
	//item active 
	$first_item = "";
	if(sizeof($agenda_array) > 0){
		$first_item = '<img src="img/agenda/' . $agenda_array[0]['picture'] .
			'" alt="' . $agenda_array[0]['name'] .
			'" style="width:300px;">
			<div class="carousel-caption">
            <h3>' . $agenda_array[0]['name'] .'</h3>
            <p>' . $agenda_array[0]['date'] . 
			' às ' . $agenda_array[0]['time'] .'</p>
            <p>'. $agenda_array[0]['address'] . '</p>';
	}	
			
	// items list static
	$static = '			<div class="item">
			  <img src="img/agenda/%s" alt="%s" style="width:300px;">
              <div class="carousel-caption">
                <h3>%s</h3>
                <p>%s às %s</p>
                <p>%s</p>
              </div>
		  </div>';
	
	//items list dynamic
	$dyn_items = "";	
	for($i = 0; $i < count($agenda_array); $i++){
		if($i > 0){
			$dyn_items .= sprintf($static . "\n", $agenda_array[$i]['picture'], 
			$agenda_array[$i]['name'], 
			$agenda_array[$i]['name'], 
			$agenda_array[$i]['date'], 
			$agenda_array[$i]['time'] ,
			$agenda_array[$i]['address']);
		}
	}	
	
	//um erro no notepad++ buga o ambiente por causa do link do facebook, por isso cortei
	$contate = "https://www.facebook.com/erva.matt.5";	
	
	$commom_html = '<!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span></a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>';
	
	if($agenda_empty){		
		echo <<<EOT
		<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin:auto; max-width:300px; border:solid 1px">

        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>          
        </ol>
		
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
          <div class="item active">
            <img src="img/agenda/empty.jpg" alt="sem show" style="width:300px;">
            <div class="carousel-caption">
              <h3>SEM SHOWS POR ENQUANTO...</h3>
              <p><a href="$contate">Contate-nos</a></p>
              <p></p>
            </div>
          </div>
		</div>
        
		$commom_html		  
EOT;
		}
		else{
		echo <<<EOT
	    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin:auto; max-width:300px; border:solid 1px">

        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		  $slide 		<!-- imutable slide OK -->         
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
			$first_item <!-- first item OK -->            
          </div>			
		</div>         
		
		$dyn_items			</div>
		
		$commom_html    
EOT;
	}	
	
?>	