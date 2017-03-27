<?php
App::uses('AppController', 'Controller');
App::uses('SuperQueryObject', 'Sugar.Vendor');
App::uses('AppQuery', 'Model/Query');
/**
 * PostsController Test Case
 */
class SuperQueryObjectTest extends ControllerTestCase {
    public function test_where(){
        $FObj = \SugarLoad::QueryObj();
        $FObj->where(array('post.id'=>1));
        $data = $FObj->getArray();
        $expect = array(
                    'conditions' => array('post.id' => 1)
        );
        $this->assertEquals( $data, $expect);

        $FObj = \SugarLoad::QueryObj();
        $FObj->where(array('post.id = 1'));
        $data = $FObj->getArray();
        $expect = array(
                'conditions' => array('post.id = 1')
        );
        $this->assertEquals( $data, $expect);

        $FObj = \SugarLoad::QueryObj();
        $FObj->where(array( 'OR'=>array( 'post.id = 1','post.id = 2')));
        $data = $FObj->getArray();
        $expect = array(
                'conditions' => array(
                    'OR'=>array( 'post.id = 1','post.id = 2')
                    )
        );
        $this->assertEquals( $data, $expect);
    }

    public function test_q(){
        $Obj = \SugarLoad::QueryObj();
        $data = $Obj->q('Tmp.newPost',3)->getArray();
        pr($data);
        $expect = array(
            'order'=>array('Post.id desc'),
            'limit'=>3
        );
        $this->assertEquals( $data, $expect);
    }

    public function test_fields(){
        $Obj = \SugarLoad::QueryObj();
        $data = $Obj->q('Tmp.fields','id,title')->getArray();
        pr($data);
        $expect = array(
            'fields' => array('Tmp.id,Tmp.title')
        );
        $this->assertEquals( $data, $expect);
    }
    
    /*
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

*/
}

class TmpQuery extends AppQuery {
   public function newPost($obj,$num){
       $obj->limit($num);
       $obj->order('Post.id desc');
   }

}
