## 跟你朋友介紹 Git

###Git是用來作版本控制的

---
###語法：
`git init` 初始化,開始版本控制(多一個隱藏資料夾.git)
`rm-r .git` 刪掉版本控制
`git status` 查詢狀態
`git add <檔名>` 加入版本控制(還沒commit)
`git add.` 把所有檔案全加入版本控制
`git rm -- cached <檔名>` 移出版本控制
`git commit` 新建版本
`git commit -m "__"` 新建版本
`git log` 可以看全部版本的作者.修改時間.內容
`git log -- oneline` 簡短版
`git checkout 版本號` 切換到某版本
`git checkout master` 切換到最新版本(回到master這個branch的最新版,非整個專案最新版)
`.gitignore` 忽略的檔案,一般放使用者個人相關或作業系統檔(touch .gitignore → vim .gitignore → 輸入 <檔名>)
`git commit -am" __"` 加入版本控制+新建版本同時,但不會加入新增的檔,所以有新增檔案還是要用 git add
`git dff` 可以看改了哪些

---
###開始版本控制步驟：
1 git init 初始化,開始版本控制
2 git status 查詢狀態
3 .gitignore 忽略的檔案放進來,一般放使用者個人相關或作業系統檔,排除版本控制外,但.gitignore本身要加入版本控制
（.gitignore是一個檔案可以想像成類似備忘錄）
4 git add . 把所有檔案全加入版本控制,現在都是新檔案都還是untrack狀態,不能直接用-am
5 git commit -am "__" 建立第一個commit版本,加入版本控制+新建版本同時,但不會加入新增的檔,所以有新增檔案還是要用 git add <檔名> ,或者用git add . 加入所有檔案
6 git log 可以看全部版本的作者.修改時間.內容
專案建立後,新增檔案也要記得加入版本控制,再做一次步驟4跟步驟5
如果無新增檔案,但有修改現有檔案,直接做步驟5
commit前可以用git diff看有哪些修改

---
紀錄一下在這部分助教有提出一個問題：
如果在比較上層的資料夾有改動怎麼辦？
working directory: week21/hw1/src/
modified: week21/hw1/index.html

ANS 先`cd..`回到上一層資料夾之後可用`git add . ` 加入所有檔案的改動

---
###補充狀況劇：
．如果2個branch 改到同個檔案同一行衝突時(conflict)：手動解決
git branch - v 看有幾個branch名稱.版本號.目前在哪個分支
git branch <名稱> 新的分支
git branch - d <名稱> 刪分支
git checkout <名稱> 切換到某分支
git merge <名稱> 合併進來
例：
1 git merge newfeature 把newfeature合併到 master(所以現在在master)
2 git branch - d newfeature 因為合併過去了,所以就可以刪掉分支了

．我 commit 了但是想改 commit message：
git commit --amend

．我 commit 了可是我又不想 commit 了：
git reset HEAD^ --hard 極端,直接當作沒發生
git reset HEAD^ --soft 上一個commit不要了,但改過的東西還在,回到上一個狀態
git reset HEAD^ 預設就是--soft

．我還沒 commit，但我改的東西我不想要了：
git checkout -- file 回復到還沒commit的狀態
git checkout -- . 專案所有改過但還沒commit的東西全部回到前一個狀態

．我想改 branch 的名字
git branch -m 切換(checkout)到該branch後輸入即可改名

．想摘下遠端的 branch 給你
git checkout 分支名 遠端有此分支,本機沒有,但直接輸入就可以看到
(可用git branch -v確認)

