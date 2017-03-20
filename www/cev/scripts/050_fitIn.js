require(["dojo/query", "dojo/dom-style", "dojo/dom-construct", "dojo/_base/window", "dojo/dom-attr", "dojo/dom-geometry", "dojo/NodeList-traverse"], function(query, style, construct, baseWin, attribute, geo ){
	window.fitIn = function(nodeSelector, modifW, modifH){
		if(typeof modifW == "undefined") {modifW = 0;}
		if(typeof modifH == "undefined") {modifH = 0;}

//alert("FITIN():: selector: "+nodeSelector+" | qté: "+query(nodeSelector).length);
		query(nodeSelector).forEach(function(node){

			var container = query(node).parent()[0];
			var outerW = style.get(container, "width");
			var outerH = style.get(container, "height");
			var containerW = outerW - 2*modifW;
			var containerH = outerH - 2*modifH;
				node.style.height="";
//alert("1::"+node.width);				
				node.style.width="";
//alert("2::"+node.width);
			if(node.tagName == "IMG"){
				var tmp = construct.create("img", {style:{dislpay:"none"}}, baseWin.body());
				attribute.set(tmp, "src", attribute.get(node, "src"));
				var nodeW = geo.position(tmp, false).w;
				var nodeH = geo.position(tmp, false).h;
				construct.destroy(tmp);
				var coefWHnode = nodeW / nodeH;
				if(containerH*coefWHnode < containerW){
					node.style.height = containerH+"px";
					}
				else{
					node.style.width = containerW+"px";
					}
			}
			else{
				node.style.height = containerH+"px";
				node.style.width = containerW+"px";
			}
			node.style.top = "0px";
			node.style.left = "0px";
			if(style.get(node, "height") < outerH) {node.style.top =  (outerH - style.get(node, "height"))/2+"px";}
			if(style.get(node, "width") < outerW) {node.style.left =  (outerW-style.get(node, "width"))/2+"px";}
		});
//alert("fitIn() end.");
	};
});