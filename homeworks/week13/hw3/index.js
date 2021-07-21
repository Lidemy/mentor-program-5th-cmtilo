const API_URL = 'https://api.twitch.tv/kraken/'
const CLIENT_ID = '87si9433vrph4c706fiebiiechurrl'
const TEMPLATE = `<div class='game'>
                    <a href="$url">
                      <div class='game_img'><img src="$preview" /></div>
                      <div class='game_bottom'>
                        <div class='game_bottom_left'>
                          <img src='$logo'/>
                        </div>
                        <div class='game_bottom_right'>
                          <div class='game_channel'>$channel</div>
                          <div class='game_name'>$who</div>
                        </div>
                      </div>
                    </a>
                  </div>`

// navbar動態生成TOP5
fetch(`${API_URL}games/top?limit=5`, {
  method: 'GET',
  body: JSON.stringify(),
  headers: new Headers({
    'Content-Type': 'application/json',
    'Client-ID': CLIENT_ID,
    Accept: 'application/vnd.twitchtv.v5+json'
  })
})
  .then((res) => {
    const data = res.json()
    return data
  }).then((json) => {
    const games = json.top
    for (const game of games) {
      const element = document.createElement('li')
      element.innerText = game.game.name
      document.querySelector('.navbar_list').appendChild(element)
    }
    // 第一個遊戲名稱
    document.querySelector('.fortnite_title').innerText = games[0].game.name
    liveStreams(games[0].game.name)
  }).catch((err) => {
    alert(err)
  })

// 監聽click哪個遊戲
document.querySelector('.navbar_list').addEventListener('click', (e) => {
  if (e.target.tagName.toLowerCase() === 'li') {
    const gameName = e.target.innerText
    document.querySelector('.fortnite_title').innerText = gameName
    document.querySelector('.fortnite_games').innerHTML = ''
    liveStreams(gameName)
  }
})

// 動態生成顯示20直播的function
function liveStreams(gameName) {
  fetch(`${API_URL}streams/?game=${encodeURIComponent(gameName)}&limit=20`, {
    method: 'GET',
    body: JSON.stringify(),
    headers: new Headers({
      'Content-Type': 'application/json',
      'Client-ID': CLIENT_ID,
      Accept: 'application/vnd.twitchtv.v5+json'
    })
  })
    .then((res) => {
      const data = res.json()
      return data
    }).then((json) => {
      const { streams } = json
      for (const stream of streams) {
        appendGame(stream)
      }
    }).catch((err) => {
      alert(err)
    })
}

// 畫面變更為不同遊戲
function appendGame(s) {
  const element = document.createElement('div')
  document.querySelector('.fortnite_games').appendChild(element)
  element.outerHTML = TEMPLATE
    .replace('$preview', s.preview.medium)
    .replace('$logo', s.channel.logo)
    .replace('$channel', s.channel.status)
    .replace('$who', s.channel.name)
    .replace('$url', s.channel.url)
}
