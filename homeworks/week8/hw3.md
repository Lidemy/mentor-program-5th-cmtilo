## 什麼是 Ajax？
Asynchronous JavaScript and XML
免換頁，不會造成頁面重載！
一種統稱，任何非同步跟伺服器交換資料的 JS 都算 ajax，因早期 xml 格式蔚為風潮所以這樣命名。
受同源政策管理。


## 用 Ajax 與我們用表單送出資料的差別在哪？
用表單送出交換資料請求時，瀏覽器會重新載入頁面，而 Ajax 不會造成頁面重載！


## JSONP 是什麼？
透過<script>的 src 屬性拿取資料，不受同源政策管理，可以跨域拿取資料，用 JavaScript 執行 function 傳資料，但現在少人用。


## 要如何存取跨網域的 API？
Same origin policy 同源政策：
相同protocol、相同 domain、相同port 即是同源。
簡單來說別人的網站跟你的不同源，為了安全性，不同源不可以拿資料，這是瀏覽器故意提供的限制，如果沒有瀏覽器就無此限制。
Cross-Origin Resource Sharing（CORS）跨來源資源共用：
在同源限制之下，如允許跨來源請求，只要在 Response Headers 加上 access-control-allow-origin: * ，表示為自願開放的即可存取跨網域的 API。


## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
第四週跟第八週是透過不同 runtime 串 API。
第四週透過 node.js 拿取資料，拿到什麼就是什麼，拿到的東西不會被改過；而瀏覽器為了安全性的把關會有一些限制，且不一定能拿到資料。比如同源政策就是瀏覽器提供的限制。

