## 交作業流程

`git clone` +自己的網址


可用 `git diff` 看有哪裡不同


開一個分支 `git branch week1`
切換分支 `git checkout week1`


或者同時開新分支也同時切過去 `git checkout -b`


如有新的檔案一定要 `git add <檔名>` 才會加進去！!
或用`git add .` 可把所有檔案加入

接著提交 `git commit -am 'hw1' `
再推到遠端 `git push origin week1`


回到網頁PR，從week1 合併進去 master

再回到本機把分支刪掉
`git checkout master`
`git pull origin master`
`git branch -d week1`



從week1 合併進去 master
