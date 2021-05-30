const form = document.querySelector('form')
const elements = document.querySelectorAll('.require')

// 監聽
form.addEventListener('submit', (e) => {
  e.preventDefault()
  // 先預設為沒有錯誤
  let hasError = false
  let isValid = true
  const values = {}
  let element

  // 尋找所有必填
  for (element of elements) {
    const inputs = element.querySelector('input[type=text]')
    const radios = element.querySelectorAll('input[type=radio]')
    if (inputs) {
      values[inputs.name] = inputs.value
      if (!inputs.value) {
        isValid = false
      }
    } else if (radios.length) {
      isValid = [...radios].some((radio) => radio.checked)
      if (isValid) {
        const result = element.querySelector('input[type=radio]:checked')
        values[result.name] = result.value
      }
    } else {
      continue
    }
    // 針對必填未填的欄位提醒
    if (!isValid) {
      element.classList.add('item_require_alert')
      hasError = true
    } else if (isValid) {
      element.classList.remove('item_require_alert')
    }
  }

  if (!hasError) {
    JSON.stringify(values)
    alert(`
      ${values.nickname} 您已完成報名      
      ${values.email}
      ${values.phone}
      ${values.type}
      ${values.information}
      ${values.suggest}
    `)
  } else {
    alert('尚有欄位未填寫')
  }
})
