## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？
Domain Name System 網域名稱系統
將人們可讀取的網域名稱，對應到電腦讀取的 IP 位址，類似人名跟電話號碼的概念，而 DNS 就是那本電話簿。
Google所提供的公開的DNS ，對Google來說，可以蒐集使用者的上網習慣跟使用紀錄等；對一般大眾來說，可以得到更快的解析速度，還能過濾惡意網站。


## 什麼是資料庫的 lock？為什麼我們需要 lock？
Transaction 指的是資料庫交易，對資料進行讀取或修改的操作，當同時有不同的交易對同一筆資料進行操作時，為避免造成資料不一致，資料庫便會進行鎖定，在第一個交易寫入完成，第二個交易才可進行操作，這便是資料庫的 Lock。
不同的鎖定技術如：二元鎖定 (Binary Locking)、共享互斥鎖定 (Shared and Exclusive Locking)、兩階段鎖定 (Two Phase Locking)。

為什麼需要 Lock 呢？就好比同一份文件，有 2 個人各自編輯修改，那儲存的版本是要用 A子修改或B子修改的？這時候如果由A子修改完成再交由B子修改就不會有這樣的窘境了。
修改文件事小，但如果是金錢往來或是其他重要資訊呢？所以我們需要 lock 鎖住每次交易的進行，避免資料同步寫入產生衝突，維持資料一致性。

參考資料：
https://www.qa-knowhow.com/?p=383
https://docs.microsoft.com/zh-tw/sql/relational-databases/sql-server-transaction-locking-and-row-versioning-guide?view=sql-server-ver15


## NoSQL 跟 SQL 的差別在哪裡？
### SQL 關聯式資料庫：
1.資料類似表格形式。
2.有標準語法操作資料庫。
3.符合 ACID 四大特性：原子性、一致性、隔離性、持久性。詳見第四題。
4.舉例：欲修改一筆資料語法為：
UPDATE book SET price = 390 WHERE ISBN = '9999999999999';
5.現行較常使用的資料庫型式。
6.當資料需維持完整性、需符合 ACID 四大特性時使用。
7.資料高度架構化，容易進行複雜的搜尋。

### noSQL 非關聯式資料庫：
1.資料類似 JSON 形式。
2.沒有標準語言。
3.有 CAP 理論：一致性、可用性、分區容忍性，通常只能同時滿足其中2項，很難3項同時滿足。
4.舉例：欲修改一筆資料語法為：
db.book.update(
{ISBN: '9999999999999'},
{$set: {price: 390}}
)
5.當不講求資料同步、資料準確性不是很重要的時候可以使用。
6.沒有固定欄位，擴充容易。

參考資料：
https://www.kshuang.xyz/doku.php/database:sql_vs_nosql
https://www.ithome.com.tw/news/92506


## 資料庫的 ACID 是什麼？
### Atomicity原子性：確保有交易作為最小運作單位。transaction 中所有操作全部完成或全部不完成，中間有錯誤會回到一開始未操作狀態。

### Consistency一致性：異動過程確保整體資料庫的一致性。transaction 執行前後資料都要維持符合規則。

### Isolation隔離性：執行多筆交易時能隔離交易中的資料不受其他交易影響。不同transaction 不相互干擾，隔離性防止不同 transaction 修改到同一個值造成異常。分為不同級別：未提交讀、提交讀、可重複讀、序列化。作業使用的 MySQL 默認級別為可重複讀。
未提交讀：允許髒讀，即允許讀取其他事務修改了但未提交的數據。
提交讀：不允許髒讀，但不保證在一個事務內多次讀取的數據一致。
可重複讀：不允許髒讀，保證在一個事務內可重複讀取到一致的內容。
序列化：不允許髒讀，保證重複讀取一致，並且事務嚴格按順序執行。

### Durability持久性：交易過程不會變動原始資料的持久性。資料庫於transaction 執行成功後，就算系統故障也不會丟失修改資料。

參考資料：
維基百科
http:// https://kknews.cc/zh-tw/code/jkran36.html www.woolycsnote.tw/2017/07/54-transaction-acid.html

