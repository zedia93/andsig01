<?php

if(($_GET)){

// ESPECIAL LOGIN -- LOGOUT 
    if(isset($_GET["l"])){

        switch (htmlspecialchars($_GET["l"])) {
            case "login":
                    require_once('./modules/account/controller/ctrl.main.php');                
                break;

            case "logout":
                    require_once('./modules/account/controller/ctrl.main.php');                
                break;
                
            case "account":
                require_once('./modules/account/controller/ctrl.main.php');                
            break;
            
            default:
                    require_once('./modules/main/index.php');
                break;
        }

    }

}else{
    require_once('./modules/main/index.php');   
}

?>