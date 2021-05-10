const request = require('request')

const process = require('process')

const APIUrl = 'https://restcountries.eu/rest/v2/name/'
const input = process.argv[2]

request(
  `${APIUrl}${input}`,
  (error, response, body) => {
    const json = JSON.parse(body)
    if (error) {
      console.log(error)
    } else if (json.status === 404) {
      console.log('找不到國家資訊')
    } else {
      console.log(`國家：${json[0].name}`)
      console.log(`首都：${json[0].capital}`)
      console.log(`貨幣：${json[0].currencies[0].code}`)
      console.log(`國碼：${json[0].callingCodes[0]}`)
    }
  }
)
