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
// 計算未完成及全部待辦
function recalculate() {
  const unfinishCount = $('input[type=checkbox]:not(:checked)').length
  const totalCount = $('input[type=checkbox]').length
  $('.count').text(`${unfinishCount}/${totalCount}`)
}

// 新增 todo
$('.white_input_todos').submit((e) => {
  e.preventDefault()
  const data = $('input[name=add_todo]').val()
  if (data.replace(/\s/g, '').length === 0) {
    alert('請填寫待辦事項')
    return
  }
  $('.show_todos').append(`
    <div class="todo">
      <input type="checkbox" class="checkbox form-check-input">
      <div class="things" contenteditable = "true">${escape(data)}</div>
      <button class="del btn-close"></button>
    </div>
  `)
  $('input[name=add_todo]').val('')
  recalculate()
})

// 編輯 todo
// 運用 contenteditable = "true" 屬性變為可編輯

// 刪除 todo
$('.show_todos').on('click', '.del', (e) => {
  $(e.target).parent().remove()
  recalculate()
})

// 標記完成/未完成
$('.show_todos').on('click', '.checkbox', (e) => {
  if ($('input[type=checkbox]:checked').length) {
    $(e.target).next().addClass('done')
  } else {
    $(e.target).next().removeClass('done')
  }
  recalculate()
})

// 清空 todo
$('.clear').click((e) => {
  $('input[type=checkbox]:checked').parent().remove()
  recalculate()
})

// 篩選 todo（全部、未完成、已完成）
$('.all').click((e) => {
  $('input[type=checkbox]').parent().show()
})
$('.finished').click((e) => {
  $('input[type=checkbox]:checked').parent().show()
  $('input[type=checkbox]:not(:checked)').parent().hide()
})
$('.unfinish').click((e) => {
  $('input[type=checkbox]:checked').parent().hide()
  $('input[type=checkbox]:not(:checked)').parent().show()
})
