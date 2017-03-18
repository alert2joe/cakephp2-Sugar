<?php

class SuperAppRepository {
     public $mountModel = null;
     public $m = null;
     public $mName = null;
     public function __construct() {
        if($this->mountModel){
             $this->m = ClassRegistry::init($this->mountModel);
             $this->mName = $this->mountModel;
         }else{
             $modelName  = str_replace("Repository", "", get_class($this));
             $this->m = ClassRegistry::init($modelName);
             $this->mName = $modelName;
         }  
     }

     protected function getQueryObject(){
        App::import('Model/Query', 'QueryObject');
         return new QueryObject(); 
     }
     protected function getFormatObject($data){
        App::import('Model/Format', 'FormatObject');
         return new FormatObject($data); 
     }



}