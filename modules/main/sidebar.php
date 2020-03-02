<?php

define("SIDEMENU", array(
    array(
        'module' => 'CLIENTES',
        'icon'   => 'fas fa-users',
        'label'  => array(
            'text' => 'Coming Soon',
            'type' => 'primary'    // default | primary | success | info | warning | danger
            ),
        'menu'  => array(
                array(
                    'content' => 'Test Menu',
                    'href'    => '#',
                    'id'      => 'btn_client_search',
                    'badge' => array(
                        'text'  => '1',
                        'color' => 'purple'
                    )
                ),
                array(
                    'content' => 'Test2 Menu',
                    'href' => '#'
                )
        ),
        'level'   => 99
    ),
    array(
        'name'   => 'Test dev name',
        'module' => 'CUENTAS',
        'icon'   => 'fas fa-bug',
        'menu'    => array(
                array(
                    'content' => 'Test Menu',
                    'href' => '#',
                    'badge' => array(
                        'text'  => '49',
                    )
                ),
                array(
                    'content' => 'Test2 Menu',
                    'href' => '#'
                )
        ),
        'level'   => 99
    ),
    array(
        'name' => 'Extras',
        'module' => 'Clientes',
        'icon'   => 'fab fa-windows',
        'menu'    => array(
                array(
                    'content' => 'Test Menu',
                    'href' => '#'
                ),
                array(
                    'content' => 'Test2 Menu',
                    'href' => '#'
                )
        ),
        //'level'   => 99
    ),
    
));

$SIDEBARMENU = (function(){

    $code = Template::loadElement();

    foreach (SIDEMENU as $value) {

        if(isset(USER['level'][strtoupper($value['module'])])){

        empty($value['level']) ? $value['level'] = 99 : $value['level'] = $value['level'];
        empty($value['icon']) ? $value['icon'] = 'fas fa-question-circle' : $value['icon'] = $value['icon'];

        if(USER['level'][strtoupper($value['module'])] >= 1 || USER['level']['ULEVEL'] >= $value['level']){
            
        $li = Template::loadElement();       

        foreach ($value['menu'] as $attr) {
        
            if(!empty($attr['badge'])){
                $badge = $attr['badge'];
                unset($attr['badge']);

                $attr['append'] = Template::createElement('span', array('class' => sprintf('badge bg-%s pull-right',  !empty($badge['color']) ? $badge['color'] : 'green'), 'content' => $badge['text'] ));
            }
            
            $li->append(Template::createElement('li', array(
                'append' => Template::createElement('a', $attr)
                ))
            );
        }

        if(!empty($value['label'])){

            $value['label'] = Template::createElement('span', array(
                'class' => sprintf('label label-%s center-block', !empty($value['label']['type']) ? $value['label']['type'] : 'success'),
                'content' => $value['label']['text']
                )
            );
        }

        $code->append(Template::createElement('div', array(
            'class' => 'menu_section',
            'append' => Template::createElement('ul', array(
                'class'  => 'nav side-menu',
                'append' => Template::createElement('li', array(
                    'append' => Template::createElement('ul', array(
                        'class' => 'nav child_menu',
                         'append' => $li
                        )),
                    'prepend' => Template::createElement('a', array(
                        'content' => empty($value['name']) ? ucfirst(strtolower($value['module'])) : $value['name'],
                        'append'  => (!empty($value['label']) ? $value['label'] : null), 
                        'prepend' => Template::createElement('i', array(
                            'class' => $value['icon'],
                             ))
                        ))            
                    ))
                ))
            ))
        );
        
    }}}

    return $code;

});

?>