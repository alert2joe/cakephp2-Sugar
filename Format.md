# Format & FormatObject


## only use Format in Repository
```php
$obj  = \SugarLoad::FormatObj($dbResult);
/*
$$dbResult = array(
               array(
                  'Post'=>array(
                           'id'=>1,
                           'first_name'=>'a',
                           'last_name'=>b,
                           'create_date'=>'01-02-2017 23:00:00'
                  )
               ),
               array(
                  'Post'=>array(
                           'id'=>1,
                           'first_name'=>'a',
                           'last_name'=>b,
                           'create_date'=>'01-02-2017 23:00:00'
                  )
               ),
               array(
                  'Post'=>array(
                           'id'=>1,
                           'first_name'=>'a',
                           'last_name'=>b,
                           'create_date'=>'01-02-2017 23:00:00'
                  )
               )
);

*/

```

## FormatObject Methods
#### FormatObject::col([string],[targetPath],[...]);
* [string] foramt : [FormatClass.functionName] , eg: Post.col_shortDate
* [targetPath] eg :Post.create_date
* [...]  FormatClass function properly 
* chain function return FormatObject
```php
//XXXRepository.php
         $obj = \SugarLoad::FormatObj($dbResult);
         $obj->col('Post.col_shortDate','Post.create_date')
```
```php
//PostFormat.php
App::uses('AppFormat', 'Model/Format');
App::uses('CakeTime', 'Utility');
class PostFormat extends AppFormat {

    function col_shortDate($col){
        return CakeTime::format($col, '%d-%m-%Y');
    }
    
```

#### FormatObject::row([string],[...]);
* [string] foramt : [FormatClass.functionName] , eg: Post.col_shortDate
* [...]  FormatClass function properly 
* chain function return FormatObject
```php
//XXXRepository.php
         $obj = \SugarLoad::FormatObj($dbResult);
         $obj->row('Post.addFullName')
```
```php
//PostFormat.php
App::uses('AppFormat', 'Model/Format');
App::uses('CakeTime', 'Utility');
class PostFormat extends AppFormat {

    function addFullName($row){
        $row['Post']['full_name'] = $row['Post']['first_name'] . ' '.$row['Post']['last_name']
        return $row;
    }
    
```

#### FormatObject::full([string],[...]);
* [string] foramt : [FormatClass.functionName] , eg: Post.col_shortDate
* [...]  FormatClass function properly 
* chain function return FormatObject

```php
//XXXRepository.php
         $obj = \SugarLoad::FormatObj($dbResult);
         $obj->full('Post.addDetail')
```

```php
//PostFormat.php
App::uses('AppFormat', 'Model/Format');
class PostFormat extends AppFormat {
    function addDetail($full){
        $a = array(
          'content'=>$full,
          'count'=>count($full),
        );
        return $a;
    } 
```



#### FormatObject::apply_row
#### FormatObject::apply_col
#### FormatObject::apply_full


```php
         $FObj = $this->getFormatObject();
         $FObj->col('XXXXX')
                  ->col('XXXXX')
                  ->row('XXXXX')
                  ->full('XXXXX')
                  ->full('XXXXX');
                  
         $FObj->apply_row()  // run all function added by $FObj->row(...) 
         ->apply_col()  // run all function added by $FObj->col(...) 
         ->apply_full()  // run all function added by $FObj->full(...) 

         $FObj->getData()   //return final format data
```

## Format Methods
#### Format::arrayHasMany
```php
         $FObj->full('Post.arrayHasMany',array('Post','Comment','id'));
         /*
         Array
(
    [0] => Array
        (
            [Post] => Array
                (
                    [id] => 1
                    [title] => The title
                    [Comment] => Array
                        (
                            [0] => Array
                                (
                                    [id] => 1
                                    [content] => But I must explain to 
                                    [post_id] => 1
                                    [created] => 2017-03-01
                                )


                        )

                )

        )

    [1] => Array
        (
            [Post] => Array
                (
                    [id] => 2
                    [title] => A title once again
        
                    [Comment] => Array
                        (
                            [0] => Array
                                (
                                    [id] => 3
                                    [content] => Far far away, behind the word mountains, far from the countries Vokalia and 
                                    [post_id] => 2
                                    [created] => 2017-03-01
                                )

                            [1] => Array
                                (
                                    [id] => 4
                                    [content] => One morning, when Gregor Samsa woke from troubled dreams, he
                                    [post_id] => 2
                                    [created] => 2017-03-01
                                )

                    

                        )

                )

        )
         */
         
```
#### Format::arrayHasOne
```php
         $FObj->full('Post.arrayHasOne',array('Post','User','id'));
         /*
         Array
(
    [0] => Array
        (
            [Post] => Array
                (
                    [id] => 1
                    [title] => The title
                    [User] => Array
                        (
           
                            [id] => 2
                            [name] => raymond
                                )


            

                )

        )

    [1] => Array
        (
            [Post] => Array
                (
                    [id] => 2
                    [title] => A title once again
                    [User] => Array
                        (
                            [id] => 1
                            [name] =>joe 

                        )

                )

        )
         */
         
```
