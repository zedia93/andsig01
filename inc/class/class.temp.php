<?php
require('class.htmlDOM.php'); // htmlDOM

class Template{

    protected $template;
    protected $route;

    protected $info;

    public function __construct($info)
    {
        $this->info = $info;
        
        $this->route = sprintf("./modules/%s/templates", $this->info['name']);
        $this->template = file_get_contents(sprintf("%s/%s.tplx",$this->route,$this->info['tpl']));

    }

    public function replace(array $data){
        $i = 0;
        $Vars = array();
        $Vals = array();

        foreach ($data as $var => $value) {            
            $Vars[$i] = sprintf("{{%s}}", $var); 
            $Vals[$i] = $value;
            $i++;        
        }

        $this->template = str_replace($Vars, $Vals, $this->template);
    }

    public function addTPL(array $info){

        if(empty($info['tpl'])){

            $ETIQUETA = array(sprintf("<%s/>", $info['label'])); // NOMBRE DE LA ETIQUETA A REMPLAZAR EN EL ARCHIVO CENTRAL
            $ELEMENTO = array(empty($info['code']) ? null : $info['code']); // CONTENIDO DEL ARCHIV TPLX

            $this->template = str_replace($ETIQUETA, $ELEMENTO, $this->template); // REMPLAZO EN ARCHIVO CENTRAL


        }else{

            $ETIQUETA = array(sprintf("<%s/>", $info['label'])); // NOMBRE DE LA ETIQUETA A REMPLAZAR EN EL ARCHIVO CENTRAL
            $ELEMENTO = array(file_get_contents(sprintf("%s/%s.tplx",$this->route,$info['tpl']))); // CONTENIDO DEL ARCHIV TPLX

            $this->template = str_replace($ETIQUETA, $ELEMENTO, $this->template); // REMPLAZO EN ARCHIVO CENTRAL

        }

        
    }
    public function getTPL(string $name){

        return file_get_contents(sprintf("%s/%s.tplx",$this->route,$name)); // CONTENIDO DEL ARCHIV TPLX

    }

    static function alterElement(array $info){

        $ETIQUETA = sprintf("<%s/>", $info['label']); // NOMBRE DE LA ETIQUETA A REMPLAZAR EN EL ARCHIVO CENTRAL
        return str_replace($ETIQUETA, $info['set'], $info['element']);

    }

    // static function createElement(string $type, array $props = null){

    //     return sprintf('<%s%s%s%s>%s</%s>',
    //         !empty($type)            ? $type : 'div', 
    //         !empty($props['id'])      ? sprintf(' id="%s"', $props['id']): null,        
    //         !empty($props['class'])   ? sprintf(' class="%s"', $props['class']): null,
    //         !empty($props['href'])    ? sprintf(' href="%s"', $props['href']): null,        
    //         !empty($props['content']) ? $props['content']: null, 
    //         !empty($tipo)            ? $type : 'div'       
    //         );
    // }

    static function createElement(string $type, array $props = null){

        return new class($type, $props){

            protected $type, $element, $props;
    
            public function __construct(string $type, array $props = null)
            {
                $this->type = $type; 
                $this->props = $props;               
                
                if(!empty($type)){

                    $this->element = (new htmlDOM())->load(sprintf('<%s%s%s%s%s%s%s%s>%s%s%s</%s>',
                    !empty($type) ? $type : 'div', 
                    !empty($props['id'])       ? sprintf(' id="%s"', $props['id']): null,
                    !empty($props['name'])     ? sprintf(' name="%s"', $props['name']): null,   
                    !empty($props['value'])    ? sprintf(' value="%s"', $props['value']): ($type == 'option' ? ' value="0"': null),
                    !empty($props['class'])    ? sprintf(' class="%s"', $props['class']): null, 
                    !empty($props['href'])     ? sprintf(' href="%s"', $props['href']): null,
                    !empty($props['style'])    ? sprintf(' style="%s"', $props['style']): null,
                    !empty($props['required']) ? 'required' : null,
                    !empty($props['prepend']) ? $props['prepend'] : null,
                    !empty($props['content']) ? $props['content'] : null,
                    !empty($props['append'])  ? $props['append'] : null,
                    !empty($type) ? $type : 'div'       
                    ));

                }else{
                    $this->element = (new htmlDOM())->load(null);
                }

                
            }

            public function toString(){

                return sprintf('%s',$this->element);

            }

            public function __toString()
            {
                return sprintf('%s',$this->element);
            }

            // AGREGA OTRO ELEMENTO AL FINAL DENTRO DEL ELEMENTO RECIEN CREADO 
            //
            public function append($append){ 

                $element = $this->element->find($this->type, 0);
                $element->innertext .= (new htmlDOM())->load($append);
                $this->element = (new htmlDOM())->load($element);

            }

            // AGREGA OTRO ELEMENTO AL PRINCIPIO DENTRO DEL ELEMENTO RECIEN CREADO 
            //
            public function prepend($prepend){

               // $prepend = (new htmlDOM())->load($prepend);
                
                $element = $this->element->find($this->type, 0);               
                $prepend .= $element->innertext;
                
                $element->innertext = $prepend;

                $this->element = $element;

            }

            public function attr($attr, $val = null){
                
                if(gettype($attr) === 'array'){

                    $element = $this->element->find($this->type, 0);
                    foreach ($attr as $i => $v) {
                        $element->$i = $v;
                    }
                    $this->element = (new htmlDOM())->load($element);

                }else{
                    
                    $element = $this->element->find($this->type, 0);
                    $element->$attr = $val;
                    $this->element = (new htmlDOM())->load($element);
                }
                
                
            }           

        };

    }

    static function loadElement($el = null){

        return new class($el){

            protected $el;

            public function __construct($el){

                $this->el = (new htmlDOM())->load($el);

            }

            public function __toString()
            {
                return sprintf('%s',(new htmlDOM())->load($this->el));
            }

            // AGREGA UN ELEMENTO ANTES DEL ELEMENTO CARGADO 
            //
            public function append($append){
                $this->el .= $append;
            }

            // AGREGA UN ELEMENTO DESPUES DEL ELEMENTO CARGADO 
            //
            public function prepend($prepend){
                $prepend .= $this->el;
                $this->el = $prepend;
            }

            // SOBRE ESCRIBE EL CONTENIDO DEL ELEMENTO CARGADO 
            //
            public function content($content){
                $this->el = $content;
            }

            public function getAllElementsBy(string $val){
                return $this->el->find($val);
            }
            
            // BUSCA UN ELEMENTO ESPECIFICO DENTRO DEL ELEMENTO CARGADO 
            //
            public function getElementBy(string $val, int $i = 0){ //IMPORTANTE ESTA CLASE DEBE INSTANCIARSE APARTE DE SU PADRE lOAD

                return new class($val, $i, $this->el){

                    protected $val, $el, $index;
                    public $selected;
                    
                    public function __construct($val ,$i ,$el)
                    {   
                        $this->el = (new htmlDOM())->load($el);
                        $this->val = $val;
                        $this->index = $i;

                        $this->selected = $this->el->find($this->val, $this->index);
                    }                    

                    public function __toString()
                    {
                        return sprintf('%s',$this->el);                       
                    }

                    public function getElementBy(string $val){

                        return Template::loadElement($this->el)->getElementBy($val);
                    }

                    public function letElement(){

                        return Template::loadElement($this->el);

                    }

                    public function append($append){
                        
                        $el = $this->el->find($this->val, $this->index);
                        $el->innertext .= $append;

                    }

                    public function prepend($prepend){

                        $el = $this->selected;
                        $prepend .= $el->innertext;
                        $el->innertext = $prepend;
                    }

                    public function content($content){

                        $el = $this->selected;
                        $el->innertext = $content;
                    }

                    public function getAttr($attr){                       

                        return $this->selected->$attr;
                    }

                    public function setAttr($attr, $val = null){
                        
                        $el = $this->selected;

                        if(gettype($attr) === 'array'){    
                            foreach ($attr as $i => $v) {
                                $el->$i = $v;
                            }        
                        }else{                            
                            $el->$attr = $val;                            
                        }                        
                        
                    }           
        

                };

            }

        };

    }

    public function render(){

        $dom = new DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($this->template, 'HTML-ENTITIES', 'UTF-8'));
        
        echo $dom->saveHTML();

    }

}

class Element{

   protected $type, $props;
   public $result;
    
            // public function __construct(string $type, array $props)
            // {
            //     $this->type = $type; 
            //     $this->props = $props;               
                
            //     $this->result = (new htmlDOM())->load(sprintf('<%s%s%s%s%s>%s</%s>',
            //     !empty($type)            ? $type : 'div', 
            //     !empty($props['id'])      ? sprintf(' id="%s"', $props['id']): null,
            //     !empty($props['name'])    ? sprintf(' name="%s"', $props['id']): null,   
            //     !empty($props['class'])   ? sprintf(' class="%s"', $props['class']): null,
            //     !empty($props['href'])    ? sprintf(' href="%s"', $props['href']): null,        
            //     !empty($props['content']) ? $props['content']: null, 
            //     !empty($type)            ? $type : 'div'       
            //     ));
            // }

            public function Create(string $type, array $props = null)
            {

                $this->type = $type; 
                $this->props = $props;
                
                $this->result = (new htmlDOM())->load(sprintf('<%s%s%s%s%s>%s</%s>',
                !empty($type)            ? $type : 'div', 
                !empty($props['id'])      ? sprintf(' id="%s"', $props['id']): null,
                !empty($props['name'])    ? sprintf(' name="%s"', $props['id']): null,   
                !empty($props['class'])   ? sprintf(' class="%s"', $props['class']): null,
                !empty($props['href'])    ? sprintf(' href="%s"', $props['href']): null,        
                !empty($props['content']) ? $props['content']: null, 
                !empty($type)            ? $type : 'div'       
                ));

            }

            // public function Get(string $type){

            //     $element = $this->result->find($this->type, 0);
            //     $element->innertext = (new htmlDOM())->load($var);
            //     $this->result = (new htmlDOM())->load($element); 

            // }

            public function append($var){

                $element = $this->result->find($this->type, 0);
                $element->innertext = (new htmlDOM())->load($var);
                $this->result = (new htmlDOM())->load($element); 

            }

            public function getAttr($attr){
                
                $element = $this->result->find($this->type, 0);
                return $element->attr;
            }

            public function setAttr($attr, $val = null){
                
                if(gettype($attr) === 'array'){

                    $element = $this->result->find($this->type, 0);
                    foreach ($attr as $i => $v) {
                        $element->$i = $v;
                    }
                    $this->result = (new htmlDOM())->load($element);

                }else{
                    
                    $element = $this->result->find($this->type, 0);
                    $element->$attr = $val;
                    $this->result = (new htmlDOM())->load($element);
                }
                
                
            }
        
            public function result()
            {
                return $this->result;
            }

}

?>