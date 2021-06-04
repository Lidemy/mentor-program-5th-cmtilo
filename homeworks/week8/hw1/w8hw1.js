// 宣告API網址及錯誤訊息內容
const APIUrl = 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery'
const errorMessage = '系統不穩定，請再試一次'

// 監聽按下抽獎按鈕
document.querySelector('.btn_lottery').addEventListener('click', (e) => {
  const request = new XMLHttpRequest()
  request.open('GET', APIUrl, true)
  request.onload = function() { // 頁面載入後執行
    if (this.status >= 200 && this.status < 400) { // Success!
      let json
      try {
        json = JSON.parse(this.response) // 轉JSON格式物件資料
      } catch (error) {
        alert(errorMessage) // 如轉資料錯誤則跳錯誤訊息
        return
      }
      if (!json.prize) {
        alert(errorMessage) // 如果沒有獎項資料跳錯誤
        return
      }
      prizeResult(json) // 執行改變畫面function
    } else {
      alert(errorMessage) // 其他?錯誤
    }
  }
  request.onerror = function() { // request的錯誤
    alert(errorMessage)
  }
  request.send()
})

// 改變畫面
function prizeResult(data) {
  const PRIZE = {
    FIRST: {
      bg: 'url(flight.jpg) center/cover no-repeat',
      des: '恭喜你中頭獎了！日本東京來回雙人遊！'
    },
    SECOND: {
      bg: 'url(TV.jpg) center/cover no-repeat',
      des: '二獎！90 吋電視一台！'
    },
    THIRD: {
      bg: 'url(youtuber.jpg) center/cover no-repeat',
      des: '恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！'
    },
    NONE: {
      bg: 'black',
      des: '銘謝惠顧'
    }
  }
  const { bg, des } = PRIZE[data.prize]

  document.querySelector('#lottery').style.background = bg
  document.querySelector('.prize_des').innerText = des
  document.querySelector('.lottery_info').style.display = 'none'
  document.querySelector('.prize').classList.remove('hide')
}
