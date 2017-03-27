# cakephp2-Sugar
## 针對問題

 * 當系統規模變大，Controller 太多雜務需要處理
 * 當系統規模變大，MODEL要處理其他MODEL的邏輯，
 * database 邏輯 ，難以重用
 * 處理database返回的資料的邏輯，難以重用
 * model 過大

## Sugar分工方式

#### Controller（現有）： 
* Domain是系統，Controller不是系統一部份
* Controller負責操作不同 DOMAIN 系統


#### Model（現有）： 
* 負責儲存CONST
* 是 Model 的

 －－－－以下是新加入的－－－
### Domain
* Domain是多個系統，角度或領域
* 最終都會描述DB。像MVC的MODEL
* 多個系統用以分類不同的角度去描述DB這物件
例：
* 有個DB物件叫做"狗"，
* 在［人］這Domain中，狗是竉物，會走，會叫。
* 在［狗蚤］這Domain中，狗是居住的地方，是食糧提供者。
* 在［竉物店］這Domain中， 狗是貨品，有價錢，有成本，有拆舊。


#### Domain->Aggregate
* 處理該Domain中的邏輯
* 是Domain的入口

#### Domain->Service
* 處理該Domain中不是單獨Aggregate該做的事務，
* 沒有EVENT，只是簡單的處理

#### Domain->Repository	： 
* 處理該Domain中的DB邏輯
* 負責生成QueryObject，組合Query class的DB邏輯
* 接擉DB
* 負責生成FormatObject，組合Format class去處理資料
* 返回資料給 Service 或 Aggregate
	
	
	
	
#### Query class
* 負責儲存常用的DB邏輯

#### Format class
* 負責儲存常用的資料處理邏輯





## Install
copy all files to app/Plugin ,rename to Sugar


* 複製 code_snippets/Domain/內所有FOLDER 去 App/Domain
* 複製 code_snippets/Model/內所有FOLDER 去 Model folder


# Document 還未整理完成。你或可由UNITTEST 去了解作用。

[Repository](https://github.com/alert2joe/cakephp2-Sugar/blob/master/Repository.md)

[Service](https://github.com/alert2joe/cakephp2-Sugar/blob/master/Service.md)

[QueryObject](https://github.com/alert2joe/cakephp2-Sugar/blob/master/QueryObject.md)

[Query](https://github.com/alert2joe/cakephp2-Sugar/blob/master/Query.md)

[Format](https://github.com/alert2joe/cakephp2-Sugar/blob/master/Format.md)



