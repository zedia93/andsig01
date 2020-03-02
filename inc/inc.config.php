<?php
	
	$SUBFldr = "/project-andiasig";
	
	define("HOST_ROOT", $_SERVER["DOCUMENT_ROOT"].$SUBFldr);
	define("HOST_URL", $_SERVER["SERVER_NAME"].$SUBFldr);
	
	//DATABASE DEFINITION's
	
	define('DB_LOGIN', array(
		'HOST' 	=> '127.0.0.1',
		'DB' 	=> 'db_login',
		'USER'  => 'root',
		'PASS'  => '15425302',
		'CHARSET'  => 'utf8'
	));
	
	////////////////PERMISO A MODULOS///////////////////////
	
	define('MODULO', array(
		
		'ULEVEL', 				// 1 - DEFECTO ASESOR || 2 - ADMINISTRATIVO || 3 - TECNICO || 4 - OBRA CIVIL || 99 - ADMINISTRADOR || 		
		'CATEGORIA',			// 1 - TECNICO || 2 - TECNICO JEFE CUADRILLA || 3 - TECNICO HABILITADOR ||
		
		//MOODULOS
		'CUENTAS',
		'CLIENTES',

	));
	
	/////////////////////////////////////////////
 
	define("S_NAME", "AndiaSig"); 	 
	define("S_VER", "20200217"); 	
	 
	date_default_timezone_set('America/Lima');
?>