/*_____Content Properties*/
/*
surfaces.content={
	w 		: 0,
	h 		: 0,
	itemsNumber	: 4,
	gridTop 	: 0,
	gridLeft 	: 0,
	bgOpacity	: 0,
	itemsImageMarginTop : 3*surfaces.stdMargin,
	itemsImageMarginLeft : 3*surfaces.stdMargin,
	math 	: function(){
		this.w=surfaces.display.w;
		this.gridLeft=surfaces.stdMargin*4;
		this.gridTop=surfaces.stdMargin*5;
		this.itemsImageMarginTop = 3*surfaces.stdMargin;
		this.itemsImageMarginLeft = 3*surfaces.stdMargin;
	}
};
surfaces.stack(function(nodesList, parent){surfaces.content.math();});
*/



surfaces.content={
	w 						: 0,
	h 						: 0,
	itemsNumber				: 4,
	itemsRatio 				: 0,
	itemsRatioMultiplier 	: 0.45,
	gridTop 				: 0,
	gridTopMultiplier 		: 5,
	gridLeft 				: 0,
	gridLeftMultiplier 		: 4,
	bgOpacity				: 0,
	itemsImageMarginTop : 3*surfaces.stdMargin,
	itemsImageMarginTopMultiplier : 3,
	itemsImageMarginLeft : 3*surfaces.stdMargin,
	itemsImageMarginLeftMultiplier : 3,
	math 	: function(){
		this.w=surfaces.display.w;
		this.itemsRatio=this.itemsRatioMultiplier*surfaces.ratio;
		this.gridLeft=this.gridLeftMultiplier*surfaces.stdMargin;
		this.gridTop=this.gridTopMultiplier*surfaces.stdMargin;
		this.itemsImageMarginTop = this.itemsImageMarginTopMultiplier*surfaces.stdMargin;
		this.itemsImageMarginLeft = this.itemsImageMarginLeftMultiplier*surfaces.stdMargin;
	}
};
surfaces.stack(function(nodesList, parent){surfaces.content.math();});
