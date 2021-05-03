function solve(lines) {
  const n = Number(lines[0])

  for (let i = 1; i <= n; i++) {
    const p = Number(lines[i])
    if (p === 1) {
      console.log('Composite')
    } else if (p === 2) {
      console.log('Prime')
    } else {
      console.log(isPrime(p))
    }
  }

  function isPrime(p) {
    if (p > 2) {
      for (let j = 2; j < p; j++) {
        if (p % j === 0) return 'Composite'
      }
      return 'Prime'
    }
  }
}

/* 想請教助教以下解法為何不行AC?
function solve(lines) {
  let n = Number(lines[0])

  for (let i = 1; i <= n; i++) {
    let p = Number(lines[i])
    if (p === 1) {
      console.log ('Composite')
    } else if (p === 2) {
      console.log ('Prime')
    }
    for (let j = 2; j < p; j++) {
      if ( p % j === 0) {
        console.log ('Composite')
        break
      }
    console.log('Prime')
    break
    }
  }
}
*/

solve(['5', '1', '2', '3', '4', '5'])
