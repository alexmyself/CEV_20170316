/*_____Navigation Geometry*/
geometry.stack(function(){
	if( !nodeExist('.navigationLinkContainer')){
		dojo.construct.destroy(dojo.dom.byId('navigation'));
	 	return;
	}

	//Navigation container
	var navigationNode = dojo.query('#navigation');
	geoHelper.set.wO(navigationNode, surfaces.navigation.w);
	geoHelper.set.hO(navigationNode, surfaces.navigation.h);
	if(!slowMachine){dojo.style.set('navigationBg', 'opacity', surfaces.navigation.bgOpacity);}

	//Navigation items
	var linkContainerNodes= navigationNode.query('.navigationLinkContainer');
//Error
	grid(linkContainerNodes, surfaces.navigation.itemsNumber, surfaces.ratio);
//
	var divide=6.5;
	var rightArrowW=surfaces.stdMargin*2;
	var itemContainerW=geoHelper.get.wI(linkContainerNodes) - rightArrowW;
	var bottomArrowH=surfaces.stdMargin*2;
	var tmp=geoHelper.get.hI(linkContainerNodes);//Needed because of error on width value when navigation is hidden
	tmp= tmp>0? tmp : 2*bottomArrowH;
	var itemContainerH=tmp - bottomArrowH;

	var rightArrowH=itemContainerH / divide;
	var rightArrowL=itemContainerW;
	var rightArrowT=(itemContainerH - rightArrowH);

	var bottomArrowW=itemContainerH / divide;
	var bottomArrowL=(itemContainerW - bottomArrowW);
	var bottomArrowT=itemContainerH;
	
	var itemContainer = navigationNode.query('.itemContainer');

	var overide={
		containerW 		: itemContainerW,
		containerH 		: itemContainerH,
		bgHoverOpacity 	: surfaces.itemContainer.bgOpacity,
		labelBgOpacity 	: surfaces.navigation.labelBgOpacity,
		labelTextH 		: surfaces.navigation.labelTextH
	};
	ItemContainerInnerGeometry('#navigation ', overide);

	//Images of navigation vignette, fill the vignette without regard to title overlapping.
	var fullSelector='#navigation .itemContainer > .imageContainer';
	var node=dojo.query(fullSelector).first();
	var siblingBorder= node.siblings('.border');
	geoHelper.set.wO(fullSelector, geoHelper.get.wI(siblingBorder) );
//alert('703:: '+itemContainerW+' === '+itemContainer.first().style('width'));
	geoHelper.set.hO(fullSelector, geoHelper.get.hI(siblingBorder) );
	geoHelper.set.t(fullSelector, parseFloat(siblingBorder.style('borderTopWidth')) );
	geoHelper.set.l(fullSelector, parseFloat(siblingBorder.style('borderLeftWidth')) );

	if(nodeExist('.navigationRightArrowContainer')){
		dojo.query('.navigationRightArrowContainer').style({
			'height': rightArrowH +'px',
			'width'	: rightArrowW +'px',
			'left'	: rightArrowL +'px',
			'top'	: rightArrowT +'px'
		});
	}
	dojo.query('.navigationBottomArrowContainer').style({
		'height': bottomArrowH +'px',
		'width'	: bottomArrowW +'px',
		'left'	: bottomArrowL +'px',
		'top'	: bottomArrowT +'px'
	});
});