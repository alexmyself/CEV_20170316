/*_____DisplaySurface Properties*/
surfaces.display={
	w 	: 0,
	h 	: 0,
	bgOpacity: 0.2,
	math 	: function(){
		var addScrollbar=0
		if(dojo.style.get(dojo.baseWin.body(), 'height') < surfaces.screen.h){addScrollbar=surfaces.scrollBar.w;}
		this.w= surfaces.screen.w - addScrollbar;
		this.h= surfaces.screen.h;
	}
};
surfaces.stack(function(nodesList, parent){surfaces.display.math();});