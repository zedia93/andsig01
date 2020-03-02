
import { jsPanel } 	from 'jspanel4/es6module/jspanel.js';
import PNotify from 'pnotify/dist/es/PNotify.js';
import PNotifyButtons from 'pnotify/dist/es/PNotifyButtons.js';
import Swal from 'sweetalert2'

var CLIENT = {

  SEARCH:() => {

    const ClientSearchPanel = jsPanel.create({
      id: 'ClientSearchPanel',
      headerTitle: 'Buscar Cliente - Client Module',
      setStatus: 'maximized',
      closeOnEscape: true,
      theme: {
          bgPanel: '#2A3F54',
          bgContent: 'white',
          colorHeader: '#fff',
          colorContent: '#333',
      },
      animateIn: 'animated slideInLeft',
      animateOut: 'animated bounceOutLeft',    
        iconfont:   'bootstrap',
        maximizedMargin: [0, 0, 0, 70],
        contentSize: '450 250',
        dragit: {
          disable: true,
          containment: [0, 0, 0, 70]
        },
        resizeit: {
          disable: true
        },
        headerControls: {
          add: {
            html: '<span style="padding: 3px; color:#fff"><i class="fa fa-undo"></i></span>',
            name: 'reset',
            handler: function(panel, control){
              panel.content.innerHTML = 'You clicked the "reset" control';
            }
          },      
          normalize : 'remove',
          smallify : 'remove'
        },
        content:     '<p>Example panel ...</p>',
        callback: function () {          
          this.content.style.padding = '20px';
        },
        onbeforeclose: function () {
            return confirm('¿Desea cerrar el panel?');
        },    
        contentFetch: {      
          resource: './modules/client/controller.php',
          fetchInit: {
            method: 'POST',
            body: (new URLSearchParams("ctrl=1"))
          },
          done: function (panel, response) {
            this.content.innerHTML = response;
          }
        },
    
      });   

  }

}

export { CLIENT };