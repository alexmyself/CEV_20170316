homoHeightLabel= function(containerSelector){
	var nodes;
	if( !(nodes=dojo.query(containerSelector+' .itemContainer')) ){return false;}

	nodes.children('.labelContainer').style({
		'display': '',
		'width':'100%'
	});
	dojo.query(containerSelector+' .label').style({
		'height': '',
		'width':'100%'
	});
	nodes.children('.labelContainer').style({'height': ''});
	geoHelper.set.hO(containerSelector+' .itemContainer .labelContainer', geoHelper.get.max.h(containerSelector+' .itemContainer .label') + parseFloat(dojo.query(containerSelector+' .itemContainer .labelContainer .border').first().style('borderBottomWidth')) );
};