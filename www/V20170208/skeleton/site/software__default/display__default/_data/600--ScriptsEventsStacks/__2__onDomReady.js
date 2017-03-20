//Will be played one time once dojo and dom are ready.
onDomReady.stack( function(){
	surfaces.locked=false;
	surfaces.play();});

onDomReady.stack(function(){
	geometry.locked=false;
	geometry.play();});
/*
onDomReady.stack(function(){
	displaySwitch.locked=false;
	displaySwitch.populate();
	displaySwitch.play({'funcs':['on']});
});
*/

onDomReady.stack(function(){
	imageReady.locked=false;
//	imageReady.stack(dojo.query('img'));
//	imageReady.play();
});

onDomReady.stack(function(){gallery.locked=false;});

onDomReady.stack(function(){
	winSizeHandler = dojo.on(window, "resize", function(){
		if(lock() !== true){return false;} //Prevent multiple calls, ie emit the resize ~10times / ms...
		onWindowResize.locked=false; //Prevent boot problems, things doesn't work until we told the them to do so.
		onWindowResize.play();
		unlock();
	});
});




require(["dojo/ready"], function(ready){
	ready( function(){
		onDomReady.locked=false;
		onDomReady.play();
		unlock();
	});
});