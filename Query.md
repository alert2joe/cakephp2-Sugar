# Query

## setup
* 建立 Query Folder 於 /app/Model
* 建立 AppQuery.php 於 /app/Model/Query

註：或可複製 Sugar/code_snippets/Model/Query 到 /app/Model

## AppQuery.php
the AppQuery class is the parent class to all of your Query. 
AppQuery itself extends the SuperAppQuery class included in the Sugar/Vendor/ 
```php
<?php
App::uses('SuperAppQuery', 'Sugar.Vendor');
class AppQuery extends SuperAppQuery{
}
```

## call Query in Repository 

```php
/*
 /app/Model/PostRepository.php
 */
 public function getComment01($id){
        $obj = $this->getQueryObject();

         $obj->q('Post.join_comments')
            ->q('Post.getLastPost');
     ...
```

## Query
```php
<?php
App::uses('AppQuery', 'Model/Query');

class PostQuery extends AppQuery {

    public function somefunction(){  
      //Query logic goes here..
    }
}
```

## Query default Methods
#### Query::fields()
```php
  $obj->q('Comment.fields','*');
  //get array('Comment.*')  
  $obj->q('Post.fields','id,body,title');
  //get array('Post.id,Post.body,Post.title')
```
#### Query::where()
```php
  $obj->q('Comment.where',array('Post.id'=>1));
  $obj->q('Comment.where',array('Post.id = 1'));
  $obj->q('Comment.where',array('Post.id = 1','Post.title"=> "joe"));
```
#### Query::limit()
```php
  $obj->q('Comment.limit',3);
```
#### Query::offset()
```php
  $obj->q('Comment.offset',3);
```
#### Query::group()
```php
  $obj->q('Comment.group','title');
```
#### Query::order()
```php
  $obj->q('Comment.order','title');
```
#### Query::joins()
```php
  $obj->q('Comment.joins', array(
        'table' => 'channels',
        'alias' => 'Channel',
        'type' => 'LEFT',
        'conditions' => array(
            'Channel.id = Item.channel_id',
        )
    ));
```

## Query Attributes
#### Query::m   [object] (default model)
#### Query::mName [string] (default model name)
#### Query::mountModel [string] (set default model) eg. 'Post' , 'Comment'
* if mountModel = 'Comment' , Query::m = Comment model,
* if mountModel =  null(default) , Query::m will depend on Query Class name , PostQuery will load Post model.





