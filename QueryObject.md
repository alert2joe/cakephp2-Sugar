# QueryObject


## only use QueryObject in Repository
```php
$obj = $this->getQueryObject();
```

## Service Methods
#### QueryObject::q([string],[...])
* [string] foramt : [QueryClass.functionName] , eg: Post.getLastPost
* [...]  QueryClass function properly 
* chain function return QueryObject
```php
//sample
         $obj = $this->getQueryObject();

         $obj->q('Post.join_comments')
            ->q('Post.getLastPost');
```

#### QueryObject::getArray()
* return cakephp query array
```php
//sample
         $obj = $this->getQueryObject();

         $obj->q('Post.join_comments')
            ->q('Post.getLastPost');
         $res = $this->m->find('all',$obj->getArray());
```
