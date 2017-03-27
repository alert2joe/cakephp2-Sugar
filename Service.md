# Service

## setup
* create Service Folder at /app/Domain
* create AppService.php at /app/Domain/Service

Or copy Sugar/code_snippets/Domain/Service to  /app/Domain


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
Mostly, Repository use in Aggregate , Controller , Repository
```php
public $components = array('Sugar.Sugar');
```

```php
// will load App/Domain/Service/Main/Abc.php and return instance
// 'Main' is domain name

$postService = \SugarLoad::get('Service/Main/Post');

// call Repository function
$lastPost = $postService->getLastPost();
     
     
```
## Service
```php
<?php
namespace Domain\Service\Main;
\SugarLoad::load('Service/AppService');
class Post extends AppService {

    public function somefunction(){  
      //Service logic goes here..
    }
}
```

## Service Methods

## Service Attributes




