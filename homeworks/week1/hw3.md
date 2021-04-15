## 教你朋友 CLI

command line 是直接跟電腦溝通的語法

---
「欸！能不能教我 command line 到底是什麼，然後怎麼用啊？我想用 command line 建立一個叫做 wifi 的資料夾，並且在裡面建立一個叫 afu.js 的檔案。就交給你了，教學寫好記得傳給我，ㄅㄅ」
教學：mkdir wifi → touch afu.js

---
以下是我查到對應windows的,有些無法查到對應：
* `pwd`↔`chdir`
* `ls`	↔`dir`
* `cd`	↔`cd`
* `cd..` (回到上一層)
* `man`↔`help`
* `Q`離開↔
* `touch`↔
* `rm`	↔`del` (刪檔案)
  `{＿} rm-r`↔`deltree` (資料夾底下的東西都刪除)
  `rmdir`↔`rd` (刪資料夾)
* `mkdir`↔`md` (新建資料夾)
  `mv`	↔`mv` (移動檔案__ __)
  `mv`	↔`ren` (改名)
* `cp`	↔`copy`(複製檔案)
  `cp-r {__}` (複製資料夾)
* `cat`↔`type` (看檔案內容)
* `vim`↔`edit`
* `grep`↔`find` (抓取關鍵字)
* `wget` (下載檔案(圖片.網頁原始碼),非內建指令)
* `curl`  (送出request,用來測試API,用get方法把response秀出來(
  `curl-I`  (秀出資訊)
* `ls-al>{__}`	
* `echo`↔`echo`
* `"123">123.txt` 會把原本內容覆蓋為123	
* `"456">>123.txt` 會把內容新增在後面	
* `pipe |`↔`|`組合

---
vim不直覺大家不知道怎麼出去
i INSERT模式,可輸入文字
esc 普通模式,可刪除可複製
:Q 離開出來的方式
:WQ 寫完後存檔離開

