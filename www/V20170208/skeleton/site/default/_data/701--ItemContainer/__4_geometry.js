/*_____ItemContainer Geometry*/

//Do geometry by families, to make things fast, ie8 on old hardware complain about script too long when applying innergeo blindly on every .itemContainer nodes.
ItemContainerInnerGeometry=function(selector, overridingValues){
	if(typeof overridingValues === 'undefined'){overridingValues={};}
	//Get values from default object or from a provided one.	
	var values={};
	for (var i in surfaces.itemContainer) {
		if(overridingValues[i]){values[i]=overridingValues[i];}
		else{values[i]=surfaces.itemContainer[i];}
	}


	//Take container orginals datas before anything changes it..
	var tmpObj={};
	var itemContainerSelector 	= selector+' .itemContainer';
	var itemContainerNodesList 	= dojo.query(itemContainerSelector);
	var itemContainerNode 		= itemContainerNodesList.first();
	tmpObj.itemContainerWI 		= values.containerW || parseFloat(itemContainerNode.parent().style('width'));
	tmpObj.itemContainerHI 		= values.containerH || parseFloat(itemContainerNode.parent().style('height'));

	//Borders are a problem to correctly math things, so switch on before anything.
	var borderText= values.borderWidth+'px '+values.borderType+' '+values.borderColor;
	//Label borders are taken from the hover values
	var labelBorderText= values.labelBorderType+' '+values.labelBorderColor;
	var imageBorderText= values.imageBorderWidth+'px '+values.imageBorderType+' '+values.imageBorderColor;
	itemContainerNodesList.children('.border').style({ 'border': borderText });
	itemContainerNodesList.children('.labelContainer').children('.border').style({ 
		'border' 			: labelBorderText,
		'borderTopWidth' 	: values.labelBorderHoverTopWidth+'px',
		'borderBottomWidth' : values.labelBorderHoverBottomWidth+'px',
		'borderLeftWidth' 	: values.labelBorderHoverLeftWidth+'px',
		'borderRightWidth' 	: values.labelBorderHoverRightWidth+'px'
	});
	itemContainerNodesList.children('.imageContainer').children('.border').style({ 'border': imageBorderText });

	geoHelper.set.wO(itemContainerNodesList, tmpObj.itemContainerWI);
	geoHelper.set.hO(itemContainerNodesList, tmpObj.itemContainerHI);

	//Backgrounds
	var backgroundNodesList= itemContainerNodesList.children('.background, .backgroundHover');
	if( backgroundNodesList.length > 0){
		var backgroundNode= backgroundNodesList.first();
		geoHelper.set.wO(backgroundNodesList, tmpObj.itemContainerWI);
		geoHelper.set.hO(backgroundNodesList, tmpObj.itemContainerHI);
		if(!slowMachine){
			itemContainerNodesList.children('.background').style('opacity', values.bgOpacity);
			itemContainerNodesList.children('.backgroundHover').style('opacity', values.bgHoverOpacity);
		}
	}

	//Border
	var borderNodesList= itemContainerNodesList.children('.border');
	if(borderNodesList.length > 0){
		var borderNode=borderNodesList.first();
		geoHelper.set.wO(borderNodesList, tmpObj.itemContainerWI);
		geoHelper.set.hO(borderNodesList, tmpObj.itemContainerHI);
		tmpObj.borderWI=geoHelper.get.wI(borderNode);
		tmpObj.borderHI=geoHelper.get.hI(borderNode);
	}

	//Label
	var labelNodesList= itemContainerNodesList.children('.labelContainer');
	if(labelNodesList.length > 0){
		labelNodesList.style('display', 'block');
		var labelNode= labelNodesList.first();
		geoHelper.set.wO(labelNodesList, tmpObj.borderWI);
		geoHelper.set.t(labelNodesList, values.borderWidth );
		geoHelper.set.l(labelNodesList, values.borderWidth );

		tmpObj.labelContainerWI=geoHelper.get.wI(labelNode); //39 000...
		var labels=labelNodesList.children('.label');

		geoHelper.set.wO(labelNodesList.children('.border, .background, .backgroundHover'), tmpObj.labelContainerWI);
		geoHelper.set.wO(labels, geoHelper.get.wI(labelNode.children('.border').first()) );

		//Text could have been set to a 'max', resets it's effect.
		labels.style('height','');
		sizeText(labels, values.labelTextH*tmpObj.labelContainerWI);

		var max= geoHelper.get.max.h(labels);
		//If labels covers more than 50% of vignette images became too small, so hide labels
		coef=0.5;
		if(max > (coef*tmpObj.itemContainerHI)){ 
			labelNodesList.style('display', 'none');
			tmpObj.labelHO=0;
		}
		else{
			geoHelper.set.hO(labels, max);
			geoHelper.set.hI(labelNodesList.children('.border'), max);
			var listX= labelNodesList.concat(labelNodesList.children('.background, .backgroundHover'));
			geoHelper.set.hO(listX, geoHelper.get.hO(labelNodesList.children('.border').first()) );
			if(!slowMachine){
				labelNodesList.children('.background').style('opacity', values.labelBgOpacity);
				labelNodesList.children('.backgroundHover').style('opacity', values.labelBgHoverOpacity);
			}
			tmpObj.labelHO=max;
		}
	}


	//Image
	var imageNodesList= itemContainerNodesList.children('.imageContainer');
	if(imageNodesList.length > 0){
		var imageNode= imageNodesList.first();
		var mL= values.imageMarginLeft;
		var ML=2*mL;
		var mT= values.imageMarginTop;
		var labelsB= (tmpObj.labelHO==0)? 0: geoHelper.get.b(labelNode);
		var MT= 2*mT;
		var h=tmpObj.borderHI - MT - tmpObj.labelHO;
		var w=tmpObj.borderWI - ML;
		if( (h * surfaces.imgRatio) > w ){h=w/surfaces.imgRatio;}

		var listX= imageNodesList.concat(imageNodesList.children('.border, .background, .backgroundHover') );
		geoHelper.set.wO(listX, w);
		geoHelper.set.hO(listX, h);
		geoHelper.set.t(imageNodesList,  labelsB + mT );
		geoHelper.set.l(imageNodesList, values.borderWidth + mL);
		if(!slowMachine){
			imageNodesList.children('.background').style('opacity', values.imageBgOpacity);
			imageNodesList.children('.backgroundHover').style('opacity', values.imageBgHoverOpacity);
		}
	}
	

	//Info
	var infoContainerNodesList= itemContainerNodesList.children('.infoContainer');
	if(infoContainerNodesList.length > 0){
		var infoContainerNode= infoContainerNodesList.first();
		var mL= values.infoMarginLeft;
		var ML=2*mL;
		var mT= values.infoMarginTop;
		var MT= 2*mT;
		var w=tmpObj.borderWI - ML;
		geoHelper.set.wO(infoContainerNodesList, w );
		sizeText('.infoContainer table *', values.infoTextH*tmpObj.labelContainerWI);

		var prevH= geoHelper.get.b(imageNode);
		//If doesn't fit: hide.
		var maxH=geoHelper.get.max.h(infoContainerNodesList);
		if(maxH > (tmpObj.borderHI - prevH - MT)){ infoContainerNodesList.style('display', 'none');}
		else{
			geoHelper.set.hO(infoContainerNodesList, maxH);
			var hAvail= tmpObj.borderHI - (prevH + MT);
			var hAvailT= (hAvail- maxH)/2;
			var t= prevH + mT + hAvailT;

			geoHelper.set.t(infoContainerNodesList, t) ;
			geoHelper.set.l(infoContainerNodesList, values.borderWidth + mL);
			infoContainerNodesList.children('table').children('tbody').children('tr').children('td:nth-child(3)').style('textAlign','right');
		}

	}


	//Put borders back.
 	borderNodesList.style('border', borderText);
 	labelNodesList.children('.border').style({
 		'border' 		: labelBorderText,
		'borderTopWidth' 	: values.labelBorderTopWidth+'px',
		'borderBottomWidth' 	: values.labelBorderBottomWidth+'px',
		'borderLeftWidth' 	: values.labelBorderLeftWidth+'px',
		'borderRightWidth' 	: values.labelBorderRightWidth+'px'
 	});
 	imageNodesList.children('.border').style('border', imageBorderText);

 	//Add events, as because we play with them, normal css rules do not apply any more.
 	itemContainerNodesList.on('mouseover', function(evt){
 		var node=dojo.query(evt.currentTarget);
 		node.children('.border').style('border', values.borderHoverWidth+'px '+values.borderHoverType+' '+values.borderHoverColor);
 		node.children('.labelContainer').children('.border').style({
 			'border' 		: values.labelBorderHoverType+' '+values.labelBorderHoverColor,
			'borderTopWidth' 	: values.labelBorderHoverTopWidth+'px',
			'borderBottomWidth' 	: values.labelBorderHoverBottomWidth+'px',
			'borderLeftWidth' 	: values.labelBorderHoverLeftWidth+'px',
			'borderRightWidth' 	: values.labelBorderHoverRightWidth+'px'
 		});
 		node.children('.imageContainer').children('.border').style('border', values.imageBorderHoverWidth+'px '+values.imageBorderHoverType+' '+values.imageBorderHoverColor);
 	});
 	itemContainerNodesList.on('mouseout', function(evt){
 		var node=dojo.query(evt.currentTarget);
 		node.children('.border').style('border', values.borderWidth+'px '+values.borderType+' '+values.borderColor);
 		node.children('.labelContainer').children('.border').style({
 			'border' 		: labelBorderText,
			'borderTopWidth' 	: values.labelBorderTopWidth+'px',
			'borderBottomWidth' 	: values.labelBorderBottomWidth+'px',
			'borderLeftWidth' 	: values.labelBorderLeftWidth+'px',
			'borderRightWidth' 	: values.labelBorderRightWidth+'px'
 		});
 		node.children('.imageContainer').children('.border').style('border', values.imageBorderWidth+'px '+values.imageBorderType+' '+values.imageBorderColor);
 	});
//End ItemContainerInnerGeometry()
};
