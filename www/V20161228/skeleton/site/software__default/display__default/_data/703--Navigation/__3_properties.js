/*_____Navigation Properties*/
surfaces.navigation={
	w 		: 0,
	h 		: 0,
	itemsNumber	: 14,
	bgOpacity	: 0,
	labelTextH 	: 0.13,
	labelBgOpacity 	: 0.8,
	math 	: function(){
		this.w=surfaces.display.w;
		this.h=(this.w / this.itemsNumber) / surfaces.ratio;
	}
};
surfaces.stack(function(nodesList, parent){surfaces.navigation.math();});