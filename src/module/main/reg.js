
import PNotify from 'pnotify/dist/es/PNotify';

export default function () {
const DEBUG = false;

    function SetIcon($icon, $val){

        const Icon = $(`#formSingup span[iparent|='${$icon}']`);
        const Input = $(`#formSingup input[name='${$icon}']`);

        if($val){

            Icon.removeClass('fa-exclamation-triangle');
            Icon.addClass('fa-check');
            Icon.css("color","#009688");
            Input.css("border-color","#009688");

        }else{

            Icon.removeClass('fa-check');
            Icon.addClass('fa-exclamation-triangle');
            Icon.css("color","#a94442");
            Input.css("border-color","#a94442");

        }

        return true;
    }

    class errorBox{

        static show(text){

            $('#formSingup div.regConsol span').hide();
            $('#formSingup div.regConsol p').html(`<i class="fas fa-exclamation-circle"></i> <strong>${text}</strong>`);
            $('#formSingup .regConsol').removeClass( 'alert-info' );
            $('#formSingup .regConsol').addClass( 'alert-danger' );

        }

        static hide(){

            $('#formSingup div.regConsol p').empty();
            $('#formSingup div.regConsol span').show();
            $('#formSingup .regConsol').removeClass( 'alert-danger' );
            $('#formSingup .regConsol').addClass( 'alert-info' );      

        }

    }
    
    // VERIFICACIÓN DE INPUTS

    let name = false;
    let document = false;
    let username = false;
    let password = false;
    let repassword = false;

    let patt = new RegExp(/^[a-zA-Z0-9_-]{4,16}$/);
    let pattDoc = new RegExp(/^[0-9]{8,12}$/);
    let pattNam = new RegExp(/^[a-zA-Z\s]{4,45}$/);
    
    $("#formSingup input[name='name']").focusout(function() {

        if(pattNam.test($(this).val())){            
            SetIcon('name', true);
            errorBox.hide();
            name = true;
        }else{            
            SetIcon('name', false);
            errorBox.show('Debe ingresar su nombre completo');
            name = false;
        }    
    });

    $("#formSingup input[name='document']").focusout(function() {

        if(pattDoc.test($(this).val())){
            SetIcon('document', true);  
            errorBox.hide();
            document = true;         
        }else{            
            SetIcon('document', false);            
            errorBox.show('Debe ingresar un de documento válido, DNI o Carnet de Extrangería entre 8-12 caracteres numéricos');           
            document = false;
        }    
    });

    
    $("#formSingup input[name='username']").focusout(function() {

        if(patt.test($(this).val())){            
            SetIcon('username', true);
            errorBox.hide();
            username = true;
            
        }else{       
            SetIcon('username', false);            
            errorBox.show('Debe ingresar un nombre de usuario válido, entre 4-16 caracteres alfanuméricos');          
            username = false;
        }
    
    });    

    $("#formSingup input[name='password']").focusout(function() {

        if(patt.test($(this).val())){ 

            if ($("#formSingup input[name='repassword']").val().length > 0){

                if($("#formSingup input[name='repassword']").val() != $(this).val()){
                    SetIcon('password', false)
                    SetIcon('repassword', false);
                    errorBox.show('Las claves igresadas deben ser iguales');
                    password = false;
                }else{
                    SetIcon('password', true)
                    SetIcon('repassword', true);
                    errorBox.hide();
                    password = true;
                }

            }else{
                SetIcon('password', true);
                errorBox.hide();
                password = true;
            }            
                     
        }else{            
            SetIcon('password', false);
            errorBox.show('Debe ingresar una clave válida, entre 4-16 caracteres alfanuméricos');           
        }    
    });

    $("#formSingup input[name='repassword']").focusout(function() {

        if(patt.test($(this).val())){

            if($("#formSingup input[name='password']").val() != $(this).val()){
                SetIcon('repassword', false);
                SetIcon('password', false)
                errorBox.show('Las claves igresadas deben ser iguales');
                repassword = false;
            }else{
                SetIcon('repassword', true);
                SetIcon('password', true);
                errorBox.hide();
                repassword = true;
            }
                        
        }else{            
            SetIcon('repassword', false);
            errorBox.show('Debe ingresar una clave válida, entre 4-16 caracteres alfanuméricos');
            repassword = false;
        }
    });

      

  $('#formSingup').submit(function(e){
    e.preventDefault();

    if(name && document && username && password && repassword){

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

        $.post( "./?r=signin&a=request&l=account&i=signin", $(this).serialize())
            .done(function( data ) {
                if(data.message.status){
                    $('#formSingup').trigger("reset");
                    loading.update({
                        type: 'success',
                        title: data.message.tittle,
                        text: data.message.description,
                        icon: true,
                        width: '100%',
                        hide: true,
                        delay: '3000',
                        modules: {
                          Buttons: {
                            closer: true,
                          }
                        }
                      });

                      setTimeout(() => {

                         window.location.href = "./#signin";
                          
                      }, 1000);
                                   

                }else{
                    loading.update({
                        type: 'error',
                        title: data.message.tittle,
                        text: data.message.description,
                        icon: 'fas fa-exclamation-triangle',
                        width: '100%',
                        hide: true,
                        delay: '3000',
                        modules: {
                          Buttons: {
                            closer: true,
                          }
                        }
                      });
                }
            });


    }else{
        errorBox.show('Debe completar correctamente los campos antes de continuar');
    }


  })


if(DEBUG){
console.log('Module Register: DEBUG MODE ON');
}
    
}