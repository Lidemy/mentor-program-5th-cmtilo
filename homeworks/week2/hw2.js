function capitalize(str) {
  var a = str.charCodeAt(0);
  if (a>=97 || a<=122){
  	var first = str[0].toUpperCase();
  	return str.replace(str[0], first) ;

  }
}

console.log(capitalize('hello'));
