import $ from 'jquery'
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
export function appendCommentToDOM(container, comment, boolean) {
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
export function loadMoreToOrNotToDOM(container, siteKey, boolean) {
  const loadMoreHtml = `
    <div class="spinner-grow text-warning ${siteKey}-loading" role="status">
      <span class="visually-hidden">載入更多</span>
    </div>
  `
  boolean ? container.append(loadMoreHtml) : container.empty()
}

// 在評論區做的事情
export function doSomethingInComments(commentDOM, siteKey, datas) {
  const beginDataNum = 6
  let perDataNum = 6
  const comments = datas.discussions
  const totalData = comments.length
  const showDataNum = totalData - beginDataNum
  console.log(siteKey, datas)
  console.log(perDataNum, showDataNum)

  if (showDataNum <= 0) {
    for (const comment of comments) {
      appendCommentToDOM(commentDOM, comment, true)
    }
  } else if (showDataNum > 0) {
    for (let i = totalData - 1; i >= showDataNum; i--) {
      appendCommentToDOM(commentDOM, comments[i], true)
    }
    // 監聽 loading 滑鼠事件
    loadMoreToOrNotToDOM($(`.${siteKey}-load-more`), siteKey, true) // 加入 loading
    $(`.${siteKey}-loading`).mouseenter((e) => {
      for (let i = totalData - 1 - perDataNum; i >= showDataNum - perDataNum; i--) {
        appendCommentToDOM(commentDOM, comments[i], true)
        if (i <= 0) {
          loadMoreToOrNotToDOM($(`.${siteKey}-load-more`), siteKey, false) // 移除 loading
        }
      }
      perDataNum += 6
      if (perDataNum >= showDataNum) {
        loadMoreToOrNotToDOM($(`.${siteKey}-load-more`), siteKey, false) // 移除 loading
      }
    })
  }
}
