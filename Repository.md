# Repository

## setup
* 建立 Repository Folder 於 /app/Model
* 建立 AppRepository.php 於 /app/Model/Repository

註：或可複製 Sugar/code_snippets/Model/Repository 到 /app/Model



## AppRepository.php
the AppRepository class is the parent class to all of your Repository. 
AppRepository itself extends the SuperAppRepository class included in the Sugar/Vendor/ 
```php
<?php
App::uses('SuperAppRepository', 'Sugar.Vendor');
class AppRepository extends SuperAppRepository{

}
```

## use Repository in Controller

```php
public $components = array('Sugar.Sugar');
```

```php
/*
 /app/Controller/postController
 */

  public function view($id) {
			$this->Sugar->loadRepo('Post');
			$this->PostRepo->someFunction(1);
  }
     
```
## Repository
```php
<?php
App::uses('AppRepository', 'Model/Repository');

class PostRepository extends AppRepository {

    public function somefunction(){  
      //Service logic goes here..
    }
}
```

## Repository Methods
#### Repository::getQueryObject()

* return new QueryObject

#### Repository::getFormatObject()

* return new FormatObject

## Controller Attributes
#### Repository::m   [object] (default model)
#### Repository::mName [string] (default model name)
#### Repository::mountModel [string] (set default model) eg. 'Post' , 'Comment'
* if mountModel = 'Comment' , Repository::m = Comment model,
* if mountModel =  null(default) , Repository::m will depend on Repository Class name , PostRepository will load Post model.








