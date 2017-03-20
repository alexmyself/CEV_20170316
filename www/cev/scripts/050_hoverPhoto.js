require(["dojo/query", "dojo/dom-attr", "dojo/mouse", "dojo/dom-style", "dojo/NodeList-traverse", "dojo/NodeList-manipulate"], function(query, domAttr, mouse, style){
	window.hoverPhoto = function(node){
		var target = query(node).parent().siblings(".containerHoverImg").children(".hoverImg")[0];
		var neWpath = domAttr.get(node, "src");
		if(neWpath == domAttr.get(target, "src")){return;}
		domAttr.set(target, "src", neWpath);
//alert("hoverPhoto");
		fitIn(target, 0, 0);
		style.set(target, "top", "0px");
		style.set(target, "left", "0px");
	};
});

require(["dojo/query", "dojo/mouse"], function(query, mouse){
	window.loadhoverPhoto = function(){
		query(".photo").on(mouse.enter, function(evt){hoverPhoto(evt.target);});
	};
});

window.onDomReady[window.onDomReady.length] = "loadhoverPhoto";