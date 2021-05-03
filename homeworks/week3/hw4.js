function solve(lines) {
  const s = lines.toString()

  function reverse(str) {
    let a = ''
    for (let i = str.length - 1; i >= 0; i--) {
      a += str[i]
    }
    return a
  }

  if (s === reverse(s)) {
    console.log('True')
  } else {
    console.log('False')
  }
}

solve(['abbbba'])
