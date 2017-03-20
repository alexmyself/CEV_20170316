
//displaySwitch.on 	=function(nodesListArray){ for(var i=0;i<nodesListArray.length;i++){ dojo.array.forEach(nodesListArray[i], function(item){dojo.style.set(item, 'display', 'block' 	);});}};
displaySwitch.on 	=function(nodesListArray){ for(var i=0;i<nodesListArray.length;i++){ nodesListArray[i].style('display', 'block'); }};
displaySwitch.off 	=function(nodesListArray){ for(var i=0;i<nodesListArray.length;i++){ nodesListArray[i].style('display', 'none'); }};

displaySwitch.populate = function(){this.stack(dojo.query('.displaySwitch'))};