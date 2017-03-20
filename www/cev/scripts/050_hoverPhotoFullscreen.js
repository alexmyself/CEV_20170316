require(["dojo/dom", "dojo/query", "dojo/on", "dojo/window", "dojo/_base/window", "dojo/dom-attr", "dojo/dom-geometry", "dojo/dom-construct", "dojo/NodeList-traverse", "dojo/NodeList-manipulate"], function(dom, query, on, win, baseWin, domAttr, domGeom, construct){
	window.hoverPhotoFullscreen = function(node){
		function createIt(){
			var box = win.getBox();
			var bigNode = construct.create("div", {id:"hoverPhotoFs",
				style:{
					width:window.winW+"px",
					height:window.winH+window.scrollbarWidth+"px",
					position:"absolute",
					top:box.t+"px"
				}});
			construct.place(bigNode, baseWin.body(), "first");
			query("#hoverPhotoFs")
				.style("zIndex","100")
				.style("backgroundColor","black")
				.style("cursor","pointer");

			var bigImg = construct.create("img", {id:"hpf"});
			construct.place(bigImg, "hoverPhotoFs", "first");
			on(bigNode, "click", function(evt){hoverPhotoFullscreen("hpf");});
			domAttr.set(bigImg, "src", domAttr.get(node, "src"));
			fitIn("#hpf");
		}
		function killIt(){
			construct.destroy(dom.byId("hoverPhotoFs"));
		}

		if(dom.byId("hoverPhotoFs") == null){createIt();}
		else if(domAttr.get("hpf", "src") == domAttr.get(node, "src")){killIt();}
		else{
			killIt();
			createIt();
		}
	};
});


require(["dojo/query"], function(query){
	window.loadhoverPhotoFullscreen = function(){
		query(".photo").on("click", 
			function(evt){hoverPhotoFullscreen(evt.target);
			}
		);
	};
});
		
		
window.onDomReady[window.onDomReady.length] = "loadhoverPhotoFullscreen";