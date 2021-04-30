function solve(lines) {
  const temp = lines[0].split(' ')
  const n = Number(temp[0])
  const m = Number(temp[1])

  function digits(n) {
    let result = 0
    while (n !== 0) {
      n = Math.floor(n / 10)
      result++
    }
    return result
  }

  function narcissistic(a) {
    let b = a
    const dig = digits(b)
    let sum = 0
    while (b !== 0) {
      const num = b % 10
      sum += num ** dig
      b = Math.floor(b / 10)
    }
    return (sum === a)
  }

  for (let i = n; i <= m; i++) {
    if (narcissistic(i)) {
      console.log(i)
    }
  }
}

solve(['5 200'])
