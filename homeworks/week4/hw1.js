const request = require('request')

request.get('https://lidemy-book-store.herokuapp.com/books?_limit=10',
  (error, response, body) => {
    const json = JSON.parse(body) // 將body轉JSON格式物件資料
    try {
      for (let i = 0; i < json.length; i++) {
        console.log(`${json[i].id} ${json[i].name}`)
      } // 取出每本序號及書名
    } catch (error) {
      console.log('error:', error) // 如錯誤則印出錯誤訊息
    }
  }
)
