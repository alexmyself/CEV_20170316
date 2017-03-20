require(["dojo/query", "dojo/ready", "dojo/NodeList-traverse"], function(query, ready){
	window.imageReady = function(node){

	
//require(["dojo/ready"], function(ready){
//	ready( function(){
ready( function(){

		var container = query(node).parent()[0];
		query(container).children(".wait").style("display", "none");

		query(container).children(".image").style("display", "block");
		fitIn(node);		
//		});});	
});



		
		
	}
});