<?php

class DB {

 protected $_db;
 
	public function __construct($DATA){

	 	$this->_db= new mysqli($DATA['HOST'], $DATA['USER'], $DATA['PASS'], $DATA['DB']);
		if (mysqli_connect_errno()) {
			printf("Falló la conexión: %s\n", mysqli_connect_error());
			exit();
		}else{
		//CONFIGURACION DE PARAMETROS			
			$this->_db->set_charset($DATA['CHARSET']);		
		}
	}

	public function QUERY($QUERY){
		$RESULT = $this->_db->query($QUERY);
		$this->_db->close();
		return $RESULT;	
	}

	public function SC($data){		
		return $this->_db->real_escape_string($data);
	}
	 	
}

class Encode{

	public static function INSERT(array $DATA){
		
        $STRING['into'] = null;
        $STRING['value'] = null;
        $STRING['table'] = $DATA['table'];

		$MySQLI = new DB($DATA['db']);

            foreach ($DATA['query'] as $value) {
        
                if($STRING['into'] == null){
                    $STRING['into'] = sprintf("`%s`",$value['into']);
                }else{
                    $STRING['into'] = sprintf("%s,`%s`",$STRING['into'],$value['into']);
                }
                
            }
            foreach ($DATA['query'] as $value) {   
        
                if($STRING['value'] == null){
                    $STRING['value'] = sprintf("'%s'",$MySQLI->SC($value['value']));
                }else{
                    $STRING['value'] = sprintf("%s,'%s'",$STRING['value'],$MySQLI->SC($value['value']));
                }   
                
            }
        
		$QUERY = sprintf("INSERT INTO `%s` (%s) VALUES (%s)",$STRING['table'], $STRING['into'], $STRING['value']);		

		return $MySQLI->QUERY($QUERY);
	}

	public static function UPDATE(array $DATA){

		$SET = null;
		$WHERE = null;

		$MySQLI = new DB($DATA['db']);

		foreach ($DATA['query']['set'] as $v) {

			if($SET == null){
				$SET = sprintf("`%s` = '%s'",$v['ROW'],$MySQLI->SC($v['VALUE']));
			}else{
				$SET .= sprintf(", `%s` = '%s'",$v['ROW'],$MySQLI->SC($v['VALUE']));
			}	

		}

		foreach ($DATA['query']['where'] as $v) {

			if($WHERE == null){
				$WHERE = sprintf("`%s` = '%s'",$v['ROW'],$MySQLI->SC($v['VALUE']));
			}else{
				$WHERE .= sprintf(", `%s` = '%s'",$v['ROW'],$MySQLI->SC($v['VALUE']));
			}	

		}
		
		$QUERY = sprintf("UPDATE %s SET %s WHERE %s", $DATA['table'], $SET, $WHERE);		

		return $MySQLI->QUERY($QUERY);


	}

	public static function QUERY($DATA){
		
		$MySQLI = new DB($DATA['db']);
		$result = $MySQLI->QUERY($DATA['query']);
		
		return new class($result){
			private $result;

			public function __construct($DATA)
			{
				$this->result = $DATA;
			}
			public function __GET($props)
			{

				if (!isset($this->$props)) {
					
					if($props == 'ASOC'){
						return $this->ASOC();
					}else if($props == 'ROWS'){
						return $this->ROWS();
					}else if($props == 'RESULT'){
						return $this->result;
					}else{
						return $this->$props;
					}
					
				}else{
					return 'unknow get';
				}
				

			}
			public function ASOC($index = null){

				$ARREGLO  = null;
				$i = 0;
				while($SQLi = $this->result->fetch_array(MYSQLI_ASSOC)){
					$ARREGLO[$i] = $SQLi;
					$i++;
				}

				if(isset($index)){
					return $ARREGLO[$index];
				}else{
					return $ARREGLO;
				}
					
			}
			private function ROWS(){
				return $this->result->num_rows;
			}

			private function RESULT(){
				return $this->result;
			}

		};
	}
	
}
?>