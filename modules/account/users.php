<?php
require_once('./inc/inc.functions.security.php');
require_once('./inc/class/class.temp.php');

//CODIFICAMOS EL ESCRIPT EN TEXTO PLANO
header("Content-Type: text/plain ; charset=utf-8");

$DOCUMENTO = new Template(array(
  'name'  => "account",
  'tpl'   => "users"
));

$USERSLIST = (function(){

    $USERS = Encode::QUERY(array(
        'db' => DB_LOGIN,
        'query' => 'SELECT `id`, `name`, `document` FROM `t_users`'
    ))->ASOC;

    $CODE = Template::loadElement();

    foreach ($USERS as $USER) {
       $CODE->append(Template::createElement('option', array(
           'value' => $USER['id'], 
           'content' => sprintf('%s - %s',$USER['name'], $USER['document']))
        ));
    }
    
    return $CODE;

});

$MODULES = (function(){

    $CODE2 = '
    <div class="col-md-4 text-center" style="padding: 0;">
    <span>CONTABILIDAD</span>
    <select name="contabilidad" class="form-control" required="">
      <option value="0">SIN PERMISO</option>
      <option value="1">VISUALIZAR</option>
      <option value="2">MODIFICAR</option>
    </select>					
  </div>';

  $CODE = Template::loadElement();

  if(count(MODULO) > 1){

    foreach (MODULO as $key => $value) {
        
        if($key > 1){ 

            $DIV = Template::createElement('div', array('class' => 'col-md-4 text-center',)
            );           

            $SELECT = Template::createElement('select', array(
                'name' => $value,
                'class' => 'form-control',
                'required' => true
            ));

            $SELECT->append(Template::createElement('option', array(
                'value' => '0',
                'content' => 'SIN PERMISO'
            )));
            $SELECT->append(Template::createElement('option', array(
                'value' => '1',
                'content' => 'VISUALIZAR'
            )));
            $SELECT->append(Template::createElement('option', array(
                'value' => '2',
                'content' => 'MODIFICAR'
            )));

            $DIV->append(Template::createElement('span', array('content' => $value, 'append' => $SELECT)));

            $CODE->append($DIV);
            
        }

    }

  }  

    return $CODE;
});

$DOCUMENTO->addTPL(array(
    "label" => "USERSLIST",
    'code'  => $USERSLIST(),    
));

$DOCUMENTO->addTPL(array(
    "label" => "MODULES",
    'code'  => $MODULES(),    
));

$DOCUMENTO->render();

?>