/*Special arrangement for homepage*/
bgOpacity=1;
itemOpacity=0.5;

surfaces.content.itemsRatioMultiplier	=1;
surfaces.content.gridTopMultiplier 		=25;
surfaces.content.gridLeftMultiplier 	=12;


geometry.stack(function(){
	dojo.style.set('displayBgImg', 'opacity', bgOpacity);
	dojo.query('#content .itemContainer > .background').style('opacity',itemOpacity);
	dojo.style.set('askedPageResume', {
		'width' 		: '',
		'marginLeft' 	: (surfaces.display.w/4*3) + (surfaces.content.gridLeftMultiplier*surfaces.stdMargin)-7*surfaces.stdMargin-1 +'px',
		'marginTop' 	: surfaces.stdMargin*surfaces.content.gridTopMultiplier/4+'px'
	});
	dojo.query('#askedPageResume a').style({'color': 'royalBlue'});
	sizeText('#askedPageResume a', surfaces.askedPage.titleH*0.6);

});

onDomReady.stack( function(){
	dojo.style.set('navigation', 'display', 'none');
	dojo.style.set('bottomBarMicroData', 'display', 'none');
	dojo.style.set('askedPageTitle', 'display', 'none');
	dojo.style.set('keywordsContainer', 'display', 'none');

});
onWindowResize.stack( function(){
	dojo.style.set('navigation', 'display', 'none');
	dojo.style.set('bottomBarMicroData', 'display', 'none');
	dojo.style.set('askedPageTitle', 'display', 'none');
	dojo.style.set('keywordsContainer', 'display', 'none');
});