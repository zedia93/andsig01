<?php
// Manejo de datos en formato JSON en el lado del servidor usando PHP
//
header("Content-Type: application/json");
//

if ($_GET){

if (isset($_GET["r"])){ // COMPROBAMOS LA VARIABLE DE ACCIONES

	if (htmlspecialchars($_GET["r"]) == 'login'){ // SOLICITUD DE INICIO DE SESIÓN

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$login 		= stripslashes($_POST['username']);
			$password   = stripslashes($_POST['password']);
			 
			if(isClearString($login) && isClearString($password)){

				$password = MD5($password);

				$QUERY = array(
					'db' 	=> DB_LOGIN,
					'query' => sprintf("SELECT * FROM t_users WHERE user LIKE '%s' AND pwd ='%s' LIMIT 1",$login,$password)
				);

				if(Encode::QUERY($QUERY)->ROWS > 0){
					$user = Encode::QUERY($QUERY)->ASOC(0);
					$token = gcode(26);

					if($user['status']){

						setcookie("JSESSIONID", $token, (time()+60*60*24*30));

						Encode::QUERY(array(
							'db'    => DB_LOGIN,
							'query' => sprintf("UPDATE `t_logs` SET `status` = '0' WHERE `userId` = '%s' AND `status` = 1",$user['id'])
						));

						$CODE = array(
							'db'    => DB_LOGIN,
							'table' => 't_logs',
							'query'  => array(
									array(
										'into' => 'token',
										'value' => $token
									),
									array(
										'into' => 'userId',
										'value' => $user['id']
									)
								)
							);

						if(Encode::INSERT($CODE)){

							Jecho('¡Success!', 'Cargando su información, por favor espere...',true);

						}else{
							Jecho('¡Failed!', 'Falló el inicio de sesión');
						}					

					}else{Jecho('¡Account access failed!', 'Su cuenta actualmente esta inhabilitada');}	

				}else{Jecho('¡Failed!', '¡Usuario o password incorrecto!');}

			}else{Jecho('Query Error', 'code injection detected');}
	
		}else{Jecho('Query Error', 'error al ejecutar la consulta [POST]');}

	}else if (htmlspecialchars($_GET["r"]) == 'logout'){ // SOLICITUD DE CERRAR SESIÓN

		$QUERY = array(
			'db'    => DB_LOGIN,
			'query' => sprintf("UPDATE `t_logs` SET `status` = 'CLOSE' WHERE `token` = '%s'",$_COOKIE['JSESSIONID'])
		);	

		if(Encode::QUERY($QUERY)->RESULT){
			session_destroy();
			setcookie('JSESSIONID','',time()-3600);
			Jecho('¡Success!', 'Se finalizó la sesión correctamente!',true);
		}else{
			Jecho('¡Failed!', 'Ha ocurrido un error al finalizar sesión. Contacte con el administrador del sistema.',false);
		}		

	}else if (htmlspecialchars($_GET["r"]) == 'signin'){ // SOLICITUD DE CREACIÓN DE CUENTA

		if (isset($_GET["a"])){
			
			if (htmlspecialchars($_GET["a"]) == 'request'){

				if($_SERVER['REQUEST_METHOD'] == 'POST'){

					$USER['name'] 		= $_POST['name'];
					$USER['document'] 	= $_POST['document'];
					$USER['username'] 	= $_POST['username'];
					$USER['password'] 	= $_POST['password'];
					
					//VERIFICACIÓN SIMPLE DE INYECCION
					if(isAlphaNumeric($USER['name']) && isClearString($USER['document']) && isClearString($USER['username']) && isClearString($USER['password'])){
						
						$QUERY = Encode::QUERY(array(
							'db'    => DB_LOGIN,
							'query' => sprintf("SELECT id FROM `t_users` WHERE `user` LIKE '%s'",$USER['username'])
						))->ROWS;

						if(!$QUERY){

							$QUERY = Encode::QUERY(array(
								'db'    => DB_LOGIN,
								'query' => sprintf("SELECT id FROM `t_users` WHERE `document` LIKE '%s'",$USER['document'])
							))->ROWS;
		
							if(!$QUERY){

								if(Encode::INSERT(array(
									'db'    => DB_LOGIN,
									'table' => 't_users',
									'query'  => array(
											array(
												'into' => 'user',
												'value' => $USER['username']
											),
											array(
												'into' => 'pwd',
												'value' => md5($USER['password'])
											),
											array(
												'into' => 'name',
												'value' => strtoupper($USER['name'])
											),
											array(
												'into' => 'document',
												'value' => $USER['document']
											)
										)
								))){
									Jecho('¡Success!', '¡Se ha registrado la solicitud de acceso correctamente!',true);

								}else{
									Jecho('¡Failed!', 'Ah ocurrido un error durante la solicitud');
								};

							}else{
								Jecho('¡Failed!', 'El número de documento ya esta registrado');
							}
							
						}else{
							Jecho('¡Failed!', 'El nombre de usuario ya esta siendo utilizado');
						}				

					}else{Jecho('Query Error', 'code injection detected');}
					
				}else{Jecho('Query Error', 'error al ejecutar la consulta [POST]');}

			}else{Jecho('Query Error', 'syntax error A#4');}
			
		}else{Jecho('Query Error', 'syntax error ISSET-A#3');}
	
	}else if (htmlspecialchars($_GET["r"]) == 'json'){ // OBTENER INFORMACIÓN TIPO JSON

		if (isset($_GET["a"])){
			
			if (htmlspecialchars($_GET["a"]) == 'level'){

				if($_SERVER['REQUEST_METHOD'] == 'POST'){

					echo json_encode(( new Account($_SESSION['user']['id']))->Info()['level']);				
					
				}else{Jecho('Query Error', 'error al ejecutar la consulta [POST]');}

			}else{Jecho('Query Error', 'syntax error REQUETS-A#4');}
			
		}else{Jecho('Query Error', 'syntax error ISSET-A#3');}
	
	}else if (htmlspecialchars($_GET["r"]) == 'user'){ // SOLICITUD DE USUARIOS
	
			if (isset($_GET["a"])){
				
				if (htmlspecialchars($_GET["a"]) == 'show'){ // MOSTAR LEVEL DE LOS CLIENTES
	
					if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
						$ID = $_POST['user'];
						
						//VERIFICACIÓN SIMPLE DE INYECCION
						if(isAlphaNumeric($ID)){

							$info = (new Account($ID))->info;

							if($info){
								$send['CONSULT'] = 1;								
								$send['ID'] = $info['id'];
								$send['USER'] = $info['user'];
								$send['NAME'] = $info['name'];
								$send['DOCUMENT'] = $info['document'];
								$send['STATUS'] = $info['status'];								
								$send['LEVEL'] = $info['level'];
							}else{
								$send['CONSULT'] = 0; 
							}							
							
							echo json_encode($send);				
	
						}else{Jecho('Query Error', 'code injection detected');}
						
					}else{Jecho('Query Error', 'error al ejecutar la consulta [POST]');}
	
				}else if (htmlspecialchars($_GET["a"]) == 'modify'){ // MODIFICAR LEVEL DE LOS CLIENTES

					if($_SERVER['REQUEST_METHOD'] == 'POST'){
						
						$USER['ID'] 	= $_POST['ID'];
						$USER['STATUS'] = $_POST['STATUS'];
						$USER['NAME'] 	= $_POST['NAME'];
						$USER['DOCUMENT'] = $_POST['DOCUMENT'];
						$USER['USER'] 	= $_POST['USER'];
						$USER['PWD'] 	= !empty($_POST['PWD']) ? md5($_POST['PWD']) : (new Account($USER['ID']))->info['pwd'];
						$USER['LEVEL'] 	= array();

						$QUERY = Encode::QUERY(array(
							'db'    => DB_LOGIN,
							'query' => sprintf("SELECT id FROM `t_users` WHERE `user` LIKE '%s' AND `id` != %s",$USER['USER'], $USER['ID'])
						))->ROWS;
						
						if(!$QUERY){
						
							$QUERY = Encode::QUERY(array(
								'db'    => DB_LOGIN,
								'query' => sprintf("SELECT id FROM `t_users` WHERE `document` LIKE '%s' AND `id` != %s",$USER['DOCUMENT'], $USER['ID'])
							))->ROWS;
						
							if(!$QUERY){

								foreach ($_POST as $i => $v) {
									$USER['LEVEL'][$i] = $v;							
								}
							
								//VERIFICACIÓN SIMPLE DE INYECCION						
								if(isAlphaNumeric($USER['NAME']) && isClearString($USER['DOCUMENT']) && isClearString($USER['USER'])){
								
									$USER['LEVEL'] = Account::level()::toString($USER['LEVEL']);
									
									//echo json_encode($USER);

									$QUERY = Encode::UPDATE(array(
										'db'    => DB_LOGIN,
										'table' => 't_users',
										'query' => array(
												'set' => array(
													array(
														'ROW' => 'status',
														'VALUE' => $USER['STATUS']
													),
													array(
														'ROW' => 'level',
														'VALUE' => $USER['LEVEL']
													),
													array(
														'ROW' => 'name',
														'VALUE' => strtoupper($USER['NAME'])
													),
													array(
														'ROW' => 'document',
														'VALUE' => $USER['DOCUMENT']
													),
													array(
														'ROW' => 'user',
														'VALUE' => $USER['USER']
													),
													array(
														'ROW' => 'pwd',
														'VALUE' => $USER['PWD']
													),
												),                    
												'where' => array(
													array(
														'ROW' => 'id',
														'VALUE' => $USER['ID']
													)
													
												)
										),							
									));

									if($QUERY){							
										Jecho('Sucess', '¡Los datos se actualizaron correctamente!', true);
									}else{
										Jecho('Query Error', 'error al ejecutar la consulta');
									}
								
								}else{Jecho('Query Error', 'code injection detected');}

							}else{Jecho('¡Failed!', 'El número de documento ya esta registrado');}
							
						}else{Jecho('¡Failed!', 'El nombre de usuario ya esta siendo utilizado');}	
												
					}else{Jecho('Query Error', 'error al ejecutar la consulta [POST]');}					

				}else{Jecho('Query Error', 'syntax error REQUETS-A#4');}
				
			}else{Jecho('Query Error', 'syntax error ISSET-A#3');}
		
	}else{Jecho('Query Error', 'syntax error #2');}
	
}else{Jecho('Query Error', 'syntax error #1');}



}else{Jecho('Query Error', 'error al ejecutar la consulta [GET]');}
		
?>