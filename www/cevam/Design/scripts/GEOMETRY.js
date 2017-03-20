require(["dojo/dom-style", "dojo/query", "dojo/NodeList-dom", "dojo/NodeList-traverse", "dojo/NodeList-manipulate"], function(style, query){
	window.GEOMETRY = function(){
		query("body").style("visibility", "hidden");
		var surfaceH = winH;
		var surfaceW = winW;
		
		
		var bottomBarH = Math.floor(surfaceH/5);
		var leftBarH = surfaceH-bottomBarH;
		var leftBarItemsNumber = 7;
		var leftBarInitialBorder = leftBarH/leftBarItemsNumber/20;
		var leftBarW = Math.floor(  (leftBarH-(leftBarItemsNumber+1)*leftBarInitialBorder)/leftBarItemsNumber*(window.winW/window.winH)  );		
		var bottomBarW = surfaceW-leftBarW;

		var bottomBarInitialBorder = bottomBarH/25;
		var bottomBarIconeSurfaceW = 1.33*bottomBarH-2*bottomBarInitialBorder;
		var bottomBarIconeSurfaceH = bottomBarH-2*bottomBarInitialBorder;

		var leftBarIconeSurfaceW = leftBarW-2*leftBarInitialBorder;
		var leftBarIconeSurfaceH = (leftBarH-(leftBarItemsNumber+1)*leftBarInitialBorder)/leftBarItemsNumber;


		//__Surface__________________________________________________		
		style.set("surface","width",surfaceW+"px");
		style.set("surface","height",surfaceH+"px");
		
		query("#surfaceBgContainer").style("width", surfaceW-leftBarW+"px");
		query("#surfaceBgContainer").style("height", surfaceH-bottomBarH-style.get("inputRecherche", "height")+"px");
		query("#surfaceBgContainer").style("left", leftBarW+"px");
		query("#surfaceBgContainer").style("top", style.get("inputRecherche", "height")+"px");
		
		query('#surfaceContent').innerHTML("surface: "+surfaceW+" x "+surfaceH);

		

		//__Onglet__________________________________________________
		query(".ongletTitle").style("height", style.get("inputRecherche", "height")+"px");
		style.set("ongletSpacer","left", window.getRight("ongletArticles")+"px");
		style.set("ongletSelection","left", window.getRight("ongletSpacer")+"px");
		style.set("ongletSpacer2","left", window.getRight("ongletSelection")+"px");
		style.set("inputRecherche", "left", window.getRight("labelRecherche")+"px");
		style.set("ongletRecherche", "width", style.get("labelRecherche", "width")+style.get("inputRecherche", "width")+"px");
		style.set("ongletRecherche","left", window.getRight("ongletSpacer2")+"px");
		var widthx = style.get("ongletArticles","width")+ style.get("ongletSpacer","width")+ style.get("ongletSelection","width")+ style.get("ongletSpacer2","width")+ style.get("ongletRecherche","width");
		style.set("ongletContainer","left", winW - widthx+"px");
		style.set("ongletContainer","width", widthx+"px");
		style.set("ongletContainer","height", style.get("inputRecherche", "height")+"px");



		//__LeftBar__________________________________________________
		style.set("leftBar","width",leftBarW+"px");
		style.set("leftBar","height",leftBarH+"px");


		style.set("leftBarBg","opacity",0.5);
		style.set("leftBarBg","left","0px");
	
		query(".leftBarIconeSurface").style("width", leftBarIconeSurfaceW+"px");
		query(".leftBarIconeSurface").style("height", leftBarIconeSurfaceH+"px");
		query(".leftBarIconeSurface").style("marginTop", leftBarInitialBorder+"px");
		query(".leftBarIconeSurface").style("marginLeft", leftBarInitialBorder+"px");
				
		fitIn(".leftBarIconeContainer", 1.2*leftBarInitialBorder, 1.2*leftBarInitialBorder);
		

		//__BottomBar__________________________________________________
		style.set("bottomBar","width",bottomBarW+"px");
		style.set("bottomBar","height",bottomBarH+"px");
		style.set("bottomBar","top",(surfaceH-bottomBarH)+"px");	
		style.set("bottomBar","left",leftBarW+"px");
		window.bottomBar.t = style.get("bottomBar", "top");
		window.bottomBar.l = style.get("bottomBar", "left");
		window.bottomBar.w = style.get("bottomBar", "width");
		window.bottomBar.h = style.get("bottomBar", "height");
		
		style.set("bottomBarBg","opacity", window.bottomBar.o);
		
		query(".bottomBarIconeSurface").style("width", bottomBarIconeSurfaceW+"px");
		query(".bottomBarIconeSurface").style("height", bottomBarIconeSurfaceH+"px");
		query(".bottomBarIconeSurface").style("top", bottomBarInitialBorder+"px");
		query(".bottomBarIconeSurface").style("left", bottomBarInitialBorder+"px");

		fitIn(".bottomBarIconeContainer", bottomBarInitialBorder*1.2, bottomBarInitialBorder*1.2);

		var iconControlSize = 4*bottomBarInitialBorder;
		query(".iconControlContainer").style("width", iconControlSize+"px");
		query(".iconControlContainer").style("height", iconControlSize+"px");

		var iconControlSpace = bottomBarInitialBorder/2;
		style.set("iconControl2", "left", iconControlSize+iconControlSpace+"px");
		style.set("iconControl","left", bottomBarW-2*iconControlSize-bottomBarInitialBorder/2-iconControlSpace+"px");
		style.set("iconControl","top", bottomBarInitialBorder/2+"px");
		//fitIn(".iconControlContainer img");

		
		
		//__Vignettes__________________________________________________
		style.set("vignettes", "width", surfaceW-leftBarW+"px");
		style.set("vignettes", "height", surfaceH-style.get("ongletContainer", "height")+"px");
		style.set("vignettes", "left", leftBarW+"px");
		style.set("vignettes", "top", style.get("ongletContainer", "height")+"px");
		
		fitIn(".vignetteContainerImg", 20, 20);
		
		
		query("body").style("visibility", "visible");
		}
	});
	

	
	
	
	
	
	


		