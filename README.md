2019/11/15
1.整理檔案結構，將html放入template，更新所有連結
2.解決使用者直接keyin HTML標籤，會被渲染的bug
3.新增日期查詢功能(並加入正則驗證)，將流程中與index相同的部分合併
4.會議提出問題改善
>login & register正則統一
>register加入password確認(就是keyin兩次)
>註解統一風格
>>一般單行註解
>>>##
>>class function
>>>/**
>>> *登入
>>> */

2019/11/18
新增上傳圖片功能

2019/11/20
留言新增/修改內容不得為空
刪除文章前先確認文章是否存在
所有sql查詢使用預備語句
統一前後端回復格式，增刪修一慮用true/false
PSR-2
將Post中的super global變數獨立成一個class(測試完成)
研究json web token

2019/11/21
super global變數獨立成一個class(全部測試完成)
DB:
>欄位編碼統一utf8_general_ci
>permission僅1、2，用enum取代int
>留言時間用PHPdate，不要用DB current_timestamp()
class呼叫函數一定要有回應
先定義變數為array，再塞值進去，不要直接塞
class增刪修return格式統一
upload頁面補上navbar
token測試

11/22
DB:
>id, permission屬性加上unsigned
>permission類型設為boolean
>password更改長度為60(hash後固定長度)
>img更改長度為60(md5後固定長度為32)
>img的相對路徑記在class不寫入資料庫
HTML URL 编码