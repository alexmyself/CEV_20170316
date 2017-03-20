//require(["dojo/domReady!"], function(){
require(["dojo/ready"], function(ready){
	ready( function(){
		GEOMETRY(); 
		bottomBarPopUp();	
			
		require(["dojo/on", "dojo/window", "dojo/dom", "dojo/query"], function(on, win, dom, query){
			on(window, "resize", function(){
				winBox = win.getBox();
				window.winW = winBox.w;
				window.winH = winBox.h;
				GEOMETRY();
				query(".image").forEach(function(node){
					fitIn(node);
					});
				} );
			on(dom.byId("iconControl1"), "click", function(evt){window.bottomBarPopDown();});
			on(dom.byId("iconControl2"), "click", function(evt){window.bottomBarPopUp();});
		});

	});
});