# Format & FormatObject


## only use Format in Repository
```php
$obj = $this->getFormatObject();
```

## FormatObject Methods
#### FormatObject::col([string],[targetPath],[...]);
* [string] foramt : [FormatClass.functionName] , eg: Post.col_shortDate
* [targetPath] eg :Post.create_date
* [...]  FormatClass function properly 
* chain function return FormatObject
```php
//XXXRepository.php
         $obj = $this->getFormatObject();
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
         $obj = $this->getFormatObject();
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
         $obj = $this->getFormatObject();
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

