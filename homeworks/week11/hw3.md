## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
### 雜湊：
將資料經過雜湊函式演算之後建立雜湊值，多對一的關係，具有不可逆的特性，無法再還原成原始資料。密碼經過雜湊之後再存入資料庫，可確保就算資料庫被攻擊，資料被看光光了，攻擊者也無法將密碼還原，保護使用者密碼不外洩。
### 加密：
一個密碼加密之後變成密文，經過解密之後可以得到明文。加密跟解密都需金鑰 key，有很多不同的加密方式，但都是一對一的關係，所以就算攻擊者沒有金鑰還是有可能將加密方式破解。

## `include`、`require`、`include_once`、`require_once` 的差別
`include` 與 `require` 皆為引入檔案之用，且會重複引入。
兩者之差異為：如 include 引入的檔案不存在，顯示 E_WARNING，其餘程式碼照常執行；如 require 引入的檔案不存在，顯示E_ERROR，其餘程式碼停止執行。
`include_once`：與 include 相同，差別在於重複引入檔案的話，只會引入1次不會重複引入。
`require_once`：與 require 相同，差別在於重複引入檔案的話，只會引入1次不會重複引入。

## 請說明 SQL Injection 的攻擊原理以及防範方法
攻擊原理：攻擊者透過 input 輸入的方式，寫入語法造成 SQL 語法語意改變，藉此攻擊資料庫，可撈出資料或是更改資料。
防範方法：不要信任使用者輸入的資料！不要使用字串拼接的 SQL 語法，使用 prepared statement 函式存取參數，使用者輸入的資料只會被當作參數處理，不會變成 SQL 語法的一部分。

##  請說明 XSS 的攻擊原理以及防範方法
### Cross Site Script
攻擊原理：攻擊者透過網址列或 input 欄位，惡意竄改網頁程式碼，可能為 HTML 或 Javascript。
* 分為三種：Reflected XSS、Stored XSS、DOM-Based XSS
* Reflected XSS：將 script 藏在網址列，讓使用者點擊被植入 Javasript 的 URL ，點擊時就會執行惡意 Javasript 。
* Stored XSS：將惡意程式碼存入資料庫，資料被調用時就會執行惡意程式碼。
* DOM-Based XSS：與前兩者差異為需要在 client 端進行防範。 client 端執行 DOM 的時候，如果沒有經過嚴格檢查就會產生漏洞，造成瀏覽器解析過程動態改變頁面 DOM tree，執行惡意程式碼。
防範方法：透過轉譯跳脫字元，讓瀏覽器將惡意程式碼當作純文字呈現，而非當作程式碼執行，比如 PHP 的 htmlspecialchars 函式或 Javasript 的 textContent 、innerText。


## 請說明 CSRF 的攻擊原理以及防範方法
### Cross Site Request Forgery
攻擊原理：讓使用者透過連結去到假的網站，攻擊者藉機冒用使用者身分，利用瀏覽器 cookie 機制，讓瀏覽器以為假的行為是使用者真正想操作的行為。
防範方法：
確認發出請求的 domain 是否為同一 domain 或安全的來源。
確認使用者身分，如簡訊驗證。
盡量不要保持登入狀態。
在請求中加入攻擊者無法偽造的資料，且不存在於 cookie 中，如加入一個隨機產生的 token。
