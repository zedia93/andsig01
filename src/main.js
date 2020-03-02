// import {$,jQuery} from 'jquery';
import SideBar from './module/main/sidebar'; 
import Menu from './module/menu';

import PNotify from 'pnotify/dist/es/PNotify.js';
import PNotifyButtons from 'pnotify/dist/es/PNotifyButtons.js';
import moment from 'moment';

import "jspanel4/es6module/jspanel.css";
import "animate.css/animate.min.css";
import "@sweetalert2/theme-bootstrap-4/bootstrap-4.css";
import "pnotify/dist/PNotifyBrightTheme.css";

$(document).ready(() =>{
    
PNotify.defaults.styling = 'bootstrap4'; // Bootstrap version 4
PNotify.defaults.icons = 'fontawesome5'; // Font Awesome 4
//PNotify.defaults.delay = 3500;

// Tooltip & Clock
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    setInterval(() => {        
         $('#SistemInfo .Clock').text(moment(new Date()).format("DD-MM-YYYY hh:mm:ss a"));        
    }, 1000);
});


//REDIMENCIONAR
let $RIGHT_COL = $('.right_col');
$RIGHT_COL.css('min-height', $(window).height()-51);

//INICIALIZAR
SideBar();
Menu();

});