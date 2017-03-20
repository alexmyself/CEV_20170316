require(["dojo/window", "dojo/dom-construct", "dojo/_base/window"], function(win, construct, baseWin){
	window.winSize = function(){
		winBox = win.getBox();
		window.winW = winBox.w;
		window.winH = winBox.h;
		
		window.ratio = 16/9;
		if(window.winW >= ratio*window.winH){
			window.winHCorrected = window.winH;
			window.winWCorrected = window.winH*ratio;
		}
		else{
			window.winWCorrected = window.winW;
			window.winHCorrected = window.winW*(1/ratio);
		}
		window.winRatio = window.winW/window.winH;
	};

	//scrollbar width
	var tmp = construct.create("div", {style:{width:"100px", height:"100px", position:"absolute", overflow:"scroll"}}, baseWin.body());
	window.scrollbarWidth = tmp.offsetWidth - tmp.clientWidth;
	construct.destroy(tmp);
});