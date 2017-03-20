fitIn = function(nodeSelector, modifW, modifH){
	if(typeof modifW == 'undefined') {modifW = 0;}
	if(typeof modifH == 'undefined') {modifH = 0;}

	dojo.query(nodeSelector).forEach(function(node){
		var decoratedNode 	= dojo.query(node);
		var container 		= decoratedNode.parents('span, div')[0];
		var outerW 			= Math.floor(geoHelper.get.wI(container));
		var outerH 			= Math.floor(geoHelper.get.hI(container));

		var containerW 		= Math.floor(outerW - Math.ceil(modifW));
		var containerH 		= Math.floor(outerH - Math.ceil(modifH));

		var newProperties 	={'top':'0px', 'margin':'auto'};

		if(node.tagName != 'IMG'){
			geoHelper.set.wO(decoratedNode, containerW);
			geoHelper.set.hO(decoratedNode, containerH);
		}
		decoratedNode.style(newProperties);
		newProperties.nodeH=geoHelper.get.hO(node);
		if(newProperties.nodeH<outerH) { decoratedNode.style('top', Math.floor((outerH- newProperties.nodeH )/2)+'px');}
		
	});
};