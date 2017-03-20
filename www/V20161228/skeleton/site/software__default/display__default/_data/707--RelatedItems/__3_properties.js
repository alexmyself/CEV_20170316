/*_____RelatedItems Properties*/
surfaces.relatedItems={
	w 		: 0,
	h 		: 0,
	itemsNumber	: 8,
	math 	: function(){ this.w=surfaces.display.w; }
};
surfaces.stack(function(nodesList, parent){surfaces.relatedItems.math();});