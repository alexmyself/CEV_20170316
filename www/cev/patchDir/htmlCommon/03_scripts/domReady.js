//Fired at js "boot"
require(['dojo/ready', 'dojo/dom', "dojo/on"], function(ready, dom, on){
	ready( function(){
		window.onWinResize();
		window.bottomBarPopUp();
		on(dom.byId("iconControl1"), "click", function(evt){window.bottomBarPopDown();});
		on(dom.byId("iconControl2"), "click", function(evt){window.bottomBarPopUp();});
	});
});