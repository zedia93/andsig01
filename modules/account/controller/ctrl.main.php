<?php
require_once('./inc/inc.functions.security.php');

// SI SOLICITA INICIO DE SESION PERO EXISTE UN TOKEN
// REDIRECCIONA A LA PAGINA PRINCIPAL (DESKTOP)
///////////////////////////////////////////////////

if(htmlspecialchars($_GET["l"]) == 'login'){
    if(isset($_COOKIE['JSESSIONID'])){
        header("Location: ./");
        exit();
    }
}
///////////////////////////////////////////////////
///////////////////////////////////////////////////

// ARCHIVO INC A UTILIZAR
if(isset($_GET["i"])){
    
    switch (htmlspecialchars($_GET["i"])) {
        
        case "login":
            require_once('./inc/inc.functions.account.php');               
        break;

        case "signin":
            require_once('./inc/inc.functions.account.php');               
        break;

        case "account":
                permission();
                require_once('./inc/inc.functions.account.php');               
        break;
    }
// TEMPLATE A UTILIZAR
}else if(isset($_GET["t"])){

    switch (htmlspecialchars($_GET["t"])) {
        case "users":
                permission('ULEVEL', 99);
                require_once('./modules/account/users.php');               
            break;
        default:
            include_once('./modules/page_404.tplx');               
        break;


    }

}else{

    require_once('./modules/account/login.php');

}

?>