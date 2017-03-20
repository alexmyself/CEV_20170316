require(["dojo/on", "dojo/query", "dojo/dom-style", "dojo/dom-construct", "dojo/dom-class",  "dojo/_base/window", "dojo/dom-attr", "dojo/dom-geometry", "dojo/NodeList-traverse"], function(on, query, style, construct, domClass,  baseWin, attribute, geo ){
	window.imageLoader = function(){
		query("img:not(#waitImg)")
			.style("display", "none")
			.forEach(function(node){
				if(node.complete == true){style.set(node, "display", "inline-block");}
				else{
					on.once(node, "load", function(evt){imageLoaded(evt.target);});
					//query(node).style("display", "none");
					var imageWait = construct.create("img", {"class":"imageWait", src:"images/decorations/waitnew.gif", height:"5px"});
					construct.place(imageWait, node, "before");
				}
			});
	};
		
	window.imageLoaded = function(node){
		if(domClass.contains(node, "hoverImg")){
			fitIn(node);
			query(node)
				.style("top", "0px")
				.style("left", "0px");
		}
		style.set(node, "display", "inline-block");
		construct.destroy(query(node).prev(".imageWait")[0]);
	};
});

window.onDomReady[window.onDomReady.length] = "imageLoader";