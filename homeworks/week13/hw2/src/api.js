import $ from 'jquery'

// 串api_comments.php
export function ajaxApi(apiUrl, siteKey, commentDOM, cb) {
  $.ajax({
    url: `${apiUrl}/api_comments.php?site_key=${siteKey}`
  })
    .done((data) => {
      if (!data.ok) {
        alert(data.message) // 連上API的報錯
        return
      }
      cb(commentDOM, siteKey, data)
    })
    .fail((XMLHttpRequest, textStatus, errorThrown) => {
      alert(XMLHttpRequest, textStatus, errorThrown) // 連不上API的報錯，如url出錯會從這報錯
    })
}

// 串api_add_comments.php
export function addCommentApi(apiUrl, newData, cb) {
  $.ajax({
    method: 'POST',
    url: `${apiUrl}/api_add_comments.php`,
    data: newData
  })
    .done((data) => {
      if (!data.ok) {
        alert(data.message) // 連上API的報錯
        return
      }
      cb()
    })
    .fail((XMLHttpRequest, textStatus, errorThrown) => {
      alert(XMLHttpRequest, textStatus, errorThrown) // 連不上API的報錯，如url出錯會從這報錯
    })
}
