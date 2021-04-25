function reverse(str) {
  var usd = [];
  for (i=str.length-1; i>=0; i--){
  	usd.push(str[i]);
  	
  }
  
  console.log(usd.join(""));
  
}

reverse('hello');

