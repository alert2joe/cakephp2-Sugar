<?php

class SuperAppQuery {
    static $_childInstance;
     public $mountModel = null;
     public $m = null;
     public $mName = null;

    public static function Instance($queryClass){
    if( isset(self::$_childInstance[$queryClass]) == false ){
       App::import('Model/Query', $queryClass);
       self::$_childInstance[$queryClass] = new $queryClass();

    }
       return self::$_childInstance[$queryClass];
    }

     public function __construct() {
         if($this->mountModel){
             $this->m = ClassRegistry::init($this->mountModel);
             $this->mName = $this->mountModel;
         }else{
            $modelName  = str_replace("Query", "", get_class($this));
            $this->m = ClassRegistry::init($modelName);
            $this->mName = $modelName;
         }  
     }

   public function fields($obj,$str){
       $paths = explode(",",$str);
       $cond = array();
        foreach($paths as $k=>$v){
              $cond[] = $this->mName.'.'.$v;
        }
        $fields = implode(",",$cond);
       $obj->fields($fields);
   }
   public function order($obj,$ary){
   
       $obj->order($ary);
   }
   public function where($obj,$ary){
       $obj->where($ary);
   }
   public function joins($obj,$ary){
       $obj->joins($ary);
   }
   
   public function limit($obj,$num){
       $obj->limit($num);
   }
   public function offset($obj,$num){
       $obj->offset($num);
   }
    public function group($obj,$ary){
   
       $obj->group($ary);
   }
   public function recursive($obj,$num){
       $obj->recursive($num);
   }
   
   

}