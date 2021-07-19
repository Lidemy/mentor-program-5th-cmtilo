/* eslint-env jquery */
// 跳脫字元
function escape(str) {
  return str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#x27;')
    .replace(/\//g, '&#x2F;')
}

// append 或 prepend 既有評論
function appendCommentToDOM(container, comment, boolean) {
  const html = `
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">${escape(comment.nickname)} 說到：</h5>
          <pre class="card-text" style="white-space: pre-wrap">${escape(comment.content)}</pre> 
        </div>
      </div>
    </div>
  `
  boolean ? container.append(html) : container.prepend(html)
}

// 加入或移除 loading 按鈕
function loadMoreToOrNotToDOM(container, boolean) {
  const loadMoreHtml = `
    <div class="spinner-grow text-warning loading" role="status">
      <span class="visually-hidden">載入更多</span>
    </div>
  `
  boolean ? container.append(loadMoreHtml) : container.empty()
}

$(document).ready(() => {
  const beginDataNum = 6
  let perDataNum = 6
  const siteKey = null

  // 串api_comments.php
  $.ajax({
    method: 'GET',
    url: 'api_comments.php?site_key=cmtilo'
  })
    .done((data) => {
      if (!data.ok) {
        alert(data.message) // 連上API的報錯
        return
      }
      const comments = data.discussions
      const totalData = comments.length
      if (totalData <= beginDataNum) {
        for (const comment of comments) {
          appendCommentToDOM($('.comments'), comment, true)
        }
      } else if (totalData > beginDataNum) {
        loadMoreToOrNotToDOM($('.load-more'), true) // 在load-more 加入 loading 按鈕
        for (let i = totalData - 1; i >= totalData - beginDataNum; i--) {
          appendCommentToDOM($('.comments'), comments[i], true)
        }
        // 監聽 loading 滑鼠事件
        $('.loading').mouseenter((e) => {
          for (let i = totalData - 1 - perDataNum; i >= totalData - beginDataNum - perDataNum; i--) {
            appendCommentToDOM($('.comments'), comments[i], true)
            if (i <= 0) {
              loadMoreToOrNotToDOM($(`.${siteKey}-load-more`), siteKey, false) // 移除 loading
            }
          }
          perDataNum += 6
          if (perDataNum >= totalData - beginDataNum) {
            loadMoreToOrNotToDOM($('.load-more'), false) // 在load-more 移除 loading 按鈕
          }
        })
      }
    })
    .fail((XMLHttpRequest, textStatus, errorThrown) => {
      alert(XMLHttpRequest, textStatus, errorThrown) // 連不上API的報錯，如url出錯會從這報錯
    })

  // 串api_add_comments.php
  $('.add-comment-form').submit((e) => {
    e.preventDefault()
    const newData = {
      site_key: 'cmtilo',
      nickname: $('input[name=nickname]').val(),
      content: $('textarea[name=content]').val()
    }
    $.ajax({
      method: 'POST',
      url: 'api_add_comments.php',
      data: newData
    })
      .done((data) => {
        if (!data.ok) {
          alert(data.message) // 連上API的報錯
          return
        }
        appendCommentToDOM($('.comments'), newData, false)
        $('input[name=nickname]').val('') // 清空輸入
        $('textarea[name=content]').val('')
      })
      .fail((XMLHttpRequest, textStatus, errorThrown) => {
        alert(XMLHttpRequest, textStatus, errorThrown) // 連不上API的報錯，如url出錯會從這報錯
      })
  })
})
