<?php
// Manejo de datos en formato JSON en el lado del servidor usando PHP
//
header("Content-Type: application/json");

if ($_GET){

	if (htmlspecialchars($_GET["l"]) == 'users'){ // SOLICITUD DE INICIO DE SESIÓN

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			echo json_encode($_POST);

			// $login 		= stripslashes($_POST['username']);
			// $password   = stripslashes($_POST['password']);
			 
			// if(isClearString($login) && isClearString($password)){

			// 	$password = MD5($password);

			// 	$QUERY = array(
			// 		'db' 	=> DB_LOGIN,
			// 		'query' => sprintf("SELECT * FROM t_users WHERE user LIKE '%s' AND pwd ='%s' LIMIT 1",$login,$password)
			// 	);

			// 	if(Encode::QUERY($QUERY)->ROWS() > 0){
			// 		$user = Encode::QUERY($QUERY)->ASOC();
			// 		$token = gcode(26);

			// 		if(!$user['status']){

			// 			setcookie("JSESSIONID", $token, (time()+60*60*24*30));

			// 			Encode::QUERY(array(
			// 				'db'    => DB_LOGIN,
			// 				'query' => sprintf("UPDATE `t_logs` SET `status` = '0' WHERE `userId` = '%s' AND `status` = 1",$user['id'])
			// 			));

			// 			$CODE = array(
			// 				'db'    => DB_LOGIN,
			// 				'table' => 't_logs',
			// 				'query'  => array(
			// 						array(
			// 							'into' => 'token',
			// 							'value' => $token
			// 						),
			// 						array(
			// 							'into' => 'userId',
			// 							'value' => $user['id']
			// 						)
			// 					)
			// 				);

			// 			if(Encode::INSERT($CODE)){

			// 				Jecho('¡Success!', 'Cargando su información, por favor espere...',true);

			// 			}else{
			// 				Jecho('¡Failed!', 'Falló el inicio de sesión');
			// 			}

			// 			// $_SESSION["login_info"] = array(
			// 			// 	'id'	=> Encode::QUERY($QUERY)->ASOC()[0]['id'],
			// 			// 	'user' 	=> $_POST['username'],
			// 			// 	'token' => $token,
			// 			// );						

			// 		}else{Jecho('¡Account access failed!', '¡Su cuenta ha sido suspendida!');}	

			// 	}else{Jecho('¡Failed!', '¡Usuario o password incorrecto!');}

			// }else{Jecho('Query Error', 'code injection detected');}
	
		}else{Jecho('Query Error', 'error al ejecutar la consulta [POST]');}

	}else if (htmlspecialchars($_GET["l"]) == 'logout'){ // SOLICITUD DE INICIO DE CERRAR SESIÓN

		$QUERY = array(
			'db'    => DB_LOGIN,
			'query' => sprintf("UPDATE `t_logs` SET `status` = 'CLOSE' WHERE `token` = '%s'",$_COOKIE['JSESSIONID'])
		);	

		if(Encode::QUERY($QUERY)->result){
			setcookie('JSESSIONID','',time()-3600);
			Jecho('¡Success!', 'Se finalizó la sesión correctamente!',true);
		}else{
			Jecho('¡Failed!', 'Ha ocurrido un error al finalizar sesión. Contacte con el administrador del sistema.',false);
		}

		

	}else{Jecho('Query Error', 'syntax error');}



}else{Jecho('Query Error', 'error al ejecutar la consulta [GET]');}
		
?>