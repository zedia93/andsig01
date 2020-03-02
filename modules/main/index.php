<?php
require_once('./inc/inc.functions.security.php');
require_once('./inc/class/class.temp.php');
authent();

define("USER", ( new Account($_SESSION['user']['id']))->Info() );

####################################
// ELEMENTOS COMPLEMENTARIOS
####################################
include_once('topbar.php');
include_once('sidebar.php');

$DOCUMENTO = new Template(array(
    'name'  => "main",
    'tpl'   => "index"
));

    $TOPBAR = $DOCUMENTO::alterElement(array(        // MODIFICAMOS EL CODIGO DE ELEMENTO A INCERTAR
        'element'  => $DOCUMENTO->getTPL('topbar'),  // CODIGO DODNE SE ENCUENTRA LA ETIQUETA 
        'label'    => 'TOPBARMENU',                  // ALTERAMOS LA EQIQUETA "liMenu" INCERTANDO EL CODIGO 
        'set'      => $TOPBARMENU()                  // CONTENIDO A INCERTAR
    ));

    $TOPBAR = $DOCUMENTO::alterElement(array(
        'element'  => $TOPBAR,
        'label'    => 'TOPNOTIFY',
        'set'      => $TOPNOTIFY()
    ));

$DOCUMENTO->addTPL(array(    // AGREGAMOS EL ELEMENTO UN ELEMENTO DESDE EL TPL
    "label" => "topbarEle",  // NOMBRE DE LA ETIQUETA EN EL ARCHIVO PRINCIPAL
    'code' => $TOPBAR,       // AGREGAMOS UN ELEMENTO EN CODIGO O TPL
    
));

$DOCUMENTO->addTPL(array(
    "label" => "mainEle",
    'tpl'  => "rightcol"
));

$DOCUMENTO->addTPL(array(
    "label" => "sidebarEle",
    'code' =>
    $DOCUMENTO::alterElement(array(
        'element'  => $DOCUMENTO->getTPL('sidebar'),
        'label'    => 'SidebarMenu',
        'set'      => $SIDEBARMENU()
    ))
));

$DOCUMENTO->addTPL(array(
    "label" => "footerEle",
    'tpl'  => "footer"
));

$DOCUMENTO->replace(array(
    'HOST_URL' => HOST_URL,
    'nombre' => USER['name'],
    'tittle' => sprintf('-[ %s ]-', S_NAME),
    'notify' => 5
));

$DOCUMENTO->render();

?>