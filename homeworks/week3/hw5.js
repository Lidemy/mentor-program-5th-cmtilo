function solve(lines) {
  const m = Number(lines[0])
  for (let i = 1; i <= m; i++) {
    const temp = lines[i].split(' ')
    const a = BigInt(temp[0])
    const b = BigInt(temp[1])
    const k = Number(temp[2])
    pk(a, b, k)
  }

  function pk(a, b, k) {
    if (a === b) {
      console.log('DRAW')
    } else if (k === 1) {
      console.log(a > b ? 'A' : 'B')
    } else if (k === -1) {
      console.log(a < b ? 'A' : 'B')
    }
  }
}

solve(['3', '1 2 1', '1 2 -1', '2 2 1'])
