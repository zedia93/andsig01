<?php
session_start();
require_once('inc.config.php');
require_once('inc.functions.general.php');
require_once('class/class.db.php'); 
require_once('class/class.account.php'); 


function authent()
{
	$TOKEN = checkToken();
	if($TOKEN){
		$SESION = checkSession();
		if($SESION){
			return true;

		}else{
			$getId = Encode::QUERY(array(
				'db'    => DB_LOGIN,
				'query' => sprintf("SELECT userId FROM `t_logs` WHERE `token` LIKE '%s' AND `status` = 1 LIMIT 1",$TOKEN)
			));
			if($getId->ROWS){
				$getInfo = Encode::QUERY(array(
					'db'    => DB_LOGIN,
					'query' => sprintf("SELECT id FROM `t_users` WHERE `id` = %s",$getId->ASOC(0)['userId'])
				))->ASOC(0);
				$_SESSION["user"] = array(
					'id' => $getInfo['id'],
				 );
				return true;
			}
		}		
	}else{
		header("Location: ./?l=login");
	}		
}

function permission($index = 'ULEVEL', $level = 0){

	if(checkToken()){
		if(!checkSession()){
			include_once('./modules/page_403.tplx');
			exit();
		}else{

			$USER['LEVEL'] = (new Account($_SESSION["user"]['id']))->info['level'];
			if($USER['LEVEL'][$index] < $level){
				include_once('./modules/page_403.tplx');
				exit();
			}
		}
	}else{
		include_once('./modules/page_403.tplx');
		exit();
	}		

}

// IDENTIFICAMOS LA EXISTENCIA DEL TOKEN DE SESION 

function checkToken(){

	if(!isset($_COOKIE['JSESSIONID'])){
		return false;
	}else{

		if(Encode::QUERY(array(
			'db'    => DB_LOGIN,
			'query' => sprintf("SELECT userId FROM `t_logs` WHERE `token` LIKE '%s' AND `status` = 1 LIMIT 1",htmlspecialchars($_COOKIE['JSESSIONID']))
		))->ROWS){

			return $_COOKIE['JSESSIONID'];

		}else{

			setcookie('JSESSIONID','',time()-3600);
			return false;

		}
	}

}

function checkSession(){

	if(!isset($_SESSION["user"])){
		return false;
	}else{
		return $_SESSION["user"];
	}

	

}
?>