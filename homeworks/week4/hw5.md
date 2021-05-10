## 請以自己的話解釋 API 是什麼

API就是我開個菜單給你，告訴你我這裡有什麼可以提供給你點的，雖然我的廚房（DB）裡面有很多種青菜，但我菜單上只賣小白菜跟高麗菜，你就只能買小白菜跟高麗菜。簡言之：API有給你的東西你才能要，API沒給你的~你要不到！
如果兩個系統需要互相交換資料，就需要分別寫API，一個系統開出需求欄位，另一個系統匯出資料格式給對方。


---
## 請找出三個課程沒教的 HTTP status code 並簡單介紹

203 Non-Authoritative Information：非授權資訊。請求成功，但回應內容與200的回應內容不完全相同。

414 Request URI Too Long：提交內容太多，請求的URI（統一資源標誌符）太長了。

504 Gateway Timeout：連線逾時，未能即時收到所發請求的回應。


---
## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

API 名稱：Cmtilo Find Restaurant For You
API 網址：https://cmtilo-find-restaurant-for-you.com.tw/{path}

操作功能說明：
| 功能           | Method | path                  | 參數       | 範例      |
|---------------|------|-----------------|--------------|-------------|
| 回傳所有資料 | GET  | / restaurants    | _limit:限制回傳數量| / restaurants?_limit=5 |
| 回傳單一資料 | GET   | / restaurant/:id | 無         | / restaurant/10 |
| 新增餐廳     | POST    | / restaurant        | name: 名稱 | 無  |
| 刪除餐廳     | DELETE | / restaurant /:id | 無                 | 無  |
| 更改餐廳     | PATCH  | / restaurant /:id | name: 名稱 | 無 |

欄位及型態說明：
| 項次 | 參數名 | 型態 | 說明      |
|-------|---------|--------|------------|
| 1    | limit    | int   | 回傳數量  |
| 2    | id      | string | 編號      |
| 3    | name   | string | 餐廳名稱  |
| 4    | type    | string | 餐點類型  |
| 5    | price    | string | 價位等級  |
| 6    | stars    | string | 評價星等  |

回傳格式：JSON
回傳範例：
[{
  “id”: “1”,
  “name”: ”GoodGoodFood”,
  “type”: “西式餐廳”,
  “price”: “$$$”,
  “stars”: “★★★★” 
},
{
  “id”: “2”,
  “name”: ”BadBadFood”,
  “type”: “西式餐廳”,
  “price”: “$$$$”,
  “stars”: “★” 
}]

狀態碼：
200 成功
404 找不到
500 發生錯誤

