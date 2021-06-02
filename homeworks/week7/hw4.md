## 什麼是 DOM？
物件文件模型 Document Object Model
Javascript 跟 HTML 透過 DOM 進行互動，DOM 是在瀏覽器載入頁面時建立的，瀏覽器解析 HTML 時會建立一組物件代表 HTML 標籤。
頂端為一個 document 節點，接著是html，接著是head、body，以此類推將每個 HTML 標籤元素作為一個節點。
Javascript 透過 DOM 跟頁面溝通，比如利用getElementById等找出需要的元素進行操作，可以變更內容、增減class或是改變style等。


## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
事件傳遞機制是瀏覽器在物件上觸發事件處理的過程。
可分為三階段，捕獲 → 目標 → 冒泡：
第一階段捕獲階段，發生在事件處理之前，延著 DOM tree 往下傳遞。
第二階段，到達目標本身，並觸發目標事件。
第三階段冒泡階段，事件像氣泡一樣往上浮，在 DOM tree 一路往上回傳呼叫處理事件程式。


## 什麼是 event delegation，為什麼我們需要它？
事件代理機制：如果有很多類似的事件監聽跟處理程序，不要用在每一個元素上加上 addEventListener，而是只用一個 addEventListener 去監聽並處理所有一樣的動作。
需要它的原因有以下：程式碼更簡潔、更有效率、可以處理動態新增情形。


## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
### event.preventDefault() 
取消預設動作，在捕獲鍊上任何一個加上preventDefault都會阻止超連結或表單送出等，比如<a>標籤預設動作為連到超連結指定頁面，preventDefault可以阻止該動作。
阻止整個網頁所有預設動作：
```
window.addEvenListener('click', function(event) {
  event.preventDefault() 
})
```
### event.stopPropagation()
阻止事件繼續傳遞，任何過程都可以呼叫stopPropagation，在捕獲冒泡的任一階段如果加上e.stopPropagation會阻止往下傳遞，加在最前面則不管按頁面上任何地方都不會往下傳遞。
阻止按鈕進行提交：
```
document.querySelector('.button input').addEvenListener('submit', function(event) {
  event.stopPropagation()
})
```
