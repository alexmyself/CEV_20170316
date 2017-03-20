/*_____MicroData Geometry*/
geometry.stack(function(){
	if( !nodeExist('#bottomBarMicroData')){ return; }
	var microDataNode= dojo.query('#bottomBarMicroData');
	var tH =sizeText(microDataNode.query('div, a, th, td'), surfaces.stdMargin*3);
	microDataNode.query('.categorie').style('paddingRight', surfaces.stdMargin*7+'px');
	microDataNode.style({
		'padding' : surfaces.stdMargin+'px',
		'marginTop' : surfaces.stdMargin*3+'px'
	});
	if(!slowMachine){microDataNode.children('.bg').style('opacity', surfaces.opacity1);}

});
