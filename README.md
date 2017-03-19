# cakephp2-Sugar
應付問題

 * 當系統規模變大，Controller 太多雜務需要處理
 * 當系統規模變大，MODEL要處理其他MODEL的邏輯，
 * database 邏輯 ，難以重用
 * 處理database返回的資料的邏輯，難以重用
 * model 過大

Sugar分工方式

 * Controller（現有）： 只負責HTTP REQUEST，及選擇／滙入什麼Class去處理
 * Model（現有）： 負責儲存CONST
 
 －－－－以下是新加入的－－－
  
 * Service	： 處理Controller常用的雜務，

 * Repository	： 負責生成queryObject，
		    使用不同的query class 把DB邏輯儲存於queryObject內，
		    接擉DB， 取資料 ， 
		    使用不同的 Format class處理資料後返回給 Service 或 Controller
		    
 * Query class	： 負責儲存常用的DB邏輯

 * Format class	： 負責儲存常用的處理資料邏輯





## install
```
//bootstrap.php
CakePlugin::load('Sugar', array('bootstrap' => true, 'routes' => false));

// in AppController or YourController
public $components = array('Sugar.Sugar');
```

Copy code_snippets/Controller/內所有FOLDER 去 Controller folder

Copy code_snippets/Model/內所有FOLDER 去 Model folder

XXXXService.php

XxxxFormat.php

XxxxQuery.php

XxxxRepository.php


XXXX 改為你需要的名字，通常對應 Model名


### import Service/Repository in Controller
```
			$this->Sugar->loadService('Post');
			pr($this->PostService->tt());


			$this->Sugar->loadRepo('Post');
			$this->PostRepo->getComment01(1);
```

### import repository in Service
```
    $this->loadRepo('Post');    
		$this->PostRepo->getComment01(1);
```

### use QueryObject
```
//function in PostRepository.php  

$obj = $this->getQueryObject();
$obj->q('Post.getHotPost') // will call function getHotPost at PostQuery.php  
$obj->getArray();  //return cakephp query array

//query default function
$obj->q('Post.fields','id,title,body') 
$obj->q('Post.where',array('id'=>1)) 
$obj->q('Post.limit',3) 
$obj->q('Post.order','id') 
$obj->q('Post.joins',array(...)) 
$obj->q('Post.group','title')

//sample
$obj = $this->getQueryObject();
$obj->q('Post.getHotPost')
    ->q('Post.limit',3)
    ->q('Post.fields','id,title,body');
    
$res = $this->m->find('all',$obj->getArray());  // $htis->m = Repository default model
 
```
### use formatObject
```
//function in PostRepository.php  

$FObj = $this->getFormatObject($res);

// call function
$FObj->col('Post.col_shortDate','Post.created');

/*
in PostFormat.php
    function col_shortDate($col){
        return CakeTime::format($col, '%d-%m-%Y');
    }
*/
$FObj->row('Post.row_formatTitle');
/*
in PostFormat.php
    function row_formatTitle($row){
        $row['Post']['newTitle']= $row['Post']['title'] .'['.$row['Post']['created'].']';
        return $row;
    }
*/
$FObj->full('Post.full_detail');
/*
in PostFormat.php
    function full_detail($data){
      
      $res = array(
            'count'=>count($data),
            'Data'=>$data,
        );
        return  $res;
    }
*/

$FObj->apply_row()  // run all function added by $FObj->row(...) 
$FObj->apply_col()  // run all function added by $FObj->col(...) 
$FObj->apply_full()  // run all function added by $FObj->full(...) 

$FObj->getData()   //return data
```


