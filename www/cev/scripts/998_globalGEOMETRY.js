require(["dojo/query", "dojo/NodeList-traverse"],function(query){
	window.globalGEOMETRY=function(){
		query("#wait").style("display", "block");
		var baseSize;
		if(window.winW >= 1.78*window.winH){baseSize = window.winH;}
		else{baseSize = 0.56*window.winW;}
		var logoH = baseSize/10;
		var textNorm = baseSize/45;
		var textTitre = textNorm*1.5;
		var winWScroll = window.winW - window.scrollbarWidth;

		window.sizeText("*", textNorm);
		window.sizeText(".textLogo", logoH/3);
		window.sizeText(".titre", textTitre);
		
		query("#logo").style("height", logoH+"px");
		query("#enTete").style("width", window.winW+"px");

		var surfContenuW = winW;
		var surfContenuH = winH-query("#enTete").style("height");
		query(".surfaceContenu")
			.style("width", surfContenuW+"px")
			.style("height", surfContenuH+"px");
		query(".bgSurfaceContenu")
			.style("width", surfContenuW+"px")
			.style("height", surfContenuH+"px");
		fitIn(query(".bgSurfaceContenu img"));

		query(".container").style("width", winWScroll+"px");
		query(".containerTitreRubrique img").style("height", textTitre+"px");

		var border = textNorm/3;
		var padding = textNorm*0.5;
		var containerContenuRubriqueAvailW = winWScroll-2*border-2*padding;
		query(".containerContenuRubrique")
			.style("borderWidth", border+"px")
			.style("padding", padding+"px")
			.style("width", containerContenuRubriqueAvailW+"px");

		query(".containerTextRubrique")
			.style("marginRight", padding+"px")
			.style("width", 0.55*containerContenuRubriqueAvailW-padding+"px");

		var containerHoverImgW = Math.round(0.45*containerContenuRubriqueAvailW);
		query(".containerHoverImg")
			.style("width", containerHoverImgW-1+"px")
			.style("height", Math.round((containerHoverImgW-1)*0.56)+"px");
		fitIn(".hoverImg", 0, 0);
		query(".hoverImg")
			.style("top", "0px")
			.style("left", "0px");

		var imgH = 1.3*logoH;
		query(".containerImgRubrique")
			.style("maxHeight", Math.round(2*imgH+padding)+"px")
			.style("width", containerHoverImgW-1+"px");
		query(".containerImgRubrique img")
			.style("maxHeight", imgH+"px")
			.style("marginBottom", padding+"px")
			.style("marginRight", padding+"px");

		query(".background").style("opacity", 0.3);
		query(".bgSousCouche").style("opacity", 0.8);
		
		query(".tableauInfo tr:nth-child(odd)").addClass("bgBlue2");
		query(".tableauInfo tr:nth-child(even)").addClass("bgWhite");
		query(".tableauInfo tr:nth-child(1)")
			.style("backgroundColor","blue")
			.style("color","white");
		
		query("#wait").style("display", "none");
	};
});