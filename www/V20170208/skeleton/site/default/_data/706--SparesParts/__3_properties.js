/*_____SparesParts Properties*/
surfaces.sparesParts={
	w 		: 0,
	h 		: 0,
	textHMultiplier: 1/80,
	textH: 0,
	itemsNumber	: 8,
	math 	: function(){
		this.w=surfaces.display.w;
		this.textH= this.textHMultiplier * surfaces.display.w;
	}
};
surfaces.stack(function(nodesList, parent){surfaces.sparesParts.math();});