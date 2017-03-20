require(["dojo/query", "dojo/has", "dojo/_base/sniff", "dojo/NodeList-traverse"], function(query, has){
	window.setWidth = function(nodeSelector, neededWidth){
		return window.setWH(nodeSelector, neededWidth, 'width');
	};
	window.setHeight = function(nodeSelector, neededHeight){
		return window.setWH(nodeSelector, neededHeight, 'height');
	};	
	window.setWH = function(nodeSelector, neededSize, side){
		if(side =='height'){
			b1Name = 'Top';
			b2Name = 'Bottom';
		}else{
			b1Name = 'Left';
			b2Name = 'Right';
		}
		var b1= query(nodeSelector).first().style('border'+b1Name+'Width');
		var b2= query(nodeSelector).first().style('border'+b2Name+'Width');

		//Les navigateurs comptent les bordures en supplément de width (nodeWidth + borderL&R = realWidth)
			if(side=='height'){
				b1 -= 2;
				//if( has('ie')!=undefined || has('trident')!=undefined) {b2 = 0.01;}
				}
		return neededSize - b1 - b2;
	};
});