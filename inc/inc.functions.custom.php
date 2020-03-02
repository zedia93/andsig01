<?php

function Jecho($msg, $info = NULL, $status = false){

	$mensaje = array(
		'message' => 
			array(				
				'tittle' => $msg,
				'description' => $info,
				'status' => $status	? 1 : 0	
			)
	); 

	echo json_encode($mensaje);
	return exit();
}

function CodigoMZLT($cadena){
  $cadena = str_replace(' ', '', $cadena);
  $cadena = str_replace('-', '', $cadena);
  return $cadena;
}

function SemanaPasada(){
	
	$diaInicio	= date("Ymd",strtotime('Monday previous week',strtotime("now"))); // LUNES PASADO
    $diaFin		= date("Ymd",strtotime('Sunday previous week',strtotime("now"))); // DOMINGO PASADO
		
    return Array("Inicio"=>$diaInicio,"Fin"=>$diaFin);
}

function SemanaActual(){
	
	$diaInicio	= date("Ymd",strtotime('Monday this week',strtotime("now"))); // LUNES PASADO
    $diaFin		= date("Ymd",strtotime('Sunday this week',strtotime("now"))); // DOMINGO PASADO
		
    return Array("Inicio"=>$diaInicio,"Fin"=>$diaFin);
}

function MesActual(){
	
	$diaInicio	= date('Ymd',strtotime('first day of this month',strtotime("now"))); // LUNES PASADO
    $diaFin		= date('Ymd',strtotime('last day of this month',strtotime("now"))); // DOMINGO PASADO
		
    return Array("Inicio"=>$diaInicio,"Fin"=>$diaFin);
}

function MesPasado(){
	
	$diaInicio	= date('Ymd',strtotime('first day of previous month',strtotime("now"))); // LUNES PASADO
    $diaFin		= date('Ymd',strtotime('last day of previous month',strtotime("now"))); // DOMINGO PASADO
		
    return Array("Inicio"=>$diaInicio,"Fin"=>$diaFin);
}

function CORTE($corte = false){
	
	if(!$corte){		
		$corte = (date('d',strtotime('now')) >= 14 ? 2 : 1);	
	}
	
	if($corte == 1){
		
		$diaInicio	= date('Ymd',strtotime('+28 day',strtotime('first day of previous month',strtotime("now")))); // 1 CORTE
		$diaFin		= date('Ymd',strtotime('+12 day',strtotime('first day of this month',strtotime("now")))); // 1 CORTE
		
		return Array("Inicio"=>$diaInicio,"Fin"=>$diaFin);
		
	}else if($corte == 2){
		
		$diaInicio	= date('Ymd',strtotime('+13 day',strtotime('first day of this month',strtotime("now")))); // 2 CORTE
		$diaFin		= date('Ymd',strtotime('+27 day',strtotime('first day of this month',strtotime("now")))); // 2 CORTE
		
		return Array("Inicio"=>$diaInicio,"Fin"=>$diaFin);
		
	}else if($corte == 3){
		
		$TIPO = (date('d',strtotime('now')) >= 14 ? 2 : 1);
		
		$diaInicio = NULL;
		$diaFin = NULL;
		
		if($TIPO == 1){
			
			$diaInicio	= date('Ymd',strtotime('+13 day',strtotime('first day of previous month',strtotime("now"))));
			$diaFin		= date('Ymd',strtotime('+27 day',strtotime('first day of previous month',strtotime("now"))));
			
		}else if($TIPO == 2){
			
			$diaInicio	= date('Ymd',strtotime('+28 day',strtotime('first day of previous month',strtotime("now")))); // 1 CORTE
			$diaFin		= date('Ymd',strtotime('+12 day',strtotime('first day of this month',strtotime("now")))); // 1 CORTE			
				
		}	
		
		return Array("Inicio"=>$diaInicio,"Fin"=>$diaFin);
		
	}	
	
}

?>