function dump(obj) {
	var out = '';
	for (var i in obj)
		{out += i + ': ' + obj[i] + "\n";}
		//{out += i +"----";}
	alert(out);
}