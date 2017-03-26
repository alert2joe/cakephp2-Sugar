<?php
App::uses('AppQuery', 'Model/Query');
App::uses('SuperAppQuery', 'Sugar.Vendor');
class SuperQueryObject {
 
    public $_where = array();
    public $_fields = array();
    public $_limit = null;
    public $_order = array();
    public $_joins = array();
    public $_group = array();
    public $_offset = null;
    public $_recursive = null;
    
 

    public function where($cond){
        if(is_array($cond)){
            foreach($cond as $k=>$v){
                if(is_int($k)){
                    $this->_where[]=$v;
                }else{
                    $this->_where[$k]=$v;
                }
                
            }
    
        }else{
            $this->_where[]=$cond;
        }
        return $this;
    }
    public function fields($cond){
         $this->_fields[]=$cond;
         return $this;
    }

    public function limit($num){
  
        $this->_limit = $num; 
        return $this;
    }
    public function offset($num){
        $this->_offset = $num; 
        return $this; 
    }
    public function recursive($num){
        $this->_recursive = $num; 
        return $this; 
    }
    public function order($cond){
         $this->_add('_order',$cond);
         return $this;
    }
    public function joins($cond){
         $this->_joins[] = $cond;
         return $this;
    }
    public function group($cond){
        $this->_add('_group',$cond);
        return $this;
    }

    private function _add($key,$cond){
        if(is_array($cond)){
            foreach($cond as $k=>$v){
                $this->{$key}[]=$v;
            }
        }else{
            $this->{$key}[]=$cond;
        }
    }


    public function q(){
        $args = func_get_args();
          $path = $args[0];
         $paths = explode(".",$path);
         $queryFn    = $paths[1];
         $queryClass = $paths[0].'Query';
         
         $queryClassInt = SuperAppQuery::Instance($queryClass);

 
         $args[0]= $this;
         call_user_func_array(array($queryClassInt, $queryFn), $args);
         return $this;
    }

    public function getArray(){
        $res = array();
        if(!empty($this->_fields)){
           $res['fields'] =  $this->_fields;
        }
        if(!empty($this->_where)){
           $res['conditions'] =  $this->_where;
        }
        if(!empty($this->_joins)){
           $res['joins'] =  $this->_joins;
        }

        if(!empty($this->_order)){
           $res['order'] =  $this->_order;
        }
        if(!empty($this->_group)){
           $res['group'] =  $this->_group;
        }
        if($this->_limit !=null){
           $res['limit'] =  $this->_limit;
        }
        if($this->_offset !=null){
           $res['offset'] =  $this->_offset;
        }
        if($this->_recursive !=null){
           $res['recursive'] =  $this->_recursive;
        }
        
        if(!empty($this->_contain)){
           $res['contain'] =  $this->_contain;
        }
       
        return $res;


    }


      function get($m,$type='all'){
        $ary = $this->getArray();
        return $m->find($type,$ary);

     }


}