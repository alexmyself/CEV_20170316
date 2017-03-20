/*_____RelatedItems Geometry*/
geometry.stack(function(){
	if( !nodeExist('#relatedItems .itemContainer')){ 
		dojo.construct.destroy(dojo.dom.byId('relatedItems'));
		return;
	}
	var relatedNode=dojo.query('#relatedItems');
	geoHelper.set.wO(relatedNode, surfaces.relatedItems.w);
	grid(relatedNode.query('a > div'), surfaces.relatedItems.itemsNumber, surfaces.ratio, surfaces.stdMargin*4, surfaces.stdMargin*3);

	ItemContainerInnerGeometry('#relatedItems ');
});
