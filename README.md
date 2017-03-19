# cakephp2-Sugar
## 應付問題

 * 當系統規模變大，Controller 太多雜務需要處理
 * 當系統規模變大，MODEL要處理其他MODEL的邏輯，
 * database 邏輯 ，難以重用
 * 處理database返回的資料的邏輯，難以重用
 * model 過大

## Sugar分工方式

#### Controller（現有）： 
* 只負責HTTP REQUEST，及選擇／滙入什麼Class去處理事情，
* render view
* 特殊功能交給Componence處理 
* 雜務交給Service處理
* 接擉DB的交給Repository處理

#### Model（現有）： 
* 負責儲存CONST

 －－－－以下是新加入的－－－
  
#### Service
* 處理Controller常用的雜務，
* 沒有EVENT，只是簡單的處理雜務

#### Repository	： 
* 負責生成QueryObject，組合Query class的DB邏輯
* 接擉DB
* 負責生成FormatObject，組合Format class去處理資料
* 返回資料給 Service 或 Controller
		    
#### Query class
* 負責儲存常用的DB邏輯

#### Format class
* 負責儲存常用的資料處理邏輯





## install
```
//bootstrap.php
CakePlugin::load('Sugar', array('bootstrap' => true, 'routes' => false));

// in AppController or YourController
public $components = array('Sugar.Sugar');
```

* 複製 code_snippets/Controller/內所有FOLDER 去 Controller folder
* 複製 code_snippets/Model/內所有FOLDER 去 Model folder




