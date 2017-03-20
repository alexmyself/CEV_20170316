require(["dojo/ready"], function(ready){
	ready( function(){
		for (var i = 0; i < window.onDomReady.length; i++){
			window[window.onDomReady[i]]();
		}
	});
});