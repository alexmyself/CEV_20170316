gallery.stack( function(itemsArr){
	if(itemsArr == undefined){return false;}
	for(var i=0; i<itemsArr.length; i++){
		var nodeIn 		= dojo.query(itemsArr[i].nodeIn);
		var nodeOut 	= dojo.query(itemsArr[i].nodeOut);
		var nodeImg 	= nodeOut.query('img');

		nodeImg.attr('src', nodeIn.attr('src')[0] );
		nodeOut.style('display', 'block');
		fitIn(nodeImg);
	}
});