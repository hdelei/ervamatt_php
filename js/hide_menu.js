//Este script esconde automaticamente a barra de navegação quando o 
//clique ocorre fora da barra
//O script pode ser melhorado já que está sendo chamado 
//o tempo todo, podendo ser chamado por demanda 

document.getElementsByTagName("BODY")[0].onclick = function(e){		
		
	if(e.target != $JQuery('#MyNavTop')) {									
		if($JQuery('#myToggle').is( ':visible' )){
			$JQuery("#myToggle").collapse('hide');				
		}
	}	
}
