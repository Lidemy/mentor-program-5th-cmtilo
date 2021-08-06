const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
  
const obj2 = obj.inner
const hello = obj.inner.hello
obj.inner.hello()
obj2.hello()
hello()

---
轉為 .call 型式，ooo.xxx.call(this) 在 xxx.call 前面的東西便是 this 的值。 
hello本身是一個函式 function() {console.log(this.value)}，用 call 的方式調用：
obj.inner.hello.call(obj.inner)
obj2.hello.call(obj2)
hello.call(undefined)

第一個 this 為 obj.inner，即為 inner 這個物件：
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
所以 this.value 就會印出 2。

第二個 this 為 obj2，即為 inner 這個物件：
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
所以 this.value 就會印出 2。

第三個 this 為 undefined：
因為 hello.call() 前面沒有東西，所以 this 會是 undefined，
所以 this.value 就會印出 undefined。

console：
2
2
undefined
