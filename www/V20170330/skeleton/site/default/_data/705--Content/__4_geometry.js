/*_____Content Geometry*/
geometry.stack(function(){
	if( !nodeExist('#content .itemContainer')){ 
		dojo.construct.destroy(dojo.dom.byId('content'));
		return;
	}
	var contentNode=dojo.query('#content');
	geoHelper.set.wO(contentNode, surfaces.content.w);

	grid(contentNode.query('a > div'), surfaces.content.itemsNumber, surfaces.content.itemsRatio, surfaces.content.gridLeft, surfaces.content.gridTop);

	var override={
		imageMarginTop 		: surfaces.content.itemsImageMarginTop,
		imageMarginLeft 	: surfaces.content.itemsImageMarginLeft,
		infoMarginTop 		: surfaces.content.itemsImageMarginTop,
		infoMarginLeft 		: surfaces.content.itemsImageMarginLeft
	};
	ItemContainerInnerGeometry('#content ', override);
});