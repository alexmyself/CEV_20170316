imageReady.stack(function(nodeList){
	for(var i=0;i<nodeList.length;i++){
/*		var node=dojo.query(nodeList[i]);
		var container = node.closest('span, div')[0];
		node.prev('.wait').style('display', 'none');
		node.style({
			'visibility':'hidden',
			'display':'inline-block',
			'top':'0px',
			'left':'0px'
		});
*/		fitIn(nodeList[i]);
/*		node.style('visibility', 'visible');
*/	}
});

imageReady.onVarAdd=function(node){this.play({items:[node]});}