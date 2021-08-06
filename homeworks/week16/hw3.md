01 var a = 1
02 function fn(){
03   console.log(a)
04   var a = 5
05   console.log(a)
06   a++
07   var a
08   fn2()
09   console.log(a)
10   function fn2(){
11     console.log(a)
12     a = 20
13     b = 100
14   }
15 }
16 fn()
17 console.log(a)
18 a = 10
19 console.log(a)
20 console.log(b)

---
1.模擬 JS 引擎進行初始化：
global EC
global VO {
  a: undefined,
  fn:  func
}

2.執行第 1 行 var a = 1
global EC
global VO {
  a: 1,
  fn:  func
}

3.執行第 16 行 fn()
fn EC
fn AO {
  a: undefined,
  fn2: func
}
global EC
global VO {
  a: 1,
  fn:  func
}

4.進入 fn()，執行第 3 行 console.log(a)，印出 undefined
說明：hoisting 意思是程式碼會將 function 中的變數宣告提升至 function 內最上方，且在 function 中看不到同名的全域變數
這邊就是 a 宣告被提升，但賦值不會跟著提升，所以 a 是宣告未賦值的狀態

5.執行第 4 行 var a = 5
fn EC
fn AO {
  a: 5,
  fn2: func
}
global EC
global VO {
  a: 1,
  fn:  func
}

6.執行第 5 行 console.log(a)，印出 5

7.執行第 6 行 a++
fn EC
fn AO {
  a: 6,
  fn2: func
}
global EC
global VO {
  a: 1,
  fn:  func
}

8.執行第 8 行 fn2()
fn2 EC
fn2 AO {
}
fn EC
fn AO {
  a: 6,
  fn2: func
}
global EC
global VO {
  a: 1,
  fn:  func
}

9.進入fn2()，執行第 11 行 console.log(a)，印出 6

10. 執行第 12 行 a = 20
fn2 EC
fn2 AO {
}
fn EC
fn AO {
  a: 20,
  fn2: func
}
global EC
global VO {
  a: 1,
  fn:  func
}

11. 執行第 13 行 b = 100
b 在 fn2() 裡面沒有宣告，往上找...在 fn() 裡面沒有宣告，往上找...在global 沒有宣告，自動將 b 宣告為全域變數
fn2 EC
fn2 AO {
}
fn EC
fn AO {
  a: 20,
  fn2: func
}
global EC
global VO {
  a: 1,
  fn:  func,
  b: 100
}

12.離開 fn2()
fn EC
fn AO {
  a: 20,
  fn2: func
}
global EC
global VO {
  a: 1,
  fn:  func,
  b: 100
}

13.執行第 9 行 console.log(a)，印出 20

14.離開 fn()
global EC
global VO {
  a: 1,
  fn:  func,
  b: 100
}

15. 執行第 17 行 console.log(a)，印出 1

16.執行第 18 行 a = 10
global EC
global VO {
  a: 10,
  fn:  func,
  b: 100
}

17.執行第 19 行 console.log(a)，印出 10

18.執行第 20 行 console.log(b)，印出 100

19.執行完畢結束


console：
undefined
5
6
20
1
10
100
