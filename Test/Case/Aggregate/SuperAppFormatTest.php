<?php
App::uses('AppController', 'Controller');
App::uses('SuperAppFormat', 'Sugar.Vendor');
App::uses('AppFormat', 'Model/Format');
/**
 * PostsController Test Case
 */
class SuperAppFormatTest extends ControllerTestCase {

	public function testInstance() {
		//./Console/cake test app Agg/Main/AbcAggTest
       $a = SuperAppFormat::Instance('AaaFormat');
       $b = SuperAppFormat::Instance('AaaFormat');
       $this->assertEquals( $a, $b);
	
        //$this->markTestIncomplete('testIndex not implemented.');
	}
    public function test_arrayHasOne() {
        $a = SuperAppFormat::Instance('AaaFormat');
        $groupKey = array('Post','User','id');
        $res = array(
                    array(
                        'Post'=>array('id'=>1),
                        'User'=>array('c1'=>'a')
                    ),
                    array(
                        'Post'=>array('id'=>2),
                        'User'=>array('c2'=>'b')
                    ),
                    array(
                        'Post'=>array('id'=>2),
                        'User'=>array('c3'=>'c')
                    )
                );
            $data = $a->arrayHasOne($res,$groupKey);
            $expect = array(
                array(
                    'Post'=>array('id'=>1,'User'=>array('c1'=>'a'))),
                array(
                    'Post'=>array('id'=>2,'User'=>array('c3'=>'c'))),
            );
            pr($res);
            pr($data);
            //pr($expect);
            $this->assertEquals( $data, $expect);
    }
	public function test_arrayHasMany() {
		//./Console/cake test app Agg/Main/AbcAggTest
       $a = SuperAppFormat::Instance('AaaFormat');

       $groupKey = array('Post','Comment','id');
        $res = array(
                    array(
                        'Post'=>array('id'=>1),
                        'Comment'=>array('c1'=>'a')
                    ),
                    array(
                        'Post'=>array('id'=>1),
                        'Comment'=>array('c2'=>'b')
                    ),
                    array(
                        'Post'=>array('id'=>2),
                        'Comment'=>array('c3'=>'c')
                    )
                );
      $data = $a->arrayHasMany($res,$groupKey);
      $expect = array(
          array(
              'Post'=>array('id'=>1,'Comment'=>array(
                  array('c1'=>'a'),
                  array('c2'=>'b')
          ))),
          array(
              'Post'=>array('id'=>2,'Comment'=>array(
                  array('c3'=>'c')
          ))),
          
      );
      pr($res);
      pr($data);
      $this->assertEquals( $data, $expect);
	}



}

class AaaFormat extends AppFormat {


}