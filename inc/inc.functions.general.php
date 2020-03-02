<?php

include_once('inc.functions.custom.php');


///////////////////////////
//SE UTILIZA PARA VERIFICAR  PATRON DURANTE EL LOGIN
function isClearString($test) { //PATRON ALFANUMERICO SIN ESPACIOS ENTRE 4 Y 16 CARACTERES 
	return (preg_match("/^[a-z,A-Z,0-9_-]{4,16}$/", $test));
}
//////////////////////////

function isAlphaNumeric($test) { // EXPRESION ALFANUMERICA CON ESPACIOS
	return preg_match("/^[a-zA-Z0-9-_\s]*$/", $test);
}

function isNumeric($test) { // EXPRESION NUMERICA ACEPTA DECIMALES CON (,) O (.)
	return preg_match("/^[0-9]+([,.][0-9]+)?$/", $test);
}

function isValidEmail($email){ 
return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email);
}

function remove_accent($str) 
{ 
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư'); 
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u'); 
  
  return str_replace($a, $b, $str); 
}

function gcode($longitud) {
 $key = '';
 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return strtoupper(md5($key));
}

function fix_integer_overflow($size) {
	if ($size < 0) {
		$size += 2.0 * (PHP_INT_MAX + 1);
	}
	return $size;
}

function get_config_bytes($val) {
	$val = trim($val);
	$last = strtolower($val[strlen($val)-1]);
	$val = (int)$val;
	switch ($last) {
		case 'g':
			$val *= 1024;
		case 'm':
			$val *= 1024;
		case 'k':
			$val *= 1024;
	}
	return fix_integer_overflow($val);
}

function DistritoTxT( $ubigeo ){
	
		switch($ubigeo) {
						
			case "150101":
				$ubigeo = "LIMA";
			break;
			case "150102":
				$ubigeo = "ANCON";
			break;	
			case "150103":
				$ubigeo = "ATE";
			break;	
			case "150104":
				$ubigeo = "BARRANCO";
			break;	
			case "150105":
				$ubigeo = "BREÑA";
			break;
			case "150106":
				$ubigeo = "CARABAYLLO";
			break;
			case "150107":
				$ubigeo = "CHACLACAYO";
			break;
			case "150108":
				$ubigeo = "CHORRILLOS";
			break;
			case "150109":
				$ubigeo = "CIENEGUILLA";
			break;
			case "150110":
				$ubigeo = "COMAS";
			break;
			case "150111":
				$ubigeo = "EL AGUSTINO";
			break;
			case "150112":
				$ubigeo = "INDEPENDENCIA";
			break;
			case "150113":
				$ubigeo = "JESUS MARIA";
			break;
			case "150114":
				$ubigeo = "LA MOLINA";
			break;
			case "150115":
				$ubigeo = "LA VICTORIA";
			break;
			case "150116":
				$ubigeo = "LINCE";
			break;
			case "150117":
				$ubigeo = "LOS OLIVOS";
			break;
			case "150118":
				$ubigeo = "LURIGANCHO-CHOSICA";
			break;
			case "150119":
				$ubigeo = "LURIN";
			break;
			case "150120":
				$ubigeo = "MAGDALENA DEL MAR";
			break;
			case "150121":
				$ubigeo = "PUEBLO LIBRE";
			break;
			case "150122":
				$ubigeo = "MIRAFLORES";
			break;
			case "150123":
				$ubigeo = "PACHACAMAC";
			break;
			case "150124":
				$ubigeo = "PUCUSANA";
			break;
			case "150125":
				$ubigeo = "PUENTE PIEDRA";
			break;
			case "150126":
				$ubigeo = "PUNTA HERMOSA";
			break;
			case "150127":
				$ubigeo = "PUNTA NEGRA";
			break;
			case "150128":
				$ubigeo = "RIMAC";
			break;
			case "150129":
				$ubigeo = "SAN BARTOLO";
			break;
			case "150130":
				$ubigeo = "SAN BORJA";
			break;
			case "150131":
				$ubigeo = "SAN ISIDRO";
			break;
			case "150132":
				$ubigeo = "SAN JUAN DE LURIGANCHO";
			break;
			case "150133":
				$ubigeo = "SAN JUAN DE MIRAFLORES";
			break;
			case "150134":
				$ubigeo = "SAN LUIS";
			break;
			case "150135":
				$ubigeo = "SAN MARTIN DE PORRES";
			break;
			case "150136":
				$ubigeo = "SAN MIGUEL";
			break;
			case "150137":
				$ubigeo = "SANTA ANITA";
			break;
			case "150138":
				$ubigeo = "SANTA MARIA DEL MAR";
			break;
			case "150139":
				$ubigeo = "SANTA ROSA";
			break;
			case "150140":
				$ubigeo = "SANTIAGO DE SURCO";
			break;
			case "150141":
				$ubigeo = "SURQUILLO";
			break;
			case "150142":
				$ubigeo = "VILLA EL SALVADOR";
			break;
			case "150143":
				$ubigeo = "VILLA MARIA DEL TRIUNFO";
			break;
			case "150201":
				$ubigeo = "BARRANCA";
			break;
			case "150301":
				$ubigeo = "CAJATAMBO";
			break;
			case "150401":
				$ubigeo = "CANTA";
			break;
			case "150501":
				$ubigeo = "CAÑETE";
			break;
			case "150601":
				$ubigeo = "HUARAL";
			break;
			case "150701":
				$ubigeo = "HUAROCHIRI";
			break;
			case "150801":
				$ubigeo = "HUAURA";
			break;
			case "150901":
				$ubigeo = "OYON";
			break;
			case "151001":
				$ubigeo = "YAUYOS";
			break;
			case "070101":
				$ubigeo = "CALLAO";
			break;
			case "070102":
				$ubigeo = "BELLAVISTA";
			break;
			case "070103":
				$ubigeo = "CARMEN DE LA LEGUA REYNOSO";
			break;
			case "070104":
				$ubigeo = "LA PERLA";
			break;
			case "070105":
				$ubigeo = "LA PUNTA";
			break;
			case "070106":
				$ubigeo = "VENTANILLA";
			break;						
			case "070107":
				$ubigeo = "MI PERU";
			break;	
			
			default:
				$ubigeo = "UNKNOW";
			break;
		}
	
	return $ubigeo;

}

?>