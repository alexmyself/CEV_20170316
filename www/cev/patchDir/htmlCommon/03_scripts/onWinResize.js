require(["dojo/on", "dojo/window"], function(on, win){
	window.onWinResize = function(){
		window.onWinResizeHandler.remove();
		winBox = win.getBox();
		if(window.winW == winBox.w && window.winH == winBox.h){
			window.onWinResizeHandler = on(window, "resize", function(){ window.onWinResize();});
			return;
		}
		window.winSize();
		window.GEOMETRY();
		window.onWinResizeHandler = on(window, "resize", function(){ window.onWinResize();});
	};
	
	window.onWinResizeHandler = on(window, "resize", function(){ window.onWinResize();});
});