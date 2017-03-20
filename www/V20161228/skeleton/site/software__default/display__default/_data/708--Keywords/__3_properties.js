/*_____SparesParts Properties*/
surfaces.keywords={
	textHMultiplier: 1/100,
	textH: 0,
	bgOpacity: 0.5,
	math 	: function(){
		this.textH= this.textHMultiplier * surfaces.display.w;
	}
};
surfaces.stack(function(nodesList, parent){surfaces.keywords.math();});