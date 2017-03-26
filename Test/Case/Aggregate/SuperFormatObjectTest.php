<?php
App::uses('AppController', 'Controller');
App::uses('SuperFormatObject', 'Sugar.Vendor');
App::uses('AppFormat', 'Model/Format');
/**
 * PostsController Test Case
 */
class SuperFormatObjectTest extends ControllerTestCase {
    public function test_noAction(){
        $res = array(
                    array(
                        'Comment'=>array('content'=>'a')
                    ),
                    array(
                        'Comment'=>array('content'=>'b')
                    ),
 
                );
        $FObj = \SugarLoad::FormatObj($res);
        $FObj->apply_full()->apply_col()->apply_row();
        $data = $FObj->getData();
        $expect = $res;
        $this->assertEquals( $data, $expect);
    }
    public function test_full(){
        $res = array(
                    array(
                        'Comment'=>array('content'=>'a')
                    ),
                    array(
                        'Comment'=>array('content'=>'b')
                    ),
 
                );
        $FObj = \SugarLoad::FormatObj($res);
        $FObj->full('Aaa.full_addCount')
                ->apply_full();
        $data = $FObj->getData();
        $expect = array(   
            'count'=>count($res),
            'data'=>$res,
        );
        $this->assertEquals( $data, $expect);
    }


    public function test_row(){
        $res = array(
                    array(
                        'Post'=>array('title'=>'t1'),
                        'Comment'=>array('content'=>'c1')
                    ),
                    array(
                        'Post'=>array('title'=>'t2'),
                        'Comment'=>array('content'=>'c2')
                    ),
 
                );
        $FObj = \SugarLoad::FormatObj($res);
        $FObj->row('Aaa.row_combineTitle')
                ->apply_row();
        $data = $FObj->getData();
        pr($data);
        $expect =  array(
         't1:::c1',
    't2:::c2'
        );
        $this->assertEquals( $data, $expect);
    }

    public function test_col(){
        $res = array(
                    array(
                        'Comment'=>array('content'=>'a')
                    ),
                    array(
                        'Comment'=>array('content'=>'b')
                    ),
 
                );
        $FObj = \SugarLoad::FormatObj($res);
        $FObj->col('Aaa.col_addIcon','Comment.content','^_^')
                ->apply_col();
        $data = $FObj->getData();
        pr($data);
        $expect = array(
                    array(
                        'Comment'=>array('content'=>'^_^--a')
                    ),
                    array(
                        'Comment'=>array('content'=>'^_^--b')
                    ),
 
                );
        $this->assertEquals( $data, $expect);
    }


}

class AaaFormat extends AppFormat {
    function col_addIcon($col,$icon){
        return $icon.'--'.$col;
    }
    function row_combineTitle($row){
        $row = $row['Post']['title'] . ':::'.$row['Comment']['content'];
        return $row;
    }
    function full_addCount($data){
        $res = array(   
            'count'=>count($data),
            'data'=>$data,
        );
        return $res;
    }

}