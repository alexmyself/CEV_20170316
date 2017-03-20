require(["dojo/query", "dojo/NodeList-traverse"],function(query){
	window.GEOMETRY=function(){
		var baseSize;
		if(window.winW >= 1.78*window.winH){baseSize = window.winH;}
		else{baseSize = 0.56*window.winW;}
		var logoH = baseSize/10;
		query("#logo").style("height", logoH+"px");
		query(".halfWindow").style("width", window.winW/2+"px");
		query(".thirdWindow").style("width", window.winW/2.5+"px");
		var textNorm = baseSize/45;
		var textTitre = textNorm*1.8;
		var winWScroll = window.winW - window.scrollbarWidth;

		query("#enTete").style("width", window.winW+"px");

		query(".container").style("width", winWScroll+"px");
		query(".containerContenuRubrique").style("borderWidth", textNorm/3+"px");
		query(".containerContenuRubrique").forEach(function(node){
			query(node).style("width", winWScroll-2*query(node).style("borderLeftWidth")+"px");
		})

		window.sizeText("*", textNorm);
		window.sizeText(".textLogo", logoH/3);
		window.sizeText(".titre", textTitre);

		query(".surfaceContenu").style("width", winW+"px");
		query(".surfaceContenu").style("height", window.winH-query("#enTete").style("height")+"px");
		query(".surfaceContenu").style("overflow", "auto");
		query(".bgContenu").style("width", query(".surfaceContenu").style("width")+"px");
		query(".bgContenu").style("height", query(".surfaceContenu").style("height")+"px");
		window.fitIn(query(".bgContenu img"));
		query(".bgContenu img").style("opacity", "0.3");
		
		query(".containerTitreRubrique img").style("height", "0px");
		query(".containerTitreRubrique").forEach(function(node){
			query(node).children("img").style("height", query(node).style("height")+"px");
		});
		query(".background").style("opacity", 0.3);
		query(".bgSousCouche").style("opacity", 0.8);
		query(".containerTextRubrique").style("marginTop", query(".titre").first().style("height")+"px");
		query(".containerTextRubrique").style("marginLeft", query(".titre").first().style("fontSize"));
		query(".containerTextRubrique").style("width",
			query(".containerContenuRubrique").first().style("width")
			-query(".containerImgRubrique").first().style("width")
			-query(".containerTextRubrique").first().style("marginLeft")*2+"px"); 
		query(".containerImgRubrique img").style("maxHeight", logoH+"px");
		query(".containerImgRubrique img").style("maxWidth", query(".containerImgRubrique").first().style("width")+"px");

		query(".tableauInfo tr:nth-child(odd)").addClass("bgBlue2");
		query(".tableauInfo tr:nth-child(even)").addClass("bgWhite");
		query(".tableauInfo tr:nth-child(1)").style("backgroundColor","blue");
		query(".tableauInfo tr:nth-child(1)").style("color","white");
	};
});