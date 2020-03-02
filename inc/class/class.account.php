<?php 

class Account {

    protected $id;
    protected $info;

    public function __construct($id)
    {
        $this->id = $id;

        $CODE = Encode::QUERY(array(
            'db'    => DB_LOGIN,
            'query' => sprintf('SELECT *  FROM `t_users` WHERE `id` = %s', $this->id)
        ));

        if($CODE->ROWS){
            $this->info = $CODE->ASOC(0);      
        }else{
            $this->info = false;
        }

    }

    public function __GET($props)
    {
        if (isset($this->$props)) {
            
            if($props == 'level'){
                return $this->level();            
            }else if($props == 'info'){
                return $this->info();
            }else{
                return 'unknow gets';
            }
            
        }else{
            return $this->$props;
        }       

    }

    public function info(){

        if($this->info){
             $this->info['level'] = self::level($this->info)->toArray;
        }
                
        return $this->info;
        
    }

    public static function level($info = false){  

        return new class($info) extends Account{

            public function __construct($info)
            {
                if($info){
                    $this->info = $info;
                    $this->toString = $this->info['level'];
                    $this->toArray = Self::toArray($this->info['level']);
                }
                
            }

            public function __GET($props)
            {
                if (isset($this->$props)) {
                    
                    return 'unknow get';
                    
                }else{
                    return $this->$props;
                }       

            }

            public static function Alter(array $ARRAY){

                $CADENA = Self::toString($ARRAY['level']);

                return Encode::QUERY(array(
                    'db' => DB_LOGIN,
                    'query' => sprintf("UPDATE `t_users` SET `level` = '%s' WHERE `t_users`.`id` = %s",$CADENA, $ARRAY['id'])
                ))->RESULT();
                
            }
            
            public static function toArray(string $code){ // OBTIENE LA CADENA DE TEXTO Y TRANSFORMA EN ARREGLO

                $ARRAY = explode(",", $code);
                $PERMISOS = array();
        
                foreach (MODULO as $i => $modulo) {
                    $PERMISOS[$modulo] = empty($ARRAY[$i]) ? "0" : $ARRAY[$i];
                }			
                
                return $PERMISOS;
        
            }
        
            public static function toString(array $ARRAY){ // OBTIENE EL ARREGLO Y TRANSFORMA UNA CADENA DE TEXTO SEPARADA POR COMAS
                
                $format = null;
                $text = null;

                foreach (MODULO as $i => $modulo) {
                    $format[$modulo] = empty($ARRAY[$modulo]) ? "0" : $ARRAY[$modulo];
                }                
        
                foreach ($format as $modulo => $value) {
                    $text .= ($text == NULL ? sprintf("%d",$value) : sprintf(",%d",$value));
                }               
                
                return $text;
        
            }

        };

    }
    
   
    
}


?>