/*_____AskedPAge Geometry*/
geometry.stack(function(){
	if( !nodeExist('#askedPage')){ return; }
	var askedPageNode= dojo.query('#askedPage');
	var w= surfaces.askedPage.w- 2*surfaces.askedPage.marginInnerContent;
	if( w > 47*surfaces.fontMinHeightPx){w= 47*surfaces.fontMinHeightPx;}
	askedPageNode.style({'height': ''});


	//_____Backgrounds
	if(!slowMachine){askedPageNode.children('.bg').style('opacity', surfaces.opacity1);}
	
	geoHelper.set.wO('#askedPage, #askedPageTitle', surfaces.askedPage.w);

	//Title
	var titleNode=askedPageNode.children('#askedPageTitle');
	tmp=sizeText(titleNode.children('#askedPageTitleLabel'), surfaces.askedPage.titleH);
	var tH = (tmp>0? tmp : 1);

	var margin= tH*5;
	if (nodeExist('.navigationLinkContainer')){ 
		tmp= geoHelper.get.wO(dojo.query('.navigationLinkContainer'));
		margin= tmp>0 ? tmp : 1;
	}
	titleNode.children('#askedPageTitleLabel').style('marginLeft', margin+'px');

	sizeText(titleNode.children('#askedPageTitleLabelAds'), tH- 2*surfaces.stdMargin);
	titleNode.children('#askedPageTitleLabelAds').style({
		'marginLeft': margin/3+'px',
		'marginTop': surfaces.stdMargin+'px'
	});


	//_____Resume
	if(nodeExist('#askedPageResume')){
		var resumeNode=askedPageNode.children('#askedPageResume');
		sizeText(resumeNode, tH*0.6);
		var top=surfaces.askedPage.titleH*0.3;
		var width= surfaces.askedPage.titleH*15;
		if(!slowMachine){resumeNode.style({ 'opacity' 	: surfaces.askedPage.bgResumeOpacity});}
		resumeNode.style({
			'width' 	: width+'px',
			'top' 		: top+'px',
			'marginLeft' 	: surfaces.display.w - width - surfaces.askedPage.titleH*5+'px',
			'padding' 	: surfaces.stdMargin+'px'
		});
		askedPageNode.style('minHeight', top+geoHelper.get.hO('#askedPageResume') +'px');
	}


	//_____Central display
	//Chapters
	if(dojo.query('#chaptersContainer').length > 0){
		var chaptersContainerNode=dojo.query('#chaptersContainer');

		//Chapter
		if(chaptersContainerNode.children('.chapter').length > 0){
			var chapterNodesList= chaptersContainerNode.children('.chapter');
			sizeText('#chaptersContainer table *', tH*0.5);
			chapterNodesList.style({
				'marginLeft' 	: surfaces.askedPage.marginInnerContent+'px',
				'marginTop' 	: surfaces.askedPage.marginInnerContent+'px',
				'borderWidth' 	: surfaces.askedPage.borderBase+'px'
			});
			//Chapter content
			if(chapterNodesList.children('div').length >0){
				//Resetting eventual previous settings
				chapterNodesList.style('width','');
				chapterNodesList.children('.chapterImgParentContainer').style('width','');
				chapterNodesList.children('.chapterImgParentContainer').children('.chapterImgContainer').style('width','');


				//Setting a width
				geoHelper.set.wI(chapterNodesList, w);
				chapterNodesList.children('div').style({ 'marginTop' : surfaces.askedPage.marginInnerContent+'px'});
				chapterNodesList.children('div:nth-child(2)').style({ 'marginTop' : '0px'});

				//Image
				chapterNodesList.children('.chapterImgParentContainer').forEach(function(strangeObject){
					var nodeImgParentContainer = dojo.query(strangeObject);
					if ( nodeImgParentContainer.children('.chapterImgContainer').length == 0 ){ nodeImgParentContainer.style('display', 'none'); }
					else{
						geoHelper.set.wO(nodeImgParentContainer, w);
						var wx= geoHelper.get.wI(nodeImgParentContainer);

						var chapterImgContainerNodesList= nodeImgParentContainer.children('.chapterImgContainer');
						//geoHelper.set.wO(chapterImgContainerNodesList,wx);
						//geoHelper.set.hO(chapterImgContainerNodesList,wx / surfaces.imgRatio);
						grid(chapterImgContainerNodesList, 3,  surfaces.ratio, surfaces.stdMargin, surfaces.stdMargin);
					}
				});
			}
			chapterNodesList.children('.bg').style({'marginTop' 	: '0px'});
			if(!slowMachine){chapterNodesList.children('.bg').style({'opacity' 	: surfaces.opacityMin});}
		}
	}
	//Dimensions
	if (askedPageNode.children('.caracteristics_all').length > 0){
		var dimensionsNode = askedPageNode.children('.caracteristics_all');
		dimensionsNode.style({ 
			'width' 	: w+'px',
			'marginLeft' 	: surfaces.askedPage.marginInnerContent+'px',
			'marginTop' 	: surfaces.askedPage.marginInnerContent+'px',
			'border' 	: 'solid white '+ surfaces.askedPage.borderBase+'px'
		});
		sizeText('.caracteristics_all table *', tH*0.5);
		dimensionsNode.children('table').children('tbody').children('tr').odd().style('backgroundColor', 'rgb(240, 240, 240)');
		if(!slowMachine){dimensionsNode.children('.bg').style('opacity', surfaces.opacityMin);}

	}

	//Gallery
	galleryNode=askedPageNode.children('#gallery');
	galleryNode.style({ 
		'marginTop' 	: surfaces.askedPage.marginInnerContent+'px',
		'marginLeft' 	: surfaces.askedPage.marginInnerContent+'px',
		'border' 		: 'solid white '+surfaces.askedPage.borderBase+'px'
	});
	if(!slowMachine){galleryNode.children('.bg').style('opacity', surfaces.opacityMin);}
	dojo.query('.galleryImgContainer').style({
		'height' 		: surfaces.askedPage.galleryH+'px',
		'marginRight' 	: surfaces.askedPage.borderBase+'px',
		'marginTop' 	: surfaces.askedPage.borderBase+'px'
	});
	dojo.query('.galleryImg').style({'position':'relative' });
	dojo.query('#galleryBigDisplaySurface .bg').style({ 'opacity' : 1 });
});