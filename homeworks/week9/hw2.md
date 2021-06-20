## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
VARCHAR：預期輸入欄位長度較短時使用，可以指定大小限制，介於1~65535 字元。
TEXT ：預期輸入欄位會較長的時候使用，無法指定大小限制，固定大小為 65535 字元。


## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？
cookie 其實就是一個小型文字檔，紀錄 name、value 等。path 用來記錄哪些路徑可以存取這個 cookie，如果 path 為 / ，表示 localhost 底下每個頁面都可共享此 cookie。
HTTP 的無狀態性，每次 request 都是新的，登入機制無法實作，cookie 就是為了解決此問題。
cookie 經由 server 設定，用 HTTP header 的 set-cookie 指令，server 傳一個 response 的 header，client 端瀏覽器收到後就會存起來，之後在訪問同頁面時，瀏覽器再自動幫我們帶上符合條件的 cookie（沒有過期、domain 路徑符合）在 HTTP request，server 看到 cookie 就知道是同一個人，透過 cookie 機制維持狀態實作登入機制。


## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
會員註冊之後還要再登入才能留言很麻煩。
目前沒有備份機制，假設資料庫壞了會員資料就都沒了。
會員密碼不應該讓任何人有機會知道，應該要亂碼存起來。
會員沒有區分權限，VIP才可以編輯留言。



