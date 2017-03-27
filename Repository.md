# Repository

## setup
* 建立 Repository Folder 於 /app/Domain
* 建立 AppRepository.php 於 /app/Domain/Repository

註：或可複製 Sugar/code_snippets/Domain/Repository 到 /app/Domain



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


```php
// will load App/Domain/Repository/Main/Abc.php and return instance

$postRepo = \SugarLoad::get('Repository/Main/Abc');
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








