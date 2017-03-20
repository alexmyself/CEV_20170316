require(["dojo/window", "dojo/on", "dojo/dom-construct", "dojo/_base/window", "dojo/dom-geometry",  "dojo/domReady!"], function(win, on, construct, baseWin, geo){
	window.winSize = function(){
		window.winSizeHandler.remove();	
		winBox = win.getBox();
		if(window.winW == winBox.w && window.winH == winBox.h){
			window.winSizeHandler = on(window, "resize", function(){ window.winSize();});
			return;
		}
		window.winW = winBox.w;
		window.winH = winBox.h;
		if(typeof(window.globalGEOMETRY) != "undefined"){window.globalGEOMETRY();}
		if(typeof(window.GEOMETRY) != "undefined"){window.GEOMETRY();}
		window.winSizeHandler = on(window, "resize", function(){ window.winSize();});		
	};
	//scrollbar width
	var tmp = construct.create("div", {style:{width:"100px", height:"100px", position:"absolute", overflow:"scroll"}}, baseWin.body());
	window.scrollbarWidth = tmp.offsetWidth - tmp.clientWidth;
	construct.destroy(tmp);
});

require(["dojo/on", "dojo/domReady!"], function(on){
	window.winSizeHandler = on(window, "resize", function(){ window.winSize();});
});

window.onDomReady[window.onDomReady.length] = "winSize";
