<?php
App::uses('AppQuery', 'Model/Query');
App::uses('SuperAppFormat', 'Sugar.Vendor');

class SuperFormatObject {
    public $_rowFormat;
    public $_colFormat;
    public $_fullFormat;

     public function __construct($data) {
          $this->_data = $data;
          //$modelName  = str_replace("Repository", "", get_class($this));
          //$this->m = ClassRegistry::init($modelName);
          
     }

    public function init(){
        $args = func_get_args();
          $path = $args[0];
         $paths = explode(".",$path);
         $queryFn    = $paths[1];
         $queryClass = $paths[0].'Format';

        $queryClassInt = SuperAppFormat::Instance($queryClass);

         return array(
             'queryClassInt'=>$queryClassInt,
             'queryFn'=>$queryFn,
             'args'=>$args

         );

    }

    public function row(){
        $this->_rowFormat[] = func_get_args();
        return $this;
    }


    public function apply_row(){
        if(empty($this->_rowFormat)){
            return $this;
        }
        foreach($this->_rowFormat as $colSet){
             
                $colSetsClasses[] = call_user_func_array(array($this, 'init'), $colSet);
        }

        $newData = array();
        foreach($this->_data as $k=>$dataV){
            $newData[$k] = $dataV;
            foreach($colSetsClasses as $colSetsClass){
                $args = $colSetsClass['args'];
                $args[0]=$newData[$k];
                $newData[$k] = call_user_func_array(array($colSetsClass['queryClassInt'], $colSetsClass['queryFn']), $args);
            }

        }
        $this->_rowFormat = [];
        $this->_data = $newData;

         return $this;
    }

    public function col(){
        $this->_colFormat[] = func_get_args();
        return $this;
    }

    public function full(){
        $this->_fullFormat[] = func_get_args();
        return $this;
    }

    public function apply_full(){
        if(empty($this->_fullFormat)){
            return $this;
        }
        foreach($this->_fullFormat as $colSet){
             
                $colSetsClasses[] = call_user_func_array(array($this, 'init'), $colSet);
        }

       
        foreach($colSetsClasses as $colSetsClass){
            $args = $colSetsClass['args'];
            $args[0]=$this->_data;
            $this->_data = call_user_func_array(array($colSetsClass['queryClassInt'], $colSetsClass['queryFn']), $args);
        }

        $this->_fullFormat = [];
         return $this;
    }
    
    public function apply_col(){
        if(empty($this->_colFormat)){
            return $this;
        }
        foreach($this->_colFormat as $colSet){
             
                $colSetsClasses[] = call_user_func_array(array($this, 'init'), $colSet);
        }

        $newData = array();
        foreach($this->_data as $k=>$dataV){
            $newData[$k] = $dataV;
            foreach($colSetsClasses as $colSetsClass){
               
                $args = $colSetsClass['args'];
                 $colPath = $args[1];
                array_shift($args);
               
                $colValue = Hash::extract($newData[$k],$colPath);
             
                $args[0]=$colValue[0];

                $newcol =  call_user_func_array(array($colSetsClass['queryClassInt'], $colSetsClass['queryFn']), $args);

                $colPaths = explode(".",$colPath);
                if(count($colPaths)==1){
                    $newData[$k][ $colPaths[0] ] = $newcol;
                    continue;
                }
                if(count($colPaths)==2){
                    $newData[$k][ $colPaths[0] ][ $colPaths[1] ] = $newcol;
                    continue;
                }
                if(count($colPaths)==3){
                    $newData[$k][ $colPaths[0] ][ $colPaths[1] ][ $colPaths[2] ] = $newcol;
                    continue;
                }
                if(count($colPaths)==4){
                    $newData[$k][ $colPaths[0] ][ $colPaths[1] ][ $colPaths[2] ][ $colPaths[3] ]  = $newcol;
                    continue;
                }
               
            }

        }
        $this->_colFormat = [];
        $this->_data = $newData;

         return $this;
    }

    public function getData(){
        return $this->_data;
    }





 

}