# Repository

## setup
* create Repository Folder at /app/Domain
* create AppRepository.php at /app/Domain/Repository

or copy Sugar/code_snippets/Domain/Repository 到 /app/Domain



## AppRepository.php
the AppRepository class is the parent class to all of your Repository. 
AppRepository itself extends the SuperAppRepository class included in the Sugar/Vendor/ 
```php
<?php
App::uses('SuperAppRepository', 'Sugar.Vendor');
class AppRepository extends SuperAppRepository{

}
```

## use Repository in Aggregate
Mostly, Repository use in Aggregate or Service

```php

// will load App/Domain/Repository/Main/Abc.php and return instance
$postRepo = \SugarLoad::get('Repository/Main/Abc');

// call Repository function
$lastPost = $postRepo->getLastPost();
     
```
## Repository
```php
<?php
namespace Domain\Repository\Main;
\SugarLoad::load('Repository/AppRepository');

class PostRepository extends AppRepository {

    public function somefunction(){  
      //Repository logic goes here..
    }
}
```

## Repository Methods


## Repository Attributes








