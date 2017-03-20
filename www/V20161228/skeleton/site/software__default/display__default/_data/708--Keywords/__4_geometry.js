/*_____SparesParts Geometry*/
geometry.stack(function(){
	if( !nodeExist('#keywordsContainer')){ return; }
	sizeText('#keywordsContainer div', surfaces.keywords.textH);
	dojo.query('#keywordsContainer').style({
		'marginTop': surfaces.keywords.textH+'px'
	});
	if(!slowMachine){dojo.query('#keywordsContainer .bg').style({'opacity': surfaces.keywords.bgOpacity});}
});
