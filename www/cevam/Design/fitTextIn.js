require(["dojo/query", "dojo/dom-style", "dojo/dom-construct", "dojo/_base/window", "dojo/dom-attr", "dojo/dom-geometry", "dojo/NodeList-traverse"], function(query, style, construct, baseWin, attribute, geo ){
	window.fitTextIn = function(nodeSelector, modifW, modifH){
		if(typeof modifW == "undefined") {modifW = 0;}
		if(typeof modifH == "undefined") {modifH = 0;}

		query(nodeSelector).forEach(function(node){
			var container = query(node).parent()[0];
			var outerW = style.get(container, "width");
			var outerH = style.get(container, "height");
			var containerW = outerW - 2*modifW;
			var containerH = outerH - 2*modifH;
			style.set(node, "width", containerW+"px");
			style.set(node, "height", containerH+"px");
			
			style.set(node, "fontSize", "0px");
			var c = 0;
			while( (style.get(node, "width") <= containerW) && (style.get(node, "height") <= containerH) ){
			c ++;
			style.set(node,"fontSize",c+"px");
//alert(c);			
			}
	
			if(c >= 2){style.set(node,"fontSize",(c-1)+"px");}
			else{style.set(node,"fontSize","1px");}
//			style.set(node, "height", "");
//			style.set(node, "width", "");



//			style.set(node, "height", containerH+"px");
//			style.set(node, "width", containerW+"px");

			
			style.set(node, "top", "0px");
			style.set(node, "left", "0px");
			if(style.get(node, "height")<outerH) {style.set(node, "top", (outerH-style.get(node, "height"))/2+"px");}
			if(style.get(node, "width")<outerW) {style.set(node, "left", (outerW-style.get(node, "width"))/2+"px");}
		});
	}
});