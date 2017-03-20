geometry.stack(function(){
	dojo.query('#askedPage').style({
		'marginBottom': surfaces.askedPage.marginBottom+'px',
		'paddingBottom': surfaces.askedPage.marginInnerContent+'px'
	});
	dojo.query('#navigation > .bg, #askedPage > .bg, #sparesParts > .bg, #relatedItems > .bg').style({'display':'block', 'opacity':surfaces.opacity1});
	dojo.style.set('displaySurface', 'opacity', surfaces.display.bgOpacity);
});