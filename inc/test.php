<?php
// llamando archivos complementarios
//
require_once('inc.functions.security.php');
require_once('./class/class.account.php');
require_once('./class/class.temp.php');

header("Content-Type: application/json");


$a = array(
    'content' => 'Test Menu <span class="badge bg-green pull-right">1</span>',
    'href' => 'page_403.html',
    'badge' => array(
        'text'  => 'hola',
        'color' => 'green'
    )
);

echo json_encode((new Account(1))->info);

// //echo json_encode($a);

// $clave = array_search('badge', array_keys($a));

// $b= array_values($a);
// //echo json_encode($b[$clave]);

// //$a = array_values($a);

// unset($a['badge']);

// echo json_encode($a);
// $var = Template::CreateElement(array(
//     'type'  => 'div',
//     'content' => Template::CreateElement(array(
//         'type'  => 'li',
//         'content' => Template::CreateElement(array(
//             'type' => 'i',
//             'class' => 'fas fa-sign-out-alt pull-right'
//             )).'Salir',
//         'id'    => 'btn_logout',
//         'href'  => 'javascript:;',
//         'level' => 1
//     ))
// ));

// Create a DOM object

// $type = 'div';
// $html = (new htmlDOM())->load('<h1><div id="jose" class="btn" test="joseww"><h1>Hola</h1></div><div id="jose">Hola2</div><div><h2>Mycol</h1></h1>');
// $ret = $html->find($type, 0);
// $ret->joto = 'Hola';

// echo $ret;

// foreach ($ret as $value) {
//     echo $value->innertext;
// }

$var = Template::createElement('div', array('id'=> 'test', 'class' => "tupeo", 'content' => 'soy var'));
// $var2 = Template::createElement('div', array('id'=> 'test', 'class' => "tupeo", 'content' => '<h1>Hola</h1>'));

$a = Template::createElement('div', array('class' => 'btn', 'id' => 'tuma'));
//$a->attr('id','tuka');
//$a->append(Template::createElement('li', array('id' => 'nojodas', 'text' => 'JOMA')));

//echo $a;
//$B = Template::loadElement(Template::createElement('div'));
// $B->appendChild($var);
// $B->setAttr('j','d');
//$B->append(Template::createElement('a'));

// // // $B = Template::loadElement();
// // // $B->prepend($a);
// // // $B->prepend($var);
// // // //$B->content(Template::createElement('a'));
// // // $B = $B->getElementBy('div#test')->append('<div id="candela">Agregado</div>');
// // // //$B->append(Template::createElement('a'));
// // // //echo $B->getCode();
// // // $B->append(Template::createElement('a', array('append' => Template::createElement('li'))));
// // // //$B = $B->getElementBy('div#candela')->setAttr('class', 'dominic');
// // // $B = $B->getElementBy('div#candela');
// // // $B->append('<div>Candelita</div>');
// // // $B->append('<div>Candy</div>');
// // // echo $B;

// $A = Template::loadElement();
// $A->append($a);
// $A->append($var);

// $A = $A->getElementBy('div.tupeo');
//         $A->append(Template::createElement('span', array('id' => 'candela')));     
//         $A->append(Template::createElement('span', array('id' => 'candela2', 'content' => 'soy 2')));
//         //$A->content(Template::createElement('div', array('content' => 'remplazo todo')));
//         $A->setAttr('mami','teAmo');
// $A = $A->getElementBy('div#tuma');
//         $A->append(Template::createElement('span', array('id' => 'candela3')));
// $A = $A->getElementBy('span#candela');
//         $A->content('soy candela');
// $A = $A->letElement();


// // echo $A;

// $CODE = array(
//     'db'    => DB_LOGIN,
//     'table' => 't_users',
//     'query' => array(
//             'set' => array(
//                 array(
//                     'ROW' => 'name',
//                     'VALUE' => 'JOSE'
//                 ),
//                 array(
//                     'ROW' => 'level',
//                     'VALUE' => 12
//                 ),
//             ),                    
//             'where' => array(
//                 array(
//                     'ROW' => 'id',
//                     'VALUE' => 1
//                 )
                
//             )
//     ),
    
// );

// $USERS = Encode::UPDATE($CODE);

// echo $USERS;

//echo json_encode((new Account(1))->EncondeLevel(array( 'USUARIO' => 1, 'TECNICO' => 0)));
//echo json_encode((new Account(1))->DecodeLevel(1));
//echo json_encode((new Account(1))->level()->Alter(array( 'ULEVEL' => 5, 'CATEGORIA' => 1)));

// $LEVEL = (new Account(1))->level()->toArray;

// echo json_encode($LEVEL);

// $LEVEL['CATEGORIA'] = 16;

// (new Account(1))->level()->Alter($LEVEL);

//echo (new Account(1))->GetInfo()['name'];

//$QUERY = 'SELECT * FROM `t_users`';

//echo json_encode((new DB(DB_LOGIN))->QUERY($QUERY)->num_rows);


// $CODE = array(
//     'db'    => DB_LOGIN,
//     'table' => 't_users',
//     'query'  => array(
//             array(
//                 'into' => 'user',
//                 'value' => $var
//             ),
//             array(
//                 'into' => 'pwd',
//                 'value' => md5('15425302')
//             )
//         )
// );

//echo json_encode($CODE);
//echo Encode::INSERT($CODE);

// $QUERY = array(
//     'db'    => DB_LOGIN,
//     'query' => sprintf("SELECT userId FROM `t_logs` WHERE `token` LIKE '%s' AND `status` = 1",$_COOKIE['tokenId'])
// );

// $SQL = new DB(DB_LOGIN);
// $RESULT = $SQL->QUERY('SELECT * FROM t_users');


// while ($r = $RESULT->fetch_array()) {
    
//     echo json_encode($r);
// }

//echo json_encode($QUERY);
//echo json_encode(Encode::QUERY($QUERY)->ASOC());
//echo Encode::QUERY($QUERY)->ASOC()['userId'];
// foreach (Encode::QUERY($QUERY)->ASOC() as $index => $value) {
//     echo sprintf("index: %s | Contenido %s </br>",$index, $value['id']);
// }


// while($SQLi = Encode::QUERY($QUERY)->ASOC()){

//     echo json_encode($SQLi);
    
// }

// $MySQLI = new DB($QUERY['db']);
// $RESULT = $MySQLI->QUERY($QUERY['query']);

// while($SQLi = $RESULT->fetch_array(MYSQLI_ASSOC)){

//     echo json_encode($SQLi);
    
// }

// foreach (Encode::QUERY($QUERY)->ASOC() as $key) {
//     echo json_encode($key);
// }

// $QUERY = array(
//     'db' => DB_LOGIN,
//     'query' => 'INSERT INTO `t_logs` (`token`) VALUES (`token`);'
// );

// $mystring = 'dassssssssssss{{JOSE GIMENEZ}}ssskjllllllllllllllllllllll';
// $tamaño = strlen($mystring);
// $findme   = '{{';
// $incio = strpos($mystring, $findme);

// $findme2   = '}}';
// $fin = strpos($mystring, $findme2);

// // Nótese el uso de ===. Puesto que == simple no funcionará como se espera
// // porque la posición de 'a' está en el 1° (primer) caracter.
// if ($incio === false && $fin === false) {
//     echo "¡Error!";
// } else {
//     echo "</br>";
//     echo $mystring;
//     echo "</br>";
//     echo "Inicio $incio";
//     echo "</br>";
//     echo "Fin $fin";
//     echo "</br>";
//     echo strlen($mystring);
//     echo "</br>";
//     echo ($fin-$incio);
//     echo "</br>";
    
//    echo substr($mystring , ($incio+2), (($fin-2)-($incio)));
// }
// $conv = array("%var%" => "Princes");
// echo strtr("<h1>Hola %var%</h1>", $conv);

//echo strtr("veronica mi mama te ama", "am", "01"),"\n";

// $var = 'ABCDEFGH:/MNRPQR/';
// echo "Original: $var<hr />\n";

// /* Estos dos siguientes reemplazan 'MNRPQR' en $var por 'bob'. */
// echo substr_replace($var, 'bob1', 10, -1) . "<br />\n";
// echo substr_replace($var, 'bob2', -7, -1) . "<br />\n";

// $html = '<div></div>';
// $dom = new DomDocument();
// $dom->loadHTML($html);

// $node = $dom->getElementsByTagName('div')->item(0); // your div to append to

// $fragment = $dom->createDocumentFragment();
// $fragment->appendXML('<ul><li>some items</li><li>some items</li><li>some items</li></ul>');

// $node->appendChild($fragment);

// var_dump($dom->save("Holsa"));




?>