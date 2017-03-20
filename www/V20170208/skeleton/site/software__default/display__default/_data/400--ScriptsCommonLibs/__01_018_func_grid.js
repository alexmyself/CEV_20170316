//Sets items outer width and spacing to fill parent with n number items by line
// css string itemsSelector
// int itemsByLine
// float 16/9 or whatever to size the height of items.
// float spaceX left margin in pixels.
// float spaceY.
// float correction, available width will be parent inner width - correction (ex: scrollbar width).

grid=function(itemsSelector, itemsByLine, ratioWH , spaceX, spaceY, correction){
	//No element matching, exit.
	if(!nodeExist(itemsSelector)){return false;}

	obj={
		ratio:1,
		xMargin:0, xWidth:0,
		yMargin:0, yWidth:0,
		minus:0
	};

	if(ratioWH	!== undefined)	{ obj.ratio 	=ratioWH;	}
	if(spaceX	!== undefined)	{ obj.xMargin 	=spaceX;	}
	if(spaceY 	!== undefined)	{ obj.yMargin 	=spaceY;	}
	else						{ obj.yMargin 	=obj.xMargin;	}
	if(correction	!== undefined)	{ obj.minus 	=correction;	}

	var nodes=dojo.query(itemsSelector);
	spaceForAllItems = geoHelper.get.wI( nodes.first().parents('div').first() ) - obj.minus;
	spaceForOneItem = spaceForAllItems / itemsByLine;
	spaces = itemsByLine+1;
	marginTotalForOne = obj.xMargin + (obj.xMargin / spaces);
	obj.xWidth = spaceForOneItem - marginTotalForOne;
	obj.yWidth = obj.xWidth / obj.ratio;

	nodes.style({marginLeft:'0', marginTop:'0'});
	geoHelper.set.wO(nodes, obj.xWidth);
	geoHelper.set.hO(nodes, obj.yWidth);
	nodes.style( {marginLeft: obj.xMargin+'px', marginTop: obj.yMargin+'px'});
};