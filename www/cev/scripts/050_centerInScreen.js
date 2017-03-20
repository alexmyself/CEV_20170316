require(["dojo/window", "dojo/query", "dojo/dom-geometry", "dojo/NodeList-traverse", "dojo/NodeList-manipulate"], function(win, query, geo){
	window.centerInScreen = function(nodeSelector){
		query(nodeSelector).forEach(function(node){
			var nodeW = geo.position(node, false).w;
			query(node)
				.style("marginLeft", "0px")
				.style("left", "0px");
			var nodeLeft = geo.position(node, false).x;
			var left = 0;
			if(nodeW < window.winW){
				left = (window.winW - nodeW)/2 - nodeLeft;
			}
			query(node).style("marginLeft", left+"px");
		});
	};
});