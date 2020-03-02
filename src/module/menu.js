import Swal from 'sweetalert2'
import PNotify from 'pnotify/dist/es/PNotify';

import { ACCOUNT } from './account/windows';
import { CLIENT } from './client/windows';

export default function () {

$(document).ready(async () =>{

console.log('::CARGANDO VARIABLES::');

const level = await new Promise(resolve => {

  fetch( "./?r=json&a=level&l=account&i=account", {
    method: 'POST',
    //body: JSON.stringify({"a": 1, "b": 2}),
    cache: 'no-cache',
    headers: {
      'Content-Type': 'application/json'
    },    
  }).then( (r) => { //json() // text()
      if(r.status == 200){ 
        return resolve(r.json());
      }else{
        return false;
      } 
    })
    // .then( (data) => { return })
    .catch((err) => { console.error(err); return resolve(false) });
});

console.log('Finalizo carga de variables');


let Tecla = new Array();

  document.onkeydown=function(e){
    Tecla[e.which] = true;
  }

  document.onkeyup= function(e){ 

    if(Tecla[16] && Tecla[83]){ //BUSCAR CLIENTE SHIFT + S
     if(level.CLIENTES >= 1 || level.ULEVEL >= 99){ CLIENT.SEARCH(); }else{console.log('¡ACCESS DENIED!')}      
    }

    if(Tecla[16] && Tecla[69]){ //BUSCAR CLIENTE SHIFT + E
      console.log(level);
    }

    Tecla = new Array();  

  }

});


//INTERACCIÓN DE BOTONES

var 
  $BTN_CLIENT_SEARCH = $('#btn_client_search'); //-------- SIDEBAR BUTTOMS

var 
  $BTN_LOGOUT = $('#btn_logout'),  //-------- TOPBAR BUTTOMS
  $BTN_ACCOUNT_USERS = $('#btn_account_users'),
  $BTN_ICON_SEARCH = $('#search_icon');
  

//TOPBAR BUTTONS

$BTN_ICON_SEARCH.click(async function(){

const { value: ipAddress } = await Swal.fire({
  title: 'Ingrese el número del documento',
  input: 'number',
  showCancelButton: true,
  inputValidator: (value) => {
    if (!value) {
      return '¡Ingrese un número de documento valido!'
    }
  }
})

if (ipAddress) {
  Swal.fire(ipAddress)
}

});

$BTN_LOGOUT.click(function(){

  Swal.fire({
    title: "¿Estás seguro?",
		text: "¿Seguro desea salir del sistema y cerrar la sesión actual?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#5cb85c',
    cancelButtonColor: '#d33',
    confirmButtonText: "Si, salir",
    cancelButtonText: "No, cancelar",
  }).then((result) => {
    if (result.value) {
      Swal.fire({
        title: 'Cerrando sesión',
			  text: 'Por favor espere...',
        onBeforeOpen: () => {
          Swal.showLoading()
        },
        allowOutsideClick: false,
        allowEscapeKey: false,
      })

      $.get( "./", { r: "logout", i: "account", l: "logout"})
        .done(function( data ) {
          if(data.message.status){

            setTimeout(function(){
              window.location.href = ".";                    
             },(1000));	

          }else{
            Swal.close();
            
            PNotify.error({             
              title: data.message.tittle,
              text: data.message.description,
              delay: '3500',
              modules: {
                  Animate: {
                    animate: true,
                    inClass: 'bounceInLeft',
                    outClass: 'bounceOutRight'
                  },
                  Buttons: {
                      closer: true,
                      sticker: false
                  }
                }
          });

          }

          
        });

    }
  })


});

$BTN_ACCOUNT_USERS.click(() => {  
  ACCOUNT.USERS();
});

//

//SIDEBAR BUTTONS
$BTN_CLIENT_SEARCH.click(() => {
  CLIENT.SEARCH();
});

//

}