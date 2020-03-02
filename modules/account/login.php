<?php
require_once('./inc/inc.functions.security.php');
require_once('./inc/class/class.temp.php');

//CODIFICAMOS EL ESCRIPT EN HTML
header("Content-Type: text/html ; charset=utf-8");

$DOCUMENTO = new Template(array(
  'name'  => "account",
  'tpl'   => "login"
));

$DOCUMENTO->replace(array(
  'HOST_URL' => HOST_URL,
  'tittle' => sprintf('-[ %s ]-', S_NAME),
  'S_NAME' => S_NAME
));

$DOCUMENTO->render();

?>