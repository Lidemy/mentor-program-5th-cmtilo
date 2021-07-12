const inputs = document.querySelectorAll('.require')
const checkBox = document.querySelector('.checkbox')

document.querySelector('form').addEventListener('submit', (e) => {
  e.preventDefault()
  let final = ''
  const signUpInfo = {}
  // 檢查必填欄位
  for (const input of inputs) {
    const inputValue = input.value.replace(/\s/g, '') // 替換掉空字串
    if (inputValue.length === 0) {
      final += 'err1'
      showAlert(input, '尚未填寫')
    } else {
      hideAlert(input)
      final += checkEmail(input)
      final += checkPhone(input)
      signUpInfo[input.name] = input.value
    }
  }
  // 檢查必填單選
  const checked = document.querySelector('input[name=type]:checked')
  if (!checked) {
    final += 'err4'
    showAlert(checkBox, '尚未填寫')
  } else {
    hideAlert(checkBox)
    signUpInfo[checked.name] = checked.value
  }
  // 顯示填寫結果
  console.log(final)
  if (final === '') {
    showSignUpInfo(signUpInfo)
  } else {
    alert('您尚有欄位未正確填寫')
  }
})

function checkEmail(input) {
  if (input.name === 'email') {
    if (input.value.indexOf('@') <= 0) {
      showAlert(input, '格式錯誤')
      return 'err2'
    }
    return ''
  }
  return ''
}

function checkPhone(input) {
  const regex = /[0-9]/
  if (input.name === 'phone') {
    if (!regex.test(input.value)) {
      showAlert(input, '格式錯誤')
      return 'err3'
    }
    return ''
  }
  return ''
}

function showAlert(input, text) {
  input.nextElementSibling.classList.remove('hide')
  input.nextElementSibling.innerText = text
}

function hideAlert(input) {
  input.nextElementSibling.classList.add('hide')
}

function showSignUpInfo(signUpInfo) {
  alert(`您已報名完成，報名資訊如下：
    ${signUpInfo.nickname}
    ${signUpInfo.email}
    ${signUpInfo.phone}
    ${signUpInfo.type}
    ${signUpInfo.information}
  `)
}
