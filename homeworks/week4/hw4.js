const request = require('request')

const APIUrl = 'https://api.twitch.tv/kraken/games/top'
const option = {
  url: APIUrl,
  headers: {
    Accept: 'application/vnd.twitchtv.v5+json',
    'Client-ID': '87si9433vrph4c706fiebiiechurrl'
  }
}

function callback(error, response, body) {
  if (error) {
    return console.error(error)
  }
  const json = JSON.parse(body)
  for (let i = 0; i < 10; i++) {
    console.log(`${json.top[i].viewers} ${json.top[i].game.name}`)
  }
}

request(option, callback)
