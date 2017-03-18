# cakephp2-Sugar
mid-scale projects structure

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

###import repository in Service
```
    $this->loadRepo('Post');    
		$this->PostRepo->getComment01(1);
```

### use QueryObject
```
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
    
$res = $this->m->find('all',$obj->getArray());  // $htis->m is default model
 
```



