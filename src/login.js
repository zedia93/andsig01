import Swal from 'sweetalert2'
import PNotify from 'pnotify/dist/es/PNotify.js';
import animateCSS from './assets/animateCSS';
import RegModule from './reg'; 

import "animate.css/animate.min.css";
import "pnotify/dist/PNotifyBrightTheme.css";

$(document).ready(() =>{

// INICIALIZAR
RegModule();

    PNotify.defaults.styling = 'bootstrap4'; // Bootstrap version 4
    PNotify.defaults.icons = 'fontawesome5'; // Font Awesome 4
    PNotify.defaults.delay = 4000;

    //ANIMACIÓN INICIAL

    const loadingDiv =  document.querySelector('#LoadingDiv');
    const formLogin =  document.querySelector('#formLogin');
    const formSingup =  document.querySelector('#formSingup');
    
   animateCSS('#logo', 'bounceInRight');
   animateCSS('#formLogin', 'bounceInLeft')

    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
    });

 $('#formLogin').submit(function(e){
    e.preventDefault();

    let Username = $("#formLogin input[name='username']");
    let password = $("#formLogin input[name='password']");
    const fromData = $( this ).serialize();

    let patt = new RegExp(/^[a-zA-Z0-9_-]{4,16}$/);
    
    let UsrVal = patt.test(Username.val());
    let PwdVal = patt.test(password.val());

    if(!UsrVal || !PwdVal){

        PNotify.error({
            title: '¡Información Invalida!',
            text: 'Debe ingresar un usuario y clave validos, sin carácteres especiales o espacios en blanco.',
            //icon: 'fab fa-apple',
            modules: {
                Animate: {
                  animate: true,
                  inClass: 'bounceInLeft',
                  outClass: 'bounceOutRight'
                },
                Buttons: {
                    //closer: false,
                    sticker: false
                }
              }
        });

    }else{

        formLogin.classList.add('hide');
        loadingDiv.classList.remove('hide');
        animateCSS('#LoadingDiv', 'zoomIn');

        var loading = PNotify.info({
          text: 'Por favor, espere...',
          icon: 'fas fa-spinner fa-pulse',
          hide: false,
          width: '100%',
          modules: {
            Buttons: {
              closer: false,
              sticker: false
            }
          }
        });       
            $.post( "./?r=login&l=login&i=login", fromData)
            .done(function( data ) {
                if(data.message.status){

                  // loading.close();

                  // Swal.fire({
                  //   title: 'Cargando información',
                  //   text: 'Por favor espere...',
                  //   onBeforeOpen: () => {
                  //     Swal.showLoading()
                  //   },
                  //   allowOutsideClick: false,
                  //   allowEscapeKey: false,
                  // })

                  setTimeout(function(){
                    window.location.href = ".";                    
                   },(1000));	

                }else{

                    loadingDiv.classList.add('hide'); 
                    formLogin.classList.remove('hide');
                    animateCSS('#formLogin', 'zoomIn');

                    loading.update({
                      type: 'error',
                      title: data.message.tittle,
                      text: data.message.description,
                      icon: 'fas fa-exclamation-triangle',
                      width: '100%',
                      hide: true,
                      delay: '3500',
                      modules: {
                        Buttons: {
                          closer: true,
                        }
                      }
                    });

                }
            });
            
        //}, 2000);


    }

    //console.log(`El usuario es ${UsrVal} y el password es ${PwdVal}`);

    

    //console.log(Username.val().replace(/ /g,'').length);

    //let pariente = Username.parent().toggleClass('bad');
    
    //console.log($(this).serialize());

 });

});