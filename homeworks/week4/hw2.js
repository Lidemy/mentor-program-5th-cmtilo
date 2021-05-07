const request = require('request')

const APIUrl = 'https://lidemy-book-store.herokuapp.com/books'

const action = process.argv[2]
const parameter = process.argv[3]
const parameterTwo = process.argv[4]

switch (action) {
  case 'list':
    list()
    break
  case 'read':
    read(parameter)
    break
  case 'delete':
    del(parameter)
    break
  case 'create':
    create(parameter)
    break
  case 'update':
    update(parameter, parameterTwo)
    break
  default:
    console.log('wrong')
}

function list() {
  request.get(
    `${APIUrl}?_limit=20`,
    (error, response, body) => {
      const json = JSON.parse(body)
      for (let i = 0; i < json.length; i++) {
        console.log(`${json[i].id} ${json[i].name}`)
      }
      if (error) {
        console.log('error:', error)
      }
    }
  )
}

function read(id) {
  request.get(
    `${APIUrl}/${id}`,
    (error, response, body) => {
      const json = JSON.parse(body)
      console.log(`${json.id} ${json.name}`)
      if (error) {
        console.log('error:', error)
      }
    }
  )
}

function del(id) {
  request.delete(
    `${APIUrl}/${id}`,
    (error, response, body) => {
      console.log('successfully deleted')
      if (error) {
        console.log('error:', error)
      }
    }
  )
}

function create(name) {
  request.post(
    {
      url: APIUrl,
      form: {
        name: `${parameter}`
      }
    },
    (error, response, body) => {
      console.log(`${name} added successfully`)
      if (error) {
        console.error('error:', error)
      }
    }
  )
}

function update(id, name) {
  request.patch(
    {
      url: `${APIUrl}/${id}`,
      form: {
        name: `${parameterTwo}`
      }
    },
    (error, response, body) => {
      console.log(`${id} has been modified to ${name}`)
      if (error) {
        console.log('error:', error)
      }
    }
  )
}
