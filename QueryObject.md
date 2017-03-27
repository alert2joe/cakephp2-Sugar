# QueryObject


## only use QueryObject in Repository
```php
$obj = \SugarLoad::QueryObj();
```

## Service Methods
#### QueryObject::q([string],[...])
* [string] foramt : [QueryClass.functionName] , eg: Post.getLastPost
* [...]  QueryClass function param 
* chain function return QueryObject
```php
//sample
         $obj = \SugarLoad::QueryObj();

         $obj->q('Post.join_comments')
            ->q('Post.getLastPost');
```

#### QueryObject::getArray()
* return cakephp query array
```php
//sample
        $obj = \SugarLoad::QueryObj();

         $obj->q('Post.join_comments')
            ->q('Post.getLastPost');
         $res = $this->m->find('all',$obj->getArray());
```
#### QueryObject::get($model,$type)
* return db result,
* $type param string , default = all 
* wrap cake find() function all,first,count,list,
* https://book.cakephp.org/2.0/en/models/retrieving-your-data.html

```php
//sample
         $post = \SugarLoad::Model('Post');
         $res = \SugarLoad::QueryObj()
                  ->get($post);
                  
        $res = \SugarLoad::QueryObj()
         ->get($post,'first');
```

       
