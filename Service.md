# Service

## setup
* 建立 Service Folder 於 /app/Controller
* 建立 AppService.php 於 /app/Controller/Service

註：或可複製 Sugar/code_snippets/Controller/Service 到 /app/Controller



## AppService.php
the AppService class is the parent class to all of your Service. 
AppService itself extends the SuperAppService class included in the Sugar/Vendor/ 
```php
<?php
App::uses('SuperAppService', 'Sugar.Vendor');
class AppService extends SuperAppService {

 
}
```

## use Service in Controller

```php
public $components = array('Sugar.Sugar');
```

```php
/*
 /app/Controller/postController
 */

  public function view($id) {
    $this->Sugar->loadService('Post');
    pr($this->PostService->somefunction());
  }
     
```
## Service
```php
<?php
App::uses('AppService', 'Controller/Service');

class PostService extends AppService {

    public function somefunction(){  
      //Service logic goes here..
    }
}
```

## Service Methods
Service::loadRepo(string $RepositoryName)
will add $RepositoryName+Repo member
```php
    $this->loadRepo('Post');         
		$this->PostRepo->getComment01(1);
```

Service::loadService(string $ServiceName)



## Controller Attributes
$this->Controller



