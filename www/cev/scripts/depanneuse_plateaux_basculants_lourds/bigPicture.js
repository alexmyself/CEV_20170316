require(["dojo/dom", "dojo/query", "dojo/on", "dojo/window", "dojo/_base/window", "dojo/dom-attr", "dojo/dom-geometry", "dojo/dom-construct", "dojo/NodeList-traverse", "dojo/NodeList-manipulate"], function(dom, query, on, win, baseWin, domAttr, domGeom, construct){
	window.bigPicture = function(node){
		var nEnv = function(nodeX){
			this.container= query(nodeX).parents(".container").first();
			this.containerImg= query(this.container).children(".containerImg");
			this.photos= query(this.containerImg).children(".photo");
			this.titre= query(this.container).children(".titre")[0];
			};
		var nodeEnv = new nEnv(node);
		if(dom.byId("bigPicture") != null){ var bigEnv = new nEnv(dom.byId("bigPicture"));}

		function killIt(){
			query(bigEnv.photos).style("height", "150px");
			query(bigEnv.containerImg).style("top", "0px");
			construct.destroy(dom.byId("bigPicture"));
		}
		function createIt(){
			var titreH = domGeom.position(nodeEnv.titre, false).h;
			var height1 = window.winH - titreH;
			var bigNode = construct.create("div", {id:"bigPicture",
				style:{
					width:window.winW+"px",
					height:height1+"px"
				}});
			construct.place(bigNode, nodeEnv.titre, "after");
			query("#bigPicture").style("backgroundColor","black");
			query("#bigPicture").style("zIndex","-1");
			query("#bigPicture").style("cursor","pointer");
			var bigImg = construct.create("img", {id:"bigImg"}, "bigPicture", "first");
			on(bigNode, "click", function(evt){bigPicture(evt.target);});
			domAttr.set(bigImg, "src", domAttr.get(node, "src"));
			fitIn("#bigImg");

			query(nodeEnv.photos).style("height", "60px");
			query(nodeEnv.containerImg).style("top", "-"+(height1+titreH)+"px");
			win.scrollIntoView(dom.byId("bigPicture"));
			win.scrollIntoView(nodeEnv.titre);			
		}
		
		if(dom.byId("bigPicture") == null){	createIt();}
		else if(domAttr.get(node, "id") == "bigPicture"){killIt();}
		else if(domAttr.get(node, "src") == domAttr.get(dom.byId("bigImg"), "src")){killIt();}
		else{
			killIt();
			createIt();			
		}
	};
});


require(["dojo/query"], function(query){
	window.loadBigPicture = function(){
		query(".photo").on("click", 
			function(evt){bigPicture(evt.target);
			}
		);
	};
});
		
		
window.onDomReady[window.onDomReady.length] = "loadBigPicture";