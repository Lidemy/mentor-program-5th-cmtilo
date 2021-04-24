``` js
function isValid(arr) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] <= 0) return 'invalid'
  }
  for(var i=2; i<arr.length; i++) {
    if (arr[i] !== arr[i-1] + arr[i-2]) return 'invalid'
  }
  return 'valid'
}

isValid([3, 5, 8, 13, 22, 35])
```

## 執行流程
1. 將[3, 5, 8, 13, 22, 35]帶入執行 isValid，如果不符合二個for迴圈的條件，即為valid
2. 進入第一個 for 迴圈，從 i 為 0 開始執行直到 i 小於陣列長度，檢查如果 arr[i] 小於等於 0 即回傳 invalid
3. 第一圈先設定變數 i 為 0，arr[0] 為 3，檢查是否符合<= 0，不符合，執行 i++ 並進入下一圈
4. 第二圈變數 i 為 1，檢查 i 是否 <arr.length，是，arr[1] 為 5，檢查是否符合<= 0 ，不符合，執行 i++ 並進入下一圈
5. 第三圈變數 i 為 2，檢查 i 是否 <arr.length，是，arr[2] 為 8 ，檢查是否符合<= 0 ，不符合，執行 i++ 並進入下一圈
6. 第四圈變數 i 為 3，檢查 i 是否 <arr.length，是，arr[3] 為 13，檢查是否符合<= 0 ，不符合，執行 i++ 並進入下一圈
7. 第五圈變數 i 為 4，檢查 i 是否 <arr.length，是，arr[4] 為 22 ，檢查是否符合<= 0 ，不符合，執行 i++ 並進入下一圈
8. 第六圈變數 i 為 5，檢查 i 是否 <arr.length，是，arr[5] 為 35，檢查是否符合<= 0 ，不符合，執行 i++ 並進入下一圈
9.  此時變數 i 為 6，檢查 i 是否 <arr.length，否
10.  結束第一個 for 迴圈
11. 進入第二個 for 迴圈，從 i 為 2 開始執行直到 i 小於陣列長度，檢查如果 arr[i] 不等於 arr[i-1] + arr[i-2] 即回傳 invalid
12. 第一圈先設定變數 i 為 2，arr[2] 為 8，檢查是否符合"不等於" arr[1] + arr[0]，即 5 + 3 ，不符合，執行 i++ 並進入下一圈
13. 第二圈變數 i 為 3，arr[3] 為 13，檢查是否符合"不等於" arr[2] + arr[1]，即 8 + 5 ，不符合，執行 i++ 並進入下一圈
14. 第三圈變數 i 為 4，arr[4] 為 22，檢查是否符合"不等於" arr[3] + arr[2]，即 13 + 8 ，符合，回傳 invalid
15. 結束第二個 for 迴圈
16. 執行完畢

