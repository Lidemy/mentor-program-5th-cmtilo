## Webpack 是做什麼用的？可以不用它嗎？
webpack 是在 node.js 上運行的模組打包工具。
主要目的是打包 javascript 檔案，由於 webpack 將各種資源（如圖片、文件等）都當作模組，所以透過 loader 跟 plugin 能達成轉譯或打包幾乎任何資源。
loader：有些資源 webpack 無法直接處理，所以須透過不同 loader 處理不同資源，如用css loader處理 css 檔案、style loader 處理 DOM 中的樣式表。
plugin：webpack 有很多第三方擴充插件，如使用 UglifyJsPlugin 可優化程式碼。
可以不用它嗎？可以！webpack 很便利地將原本我們需要自行處理的事情一併進行，自動化執行轉譯或優化程式碼的工作，雖然可以不使用 webpack，但就會比較很麻煩，比如想改寫 SCSS 為 CSS 要自己手動改寫，或者分別進行轉譯再引入。

參考資料：
https://www.gushiciku.cn/pl/groV/zh-tw
https://tw.alphacamp.co/blog/webpack-introduction
https://medium.com/i-am-mike/%E4%BB%80%E9%BA%BC%E6%98%AFwebpack-%E4%BD%A0%E9%9C%80%E8%A6%81webpack%E5%97%8E-2d8f9658241d
https://github.com/webpack-contrib/awesome-webpack#webpack-plugins
https://iter01.com/12398.html

## gulp 跟 webpack 有什麼不一樣？
gulp 為任務管理工具，配置不同任務 （task）一個一個依序執行，自動化流程完成編譯程式碼、壓縮圖檔或自訂的任務，在 node.js 上運行。
webpack 採模組化方式，由 entry 開始，透過 loader 跟 plugin 處理各種資源，詳述如上題。
gulp 跟 webpack 都有插件，也都可以處理編譯或壓縮的工作，他們不一樣之處在於：
gulp 可以進行任務定義和管理，主要為任務流（workflow）的概念，不包含模組化功能；webpack 則是以模組化為主，將所有資源都當作模組，並且 webpack 上插件更為豐富，擴充性強。
gulp 合併檔案需要安裝插件，webpack可以直接達成。

參考資料：
https://zhuanlan.zhihu.com/p/55869217
https://kknews.cc/zh-tw/code/3vm94o3.html
https://www.itread01.com/content/1543848426.html

## CSS Selector 權重的計算方式為何？
權重計算：
可以想成 5 個方塊 ☐-☐-☐-☐-☐，權重按順序由左至右為最高到最低。
☐1st ->!important 
☐2nd ->inline style，例如 <span style="font-size : 12px;" >
☐3rd ->ID，例如 #content
☐4th ->class/psuedo-class/attribute，例如 .comment 或 :hover 
☐5th ->element，例如 p、h1
計算方式：
例1：h1
 0-0-0-0-1
例2：#content h1
 0-0-1-0-1
例3：<span style="font-size : 12px;" >
 0-1-0-0-0
例4：* 
 0-0-0-0-0
例5：!important 
 1-0-0-0-0
權重計算數字較大的贏，成為最終呈現的樣式。
優先順序：
!important > inline style > ID > class/psuedo-class/attribute > element > *

參考資料：
https://ithelp.ithome.com.tw/articles/10196454 
https://www.oxxostudio.tw/articles/201405/css-specificity.html
