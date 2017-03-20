window.bottomBarPopDown = function(){
	require(["dojo/dom", "dojo/fx", "dojo/_base/fx"], function(dom, fx, baseFx ){
		var slide = fx.slideTo({node: dom.byId("bottomBar"),
					left: window.bottomBar.l,
					top: window.winH-window.bottomBar.h,
					units:"px",
					duration: 1300,
					delay:700});

		var height = baseFx.animateProperty({node: dom.byId("bottomBar"),
					properties: {height:window.bottomBar.h},
					duration:1500 });
					
		var opacity = baseFx.animateProperty({node: dom.byId("bottomBarBg"),
					properties: {opacity: window.bottomBar.o},
					duration:1500 });
					
		fx.combine([slide, height, opacity]).play();
	});
}




window.bottomBarPopUp = function(){
	require(["dojo/dom", "dojo/dom-style", "dojo/fx", "dojo/_base/fx"], function(dom, style, fx, baseFx ){
		var slide = fx.slideTo({node: dom.byId("bottomBar"),
					left: window.bottomBar.l,
					top: style.get("inputRecherche", "height")+2,
					units:"px",
					duration: 1500});

		var height = baseFx.animateProperty({node: dom.byId("bottomBar"),
					properties: {height: window.winH-2-style.get("inputRecherche", "height")*2},
					duration:1300,
					delay:700});
		
		var opacity = baseFx.animateProperty({node: dom.byId("bottomBarBg"),
					properties: {opacity: 0.9},
					duration:1300,
					delay:700});
		
		fx.combine([slide, height, opacity]).play();
	});		
}