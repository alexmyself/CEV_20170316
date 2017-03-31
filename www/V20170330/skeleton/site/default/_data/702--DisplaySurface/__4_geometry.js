/*_____DisplaySurface Geometry*/
geometry.stack(function(){
	if( !nodeExist('#displayBgImg')){
		dojo.construct.destroy(dojo.dom.byId('displaySurface'));
	 	return;
	 }
	if(!slowMachine){dojo.style.set('displayBgImg', 'opacity', surfaces.display.bgOpacity);}
});