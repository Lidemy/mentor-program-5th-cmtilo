for(var i=0; i<5; i++) {
  console.log('i: ' + i)
  setTimeout(() => {
    console.log(i)
  }, i * 1000)
}

1.進入 for 迴圈，第一圈 i=0，符合 i<5
console.log('i: ' + i) 進入 stack，執行印出 i: 0 後脫離 stack
setTimeout 進入 stack，執行 setTimeout 後脫離 stack，其中的 callback function () => {console.log(i)} 被放到 webapis 進行計時，計時 0 毫秒之後移到 task queue 等待
i++
2.第二圈 i=1，符合 i<5
console.log('i: ' + i) 進入 stack，執行印出 i: 1 後脫離 stack
setTimeout 進入 stack，執行 setTimeout 後脫離 stack，其中的 cb () => {console.log(i)} 被放到 webapis 進行計時，計時 1*1000 毫秒之後移到 task queue 等待
i++
3.第三圈 i=2，符合 i<5
console.log('i: ' + i) 進入 stack，執行印出 i: 2 後脫離 stack
setTimeout 進入 stack，執行 setTimeout 後脫離 stack，其中的 () => {console.log(i)} 被放到 webapis 進行計時，計時 2*1000 毫秒之後移到 task queue 等待
i++
4.第四圈 i=3，符合 i<5
console.log('i: ' + i) 進入 stack，執行印出 i: 3 後脫離 stack
setTimeout 進入 stack，執行 setTimeout 後脫離 stack，其中的 () => {console.log(i)} 被放到 webapis 進行計時，計時 3*1000 毫秒之後移到 task queue 等待
i++
5.第五圈 i=4，符合 i<5
console.log('i: ' + i) 進入 stack，執行印出 i: 4 後脫離 stack
setTimeout 進入 stack，執行 setTimeout 後脫離 stack，其中的 () => {console.log(i)} 被放到 webapis 進行計時，計時 4*1000 毫秒之後移到 task queue 等待
i++
6. i=5，不符合 i<5，跳出迴圈
7.此時程式碼執行到最後一行，stack清空，先前於 task queue 等待的 cb 移入 stack依序執行：
() => {console.log(i)} 印出 5後脫離 stack、
() => {console.log(i)} 印出 5後脫離 stack、
() => {console.log(i)} 印出 5後脫離 stack、
() => {console.log(i)} 印出 5後脫離 stack、
() => {console.log(i)} 印出 5後脫離 stack
8.全部程式碼執行完畢，結束

console：
i: 0
i: 1
i: 2
i: 3
i: 4
5
5
5
5
5
