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
}