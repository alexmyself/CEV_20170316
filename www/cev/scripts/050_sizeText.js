//Aux tailles 1&2px les fonts ont les mêmes width et height..
//Certaines augmentation de fontSize n'affectent que la largeur de la font, c'est laid et chiant.
require(["dojo/query", "dojo/dom-style", "dojo/dom-construct", "dojo/_base/window", "dojo/dom-attr", "dojo/dom-geometry", "dojo/NodeList-traverse"], function(query, style, construct, baseWin, attribute, geo ){
	window.sizeText = function(nodeSelector, heightInPix){
		if(window.sizeTextStep == undefined){
			var testNode = construct.create("div", { innerHTML: "<b>@</b>", 
													style: { display: "inline-block", position:"absolute", top:"0px", left:"0px" } },
													baseWin.body());
			style.set(testNode, "fontSize", "0px");		
			var c = 1;
			window.sizeTextStep = new Array();
			window.sizeTextStep[0] = c;
			var beforeHeight = 0;
			var newHeight = 1;
//			while( newHeight < 500 ){
while( c < window.winH ){
				if(newHeight > beforeHeight){window.sizeTextStep[window.sizeTextStep.length] = c;}
				beforeHeight = newHeight;
				c ++;
				style.set(testNode,"fontSize",c+"px");
				newHeight = style.get(testNode, "height");
			}
			construct.destroy(testNode);
		}
		if(heightInPix < 1){
			query(nodeSelector).style("fontSize", "1px");
			return;
		}
		var done = false;
		for(i=1; i<window.sizeTextStep.length; i++){
			if(window.sizeTextStep[i] > heightInPix){
				query(nodeSelector).style("fontSize", (window.sizeTextStep[i-1])+"px");
				done = true;
				break;
			}
		}
		if(done != true){query(nodeSelector).style("fontSize", (window.sizeTextStep[window.sizeTextStep.length-1])+"px");}
	}
});