# Aggregate

## setup
* create Aggregate Folder at /app/Domain
* create AppAggregate.php at /app/Domain/Aggregate

or copy Sugar/code_snippets/Domain/Aggregate 到 /app/Domain



## AppAggregate.php
the AppAggregate class is the parent class to all of your Aggregate. 
AppAggregate itself extends the SuperAppAggregate class included in the Sugar/Vendor/ 
```php
<?php
App::uses('SuperAppAggregate', 'Sugar.Vendor');
class AppAggregate extends SuperAppAggregate{

}
```

## use Aggregate in conroller
Mostly, Aggregate use in Aggregate or Controller

```php

// will load App/Domain/Aggregate/Main/Abc.php and return instance
$postAgg = \SugarLoad::get('Aggregate/Main/Abc');

// call Aggregate function
$lastPost = $postAgg->getLastPost();
     
```
## Aggregate
```php
<?php
namespace Domain\Aggregate\Main;
\SugarLoad::load('Aggregate/AppAggregate');

class PostAggregate extends AppAggregate {

    public function somefunction(){  
      //Aggregate logic goes here..
    }
}
```

## Aggregate Methods


## Aggregate Attributes








