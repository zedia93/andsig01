import { jsPanel } 	from 'jspanel4/es6module/jspanel.js';
import PNotify from 'pnotify/dist/es/PNotify.js';
import PNotifyButtons from 'pnotify/dist/es/PNotifyButtons.js';
import Swal from 'sweetalert2'

var ACCOUNT = {

    USERS:() => {
        
    const UserManagerPanel = jsPanel.create({
			id: 'UserManagerPanel',
			//theme: 'primary',			
			closeOnEscape: true,
			theme: {
				bgPanel: '#2A3F54',
				bgContent: 'white',
				colorHeader: '#fff',
				colorContent: '#333',
			},
			headerTitle: 'Administrar Usuarios - Account Module',
			iconfont:    'bootstrap',
			animateIn:  'animated slideInRight',    // animation from animate.css
			animateOut: 'animated bounceOutRight',  // animation from animate.css
			boxShadow: 1,
			position: 'right-top',
			// position: {
			// 	my:      "right-top",
			// 	at:      "right-top",
			// 	//offsetY: 60
			// },
			panelSize: {
                width: 550,
                height: '100%'
			},
			// contentSize: {
            //     width: 550, 
            //     height: '100%'
			// },
			headerControls: {
				smallify: "remove",
				maximize: "remove",
				minimize: "remove",
			},
			resizeit: {
				disable: true
			},
			dragit: {
				axis: 'x',
				containment: [0, 0, 0, 70]
			},
            //autoclose: (1000 * 60 * 2),			
            callback: function () {
                this.content.style.padding = '10px';
            },
            // onbeforeclose: function () {
            //     return confirm('¿Seguro desea cerrar este panel?');
            // },
			content: '<div style="text-align:center;"><img src="./images/loading.gif" style="width: 25%;"></div>',
			contentAjax: {
				method: 'GET',
				url:    './?t=users&l=account',
				done:   function (panel) {
					panel.content.innerHTML = this.responseText;
					
					$('#UserManagerPanel #FormPermissions').submit((e)=>{
						e.preventDefault();

						Swal.fire({
							title: '¿Estas seguro?',
							text: "¿Desea guardar los cambios realizados?",
							icon: 'question',
							showCancelButton: true,
							confirmButtonColor: '#5cb85c',
							cancelButtonColor: '#d33',
							confirmButtonText: "Si, guardar!",
							cancelButtonText: "Cancelar",
						  }).then((result) => {
							if (result.value) {

								Swal.fire({
									title: 'Cargando información',
									text: 'Por favor espere...',
									onBeforeOpen: () => {
										Swal.showLoading()
									},
									allowOutsideClick: false,
									allowEscapeKey: false,
								})

								const formData = $('#UserManagerPanel #FormPermissions');
						
								$.post( "./?r=user&a=modify&l=account&i=account", formData.serialize())
									.done(function( data ) {
										if(data.message.status){
											PNotify.success({
												title: data.message.tittle,
												text: data.message.description
											});
											UserManagerPanel.close();
											Swal.close();
										}else{
											PNotify.error({
												title: data.message.tittle,
												text: data.message.description
											});
											Swal.close();
										}
										

								})


							  
							}
						  })

					
						
						
					
					});
					
					$('#UserManagerPanel #FormListUsers').submit((e)=>{
						e.preventDefault();

						const formData = $('#UserManagerPanel #FormListUsers');
						const formBtn = $('#UserManagerPanel #FormListUsers button');
						const formSelect = $('#UserManagerPanel #FormListUsers select');
						const result = $('#UserManagerPanel .permissions');

						formBtn.hide();
						
						Swal.fire({
							title: 'Cargando información',
							text: 'Por favor espere...',
							onBeforeOpen: () => {
								Swal.showLoading()
							},
							allowOutsideClick: false,
							allowEscapeKey: false,
						})
						
						$.post( "./?r=user&a=show&l=account&i=account", formData.serialize())
							.done(function( data ) {							
							if(data.CONSULT){	

								$('#UserManagerPanel #FormPermissions select[name=STATUS]').val(data.STATUS);
								$('#UserManagerPanel #FormPermissions input[name=ID]').val(data.ID);
								$('#UserManagerPanel #FormPermissions input[name=NAME]').val(data.NAME);
								$('#UserManagerPanel #FormPermissions input[name=USER]').val(data.USER);
								$('#UserManagerPanel #FormPermissions input[name=DOCUMENT]').val(data.DOCUMENT);

								for (const prop in data.LEVEL) {
									let select = `[name=${prop}]`;
									$('#UserManagerPanel #FormPermissions').find(select).val(data.LEVEL[prop]);									
								}

								formSelect.prop("disabled", true);
								result.slideDown(1000);
								Swal.close();

							}else{

								PNotify.error({
									title: '¡Failed!',
									text: 'Ha ocurrido un inconveniente al realizar consulta',
									modules: {
										Animate: {
										  animate: true,
										  inClass: 'bounceInLeft',
										  outClass: 'bounceOutRight'
										},
									  }
								});
								formBtn.show();
								Swal.close();

							}							
						})

					});
					
				},
				beforeSend: function() {
					this.setRequestHeader('Content-Type', 'text/plain ; charset=utf-8');
				}
			},
		})

    }

}

export { ACCOUNT };