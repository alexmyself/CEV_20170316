require(["dojo/dom-style", "dojo/query", "dojo/dom-geometry", "dojo/dom", "dojo/NodeList-dom", "dojo/NodeList-traverse", "dojo/NodeList-manipulate"], function(style, query, domGeom, dom){
	window.GEOMETRY = function(){
		query('body').style({
			'visibility': 'hidden',
			'width': window.winW+'px',
			'height': window.winH+'px'
		
		});
		var stdMargin = window.winHCorrected/190;
		var imgRatio = 9/6;

	
		var bottomBarH = window.winHCorrected/5;
		var centralH = window.winH-bottomBarH;
		var centralW = window.winW;

		var bottomBarIconeSurfaceH = bottomBarH-2*stdMargin;
		var bottomBarIconeSurfaceW = imgRatio*bottomBarIconeSurfaceH;

//		var leftBarIconeSurfaceW = leftBarW-2*stdMargin;
//		var leftBarIconeSurfaceH = ((window.winHCorrected-bottomBarH)-(leftBarItemsNumber+1)*stdMargin)/leftBarItemsNumber;


		

		//__Surface__________________________________________________		
		style.set('surface',{
			'width':window.winW+'px',
			'height':window.winH+'px'
		});
		
		style.set('surfaceBgContainer',{
			'width':centralW+'px',
			'height':centralH+'px',
			'left':0+'px',
			'top':0+'px'
		});
		query('#surfaceContent').innerHTML('surface: '+window.winW+' x '+window.winHCorrected);

		
/*
		//__Onglet__________________________________________________
		query('.ongletTitle').style('display', 'inline-block');
		query('.ongletTitle').style('position', 'relative');
		style.set('ongletContainer', 'height', ongletH+'px');
		window.widthx=0;
		query('#ongletContainer').children().forEach(function(node, index, nodelist){
			window.widthx += domGeom.getMarginBox(node).w;//parseFloat(style.get(node, 'width'));
		});
		
		style.set('ongletContainer', 'left', window.winW-window.widthx-1+'px');
*/

/*
		//__LeftBar__________________________________________________
		style.set("leftBar",{
			'width':leftBarW+'px',
			'height':centralH+ongletH+'px',
			'left':'0px'
		});
		style.set("leftBarBg",{'opacity':'0.5'});
	
		query('.leftBarIconeSurface').style({
			'width': leftBarIconeSurfaceW+'px',
			'height': leftBarIconeSurfaceH+'px',
			'marginTop': stdMargin+'px',
			'marginLeft': stdMargin+'px'
		});
		fitIn(".leftBarIconeContainer", 1.2*stdMargin, 1.2*stdMargin);
*/		

		//__BottomBar__________________________________________________
		style.set("bottomBar",{
			'width':centralW+'px',
			'height':bottomBarH+'px',
			'top':(window.winH-bottomBarH)+'px',
			'left':0+'px'
		});
		window.bottomBar.t = window.winH-bottomBarH;
		window.bottomBar.l = 0;
		window.bottomBar.w = centralW;
		window.bottomBar.h = bottomBarH;
		
		style.set('bottomBarBg','opacity', window.bottomBar.o);
		
		query(".bottomBarIconeSurface").style({
			'width': bottomBarIconeSurfaceW+'px',
			'height': bottomBarIconeSurfaceH+'px',
			'top': stdMargin+'px',
			'left': stdMargin+'px'
		});
		fitIn('.bottomBarIconeContainer', stdMargin*1.2, stdMargin*1.2);
		
		var iconControlSize = 4*stdMargin;
		query('.iconControlContainer').style({
			'width': iconControlSize+'px',
			'height': iconControlSize+'px'
		});
		
		var iconControlSpace = stdMargin/2;
		style.set("iconControl2", "left", iconControlSize+iconControlSpace+"px");
		style.set("iconControl",{
			'left': centralW-2*iconControlSize-stdMargin/2-iconControlSpace+'px',
			'top': stdMargin/2+'px'
		});
	
		style.set('bottomBarTitle',{
			'width': window.getLeft('iconControl')-window.getRight('bottomBarIconeSurface')-2*stdMargin+'px',
			'left': window.getRight('bottomBarIconeSurface')+stdMargin+'px',
			'top': stdMargin+'px'
			
		});
		window.sizeText('#bottomBarTitle', 0.3*bottomBarIconeSurfaceH);
	
		style.set('bottomBarResume',{
			'left': window.getRight('bottomBarIconeSurface')+stdMargin+'px',
			'top': window.getBottom('bottomBarTitle')+'px',
			'width': window.getLeft('iconControl')-window.getLeft('bottomBarResume')+'px'
		});
		window.sizeText('#bottomBarResume', iconControlSize);
		
		
		//__Vignettes__________________________________________________
		style.set("vignettes",{
			'width': centralW+'px',
			'height': centralH+'px',
			'left': 0+'px',
			'top': 0+'px',
			'overflow': 'auto'
		});

		var gridVignetteW=3;
		var gridVignetteH=5;
//		query('.surfaceVignette').style({borderWidth:stdMargin+'px', borderStyle:'solid'});
		var SW = window.setWidth('.surfaceVignette', (window.winWCorrected-window.scrollbarWidth)/gridVignetteW);
		var SH = window.setHeight('.surfaceVignette', SW*(1/imgRatio));//(window.winHCorrected-bottomBarH)/gridVignetteH);
		query('.surfaceVignette').style({
			'width': SW+'px',
			'height': SH+'px'
		});
		fitIn(".vignetteContainerImg", 1, 1);
		
		fitIn('.image');
		
		query("body").style("visibility", "visible");
		}
	});
