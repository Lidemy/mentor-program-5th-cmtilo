// 新增待辦事項
document.querySelector('.addbtn').addEventListener('click', (e) => {
  const values = document.querySelector('.item_typein').value
  if (!values) {
    return
  }
  const div = document.createElement('div')
  div.classList.add('item_todo')
  div.innerHTML = `
    <li class='item_things'><input class='things_check' type='checkbox'/>${escapeHtml(values)}</li>
    <div class='del_btn'>×</div>
  `
  document.querySelector('.todos').appendChild(div)
  document.querySelector('.item_typein').value = ''
})

document.querySelector('.todos').addEventListener('click', (e) => {
  const { target } = e
  // 刪除事項
  if (target.classList.contains('del_btn')) {
    target.parentNode.remove()
    return
  }

  // 刪除線--完成或未完成
  if (target.classList.contains('things_check')) {
    if (target.checked) {
      target.parentNode.classList.add('done')
    } else {
      target.parentNode.classList.remove('done')
    }
  }
})

function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;')
}
