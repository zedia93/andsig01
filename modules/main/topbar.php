<?php

define("TOPMENU", array(
    array(
        'content' => 'Usuarios',
        'id'    => "btn_account_users",
        'href'  => 'javascript:;',
        'level' => 99,
        'badge' => array(
            'text'  => '1',
            'color' => 'blue'
        )
    ),
    array(
        'content'=> 'Salir',
        'append' => Template::createElement('i', array('class' => 'fas fa-sign-out-alt pull-right'))->toString(),
        'id'     => 'btn_logout',
        'href'   => 'javascript:;',
        'level'  => 1
    )
    
));

$TOPBARMENU = (function(){

    $code = Template::loadElement();

    foreach (TOPMENU as $value) {

        if(USER['level']['ULEVEL'] >= $value['level']){

            if(!empty($value['badge'])){
                $badge = $value['badge'];
                unset($value['badge']);

                $value['append'] = Template::createElement('span', array('class' => sprintf('badge bg-%s pull-right',  !empty($badge['color']) ? $badge['color'] : 'green'), 'content' => $badge['text'] ));
            }
                        
            $li = Template::createElement('li', array('append' => Template::createElement('a', $value)));         
            $code->append($li);

        }
        
    }

    return $code;

});

$TOPNOTIFY = (function(){

    return '<li>
    <a>
      <span class="image"><img src="images/img.png" alt="Profile Image" /></span>
      <span>
        <span>John Smith</span>
        <span class="time">3 mins ago</span>
      </span>
      <span class="message">
        Film festivals used to be do-or-die moments for movie makers. They were where...
      </span>
    </a>
  </li>

  <li>
    <div class="text-center">
      <a>
        <strong>See All Alerts</strong>
        <i class="fas fa-angle-right"></i>
      </a>
    </div>
  </li>';

})

?>