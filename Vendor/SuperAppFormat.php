<?php
App::uses('SuperAppFormat', 'Sugar.Vendor');
class SuperAppFormat {

    static $_childInstance;
    public static function Instance($queryClass){
    if( isset(self::$_childInstance[$queryClass]) == false ){
       App::import('Model/Format', $queryClass);
       self::$_childInstance[$queryClass] = new $queryClass();

    }
       return self::$_childInstance[$queryClass];
    }


    /**
     * 
     * @param type $nestSet array('groupToArray','groupArray','groupKey')
     *                       Sample : array('Post','Comment','id')
     * @param type $res array form database
     * @return type ['Post']=>array(
     *                          ...
     *                          'Comment'=>array( [Commentdata1],[Commentdata2]...)
     *                          )
     */
    public function arrayHasMany($res,$nestSet){
        return $this->_arrayHas($nestSet,$res,'many');
    }

    /**
     *  Like arrayHasMany 
     * @param type $nestSet
     * @param type $res
     * @return type ['Post']=>array(
     *                          ...
     *                          'Comment'=>array(Commentdata)
     *                          )
     */
    public function arrayHasOne($res,$nestSet){
        return $this->_arrayHas($nestSet,$res,'one');
    }


     private function _arrayHas($nestSet,$res,$type){
        $parent = $nestSet[0];
        $childs = $nestSet[1];
        $groupByKey = $nestSet[2];
        $newRes = array();
        foreach($res as $v){
            $childData = $v[$childs];
            unset($v[$childs]);
            $tmpKey = $v[$parent][$groupByKey];
            if(isset($newRes[ $tmpKey ])==false){
                $newRes[ $tmpKey ] = $v;
                $newRes[ $tmpKey ][$parent][$childs] = array();       
            }
            if($type=='many'){
                $newRes[ $v[$parent][$groupByKey] ][$parent][$childs][]=$childData;
            }else if($type=='one'){
                $newRes[ $v[$parent][$groupByKey] ][$parent][$childs]=$childData;
            }
        }
        
        $resResetKey = array_values($newRes);
        return $resResetKey;
    }
}