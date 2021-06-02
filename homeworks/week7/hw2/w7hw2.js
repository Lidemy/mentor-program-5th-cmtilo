const faq = document.querySelector('#faq')

faq.addEventListener('click', (e) => {
  const element = e.target.closest('.q_and_a')
  if (element) {
    console.log(element.childNodes)
    element.querySelector('.answer').classList.toggle('answer_hide')
  }
})
