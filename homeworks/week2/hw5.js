function join(arr, concatStr) {
	var a = arr[0];
	for (i=1; i<arr.length; i++){
		a = a + concatStr + arr[i] 
		 
	} return a
}


function repeat(str, times) {
	var b = str;

	do {
		b = b + str
		times--
	} while(times > 1 )
	
	return b

}


console.log(join(['a'], '!'));
console.log(join([1, 2, 3], ''));
console.log(join(["a", "b", "c"], "!"));
console.log(join(["a", 1, "b", 2, "c", 3], ','));

console.log(repeat('a', 5));
console.log(repeat('yoyo', 2));