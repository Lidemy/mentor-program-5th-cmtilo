import $ from 'jquery'
import { ajaxApi, addCommentApi } from './api'
import { appendCommentToDOM, doSomethingInComments } from './untils'
import getTemplate from './template'

// 初始
export default function init(options) {
  // const siteKey = options.siteKey
  // const apiUrl = options.apiUrl
  const { siteKey } = options
  const { apiUrl } = options
  const containerElement = $(options.containerSelector)
  const formClassName = `${siteKey}-add-comment-form`
  const template = getTemplate(siteKey)
  containerElement.append(template)
  const formSelector = `.${formClassName}`
  const commentDOM = $(`.${siteKey}-comments`)

  ajaxApi(apiUrl, siteKey, commentDOM, doSomethingInComments) // 串api_comments.php

  $(formSelector).submit((e) => {
    e.preventDefault()
    const nicknameDOM = $(`${formSelector} input[name=nickname]`)
    const contentDOM = $(`${formSelector} textarea[name=content]`)
    const newData = {
      site_key: `${siteKey}`,
      nickname: nicknameDOM.val(),
      content: contentDOM.val()
    }
    addCommentApi(apiUrl, newData, () => {
      appendCommentToDOM(commentDOM, newData, false)
      nicknameDOM.val('')
      contentDOM.val('')
    }) // 串api_add_comments.php
  })
}
