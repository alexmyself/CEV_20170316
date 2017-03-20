require(["dojo/dom-style"], function(style){
	window.getBottom = function(nodeId){
							var top = style.get(nodeId, "top");
							var height = style.get(nodeId, "height");
							return top + height;
							}
	window.getRight = function(nodeId){
							var left = style.get(nodeId, "left");
							var width = style.get(nodeId, "width");
							return left + width;
							}
});