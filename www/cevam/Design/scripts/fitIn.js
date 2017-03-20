require(["dojo/query", "dojo/dom-style", "dojo/dom-construct", "dojo/_base/window", "dojo/dom-attr", "dojo/dom-geometry", "dojo/NodeList-traverse"], function(query, style, construct, baseWin, attribute, geo ){
	window.fitIn = function(nodeSelector, modifW, modifH){
		if(typeof modifW == "undefined") {modifW = 0;}
		if(typeof modifH == "undefined") {modifH = 0;}

		query(nodeSelector).forEach(function(node){
			var container = query(node).parent()[0];

			var outerW = style.get(container, "width");
			var outerH = style.get(container, "height");
			var containerW = outerW - 2*modifW;
			var containerH = outerH - 2*modifH;
			style.set(node, "height", "");
			style.set(node, "width", "");

			if(node.tagName == "IMG"){
				var coefWHcontainer = containerW/containerH;
				var tmp = construct.create("img", {style:{dislpay:"none"}}, baseWin.body());
				attribute.set(tmp, "src", attribute.get(node, "src"));
				var nodeW = geo.position(tmp, false).w;
				var nodeH = geo.position(tmp, false).h;
				construct.destroy(tmp);
				var coefWHnode = nodeW / nodeH;
				if(containerH*coefWHnode < containerW){
					style.set(node, "height", containerH+"px");
					}
				else{
					style.set(node, "width", containerW+"px");
					}
			}
			else{
			style.set(node, "height", containerH+"px");
			style.set(node, "width", containerW+"px");
			}
			
			style.set(node, "top", "0px");
			style.set(node, "left", "0px");
			if(style.get(node, "height")<outerH) {style.set(node, "top", (outerH-style.get(node, "height"))/2+"px");}
			if(style.get(node, "width")<outerW) {style.set(node, "left", (outerW-style.get(node, "width"))/2+"px");}
		});
	}
});