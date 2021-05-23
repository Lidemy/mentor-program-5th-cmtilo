## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
#### <sup>和<sub>
<sup>上標用來標註上方的文字，比如 1st 的 st ，1<sup>st</sup>。
<sub>下標用來標註下方的文字，比如 CO2 的 2，CO<sup>2</sup>。
#### <fieldset>和<legend>
<fieldset>先將表單群組起來，<legend>放在<fieldset>後面作為標題。
#### <figure>和<figcaption>
<figure>用來包住圖片跟圖說，<figcaption>就是加入圖片說明的標籤。


## 請問什麼是盒模型（box model）
CSS box model 
有 margin、padding、border 三個可以控制元素內容的屬性。
由以下組成：
1.margin 外邊界：往外之間隔，決定跟其他元素的距離為多少。
2.border 邊框：邊邊的一條框線，區分外邊界跟內距。
3.padding 內距：往內的距離，決定了內容和邊框之間要留多少空間。
4.content 內容：真正的內容。
＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿
︳             margin             ︱
︳     ————————border———————      ︱
︳    ︳       padding       ︱   ︱
︳    ︳     －－－－－－－   ︱   ︱
︳    ︳     ︳          ︱  ︱   ︱
︳    ︳     ︳ content  ︱  ︱   ︱
︳    ︳     ︳          ︱  ︱   ︱
︳    ︳     －－－－－－－   ︱   ︱
︳    ︳                     ︱   ︱
︳      ————————————————————      ︱
＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
#### inline：
inline 是行內元素，會自動在同一行內進行排列，有的標籤原本就是行內元素特性，比如<a> 跟 <img> 標籤。
#### block：
block 是區塊元素，自己占據一整行，有的標籤原本就是區塊元素特性，比如<h1> 跟 <p> 標籤。
#### inline-block：
inline-block 是行內元素與區塊元素之子，同時具有二者的特性，可以將區塊在同一行進行排列，設定 display:inline-block 可以把原本區塊元素特性的標籤像 inline 那樣進行排列；如原本為行內元素，則會多了區塊元素的特性。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
#### static：
預設的定位方式，由上往下。
#### relative： 
相對定位，相對於預設位置進行排列，可以設定離預設位置偏移多少。
#### absolute：
絕對定位，經自我檢討指正「absolute 的定位點是往上找第一個 position 不是 static 的元素」，也就是離最近一個非 static 定位元素的偏移。
#### fixed：
固定定位，也是一種絕對定位，會定位在瀏覽器視窗上的固定位置。

