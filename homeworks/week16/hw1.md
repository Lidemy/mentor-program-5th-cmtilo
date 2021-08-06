1 console.log(1)
2 setTimeout(() => {
3   console.log(2)
4 }, 0)
5 console.log(3)
6 setTimeout(() => {
7   console.log(4)
8 }, 0)
9 console.log(5)

1.執行 javascript 的時候，首先進入 stack 的是全域環境 main
2.開始執行第 1 行，console.log(1) 進入 stack，執行印出 1 之後脫離 stack
3.執行第 2 行，setTimeout(() => {console.log(2)}, 0) 進入 stack，但 callback function 不會立刻執行，() => {console.log(2)} 會進行計時，等時間到之後移到 task queue，等 stack 清空後才移入 stack（等待中）
4.執行第 5 行，console.log(3) 進入 stack，執行印出 3 之後脫離 stack
5.執行第 6 行，setTimeout(() => {console.log(4)}, 0) 進入stack，setTimeout 是瀏覽器提供的，執行 setTimeout 之後，setTimeout 便脫離 stack，其中的 callback function 進行計時，等時間到之後移到 task queue 等待（等待中）
6.執行第 9 行，console.log(5) 進入 stack，執行印出 5 之後脫離 stack
7.程式碼執行完最後一行，stack 清空，先前於 task queue 等待的  callback function 移到 stack，依序執行完畢後脫離 stack，() => {console.log(2)} 執行印出 2 之後脫離 stack、() => {console.log(4)} 執行印出 4 之後脫離 stack
8.全部程式碼執行完畢，結束

console：
1
3
5
2
4
