/*_____SparesParts Geometry*/
geometry.stack(function(){
	if( !nodeExist('#sparesParts .itemContainer')){ 
		dojo.construct.destroy(dojo.dom.byId('sparesParts'));
		return;
	}
	var sparesNode=dojo.query('#sparesParts');
	geoHelper.set.wO(sparesNode, surfaces.sparesParts.w);
	grid(sparesNode.query('a > div'), surfaces.sparesParts.itemsNumber, surfaces.ratio, surfaces.stdMargin*4, surfaces.stdMargin*3);

	var overide={
		bgHoverOpacity 	: surfaces.itemContainer.bgOpacity
	};

	ItemContainerInnerGeometry('#sparesParts ', overide);

	sizeText('#sparesPartsTitle', surfaces.sparesParts.textH);
	if(!slowMachine){dojo.query('#sparesPartsBg').style('opacity', surfaces.opacity1);}
});
