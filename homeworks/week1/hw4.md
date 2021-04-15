## 跟你朋友介紹 Git

Git是用來作版本控制的

---
語法：
`git init` 初始化,開始版本控制(多一個隱藏資料夾.git)
`rm-r .git` 刪掉版本控制
`git status` 查詢狀態
`git add {檔名}` 加入版本控制(還沒commit)
`git add.` 把所有檔案全加入版本控制
`git rm -- cached {檔名}` 移出版本控制
`git commit` 新建版本
`git commit -m {__}` 新建版本
`git log` 可以看全部版本的作者.修改時間.內容
`git log -- oneline` 簡短版
`git checkout {版本號}` 切換到某版本
`git checkout master` 切換到最新版本(回到master這個branch的最新版,非整個專案最新版)
`.gitignore` 忽略的檔案,一般放使用者個人相關或作業系統檔(touch .gitignore → vim .gitignore → 輸入 <檔名>)
`git commit -am {__}` 加入版本控制+新建版本同時,但不會加入新增的檔,所以有新增檔案還是要用 git add
`git dff` 可以看改了哪些

---
步驟：
1 git init
2 git status
3 .gitignore
4 git add.
5 git commit - am {__}
6 git log
專案建立後,新增檔案也要記得加入→4→5
