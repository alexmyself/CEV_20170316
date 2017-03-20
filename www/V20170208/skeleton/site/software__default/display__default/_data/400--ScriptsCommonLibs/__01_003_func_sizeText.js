//Aux tailles 1&2px les fonts ont les mêmes width et height..
//Certaines augmentation de fontSize n'affectent que la largeur de la font, c'est laid et chiant.
sizeText = function(nodeSelector, heightInPix, debug){
	if(!nodeExist(nodeSelector)){return false;}

	//_____________Trying to calculate dpi and real size of font once and only once, not at each call
	if(surfaces.fontMinHeightPx == null){
		//Checking dpi screen to avoid too small fonts. Minimum size defined in obj_surfaces.js, in mm.
		dpiNodeW=3;
		dpiNode = dojo.construct.create('div', { innerHTML: '<b><u>&Ecirc;@</u></b> <div style="clear:both;"></div>', 
				style: {'width':dpiNodeW+'cm', 'height':dpiNodeW+'cm', 'display': 'inline-block', 'position':'absolute', 'top':'0px', 'left':'0px', 'fontSize':'0px', 'fontFamily':'sans-serif', 'border':'0px' } }, dojo.baseWin.body());
		dpiNodeWPx= parseFloat(dojo.style.get(dpiNode, 'width'));
		dojo.construct.destroy(dpiNode);
		screenLieCoeff=1.5; //Doesn't display the good length in mm, so patching..
		dpiNodeWPx *= screenLieCoeff;
		surfaces.fontMinHeightPx=((surfaces.fontMinHeightMm / 10) / dpiNodeW)*dpiNodeWPx;
	}

	if(surfaces.fontHeightList == null){
		surfaces.fontHeightList=[];
		var minHeight=surfaces.fontMinHeightPx;
		var maxHeight=surfaces.screen.h / 4;
		testNode = dojo.construct.create('div', { innerHTML: '<b><u>&Ecirc;@</u></b> <div style="clear:both;"></div>', 
			style: { 'display': 'inline-block', 'position':'absolute', 'fontSize':'0px', 'fontFamily':'sans-serif', 'border':'0px' } }, dojo.baseWin.body());

		var stop=false;
		var noChangeLimit=3;
		var tries=0;
		var lastH= parseFloat(geoHelper.get.hO(testNode) );
		surfaces.fontHeightList[0]=0;
		var index=1;
		var setH=parseFloat(0);
		while(stop==false){
			dojo.style.set(testNode, 'fontSize', setH+'px');
			newH= parseFloat(geoHelper.get.hO(testNode) );
			
			//Stop conditions
			if(newH>=maxHeight){stop=true;}
			if(newH == lastH){
				tries++;
				if(tries>noChangeLimit){stop=true;}
			}
			else{
				tries=0;
				lastH=newH;
			}
			

			if(Math.ceil(newH)==index){
				surfaces.fontHeightList[index]=setH;
				index++;
			}
			else if(Math.ceil(newH)>index){
				var settingVal=surfaces.fontHeightList[index - 1];
				while(Math.ceil(newH) >= index){
					surfaces.fontHeightList[index]=settingVal;
					index++;
				}

			}
			setH++;
		}
		dojo.construct.destroy(testNode);
	}

	if(heightInPix < surfaces.fontMinHeightPx){heightInPix=surfaces.fontMinHeightPx;}
	var tH= surfaces.fontHeightList[Math.floor(heightInPix)] *surfaces.fontBase;
	dojo.query(nodeSelector).style('fontSize', tH+'px');
	return heightInPix;
};