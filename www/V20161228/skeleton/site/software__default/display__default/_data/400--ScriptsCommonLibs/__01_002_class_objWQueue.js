//Class with queue support:
//	Stacks functions or others via obj.stack(something()) and passes all items to all functions via obj.play();
//	For boot troubles this object has an locked propertie set to true at first. This only avoid play() to run. Set it to false at first volontary run.
//	Will call object.onVarAdd() if the method is defined.
//	Will call object.onFuncAdd() if the method is defined.
//	object.play() can be called with an object as parameter: argObj.items=[item1ToPassToAllFunctions, item2ToPassToAllFunctions] ; argObj.killPlaylist=true;
//	Call with object param: object.play({items:[item1, item2,..], killPlaylist:true, funcs:[funcName1, funcName2, ...]});
//	If killPlaylist is set, then the item's queue will be freed from everything that has been played. Functions queue will stay untouched.
// 	If the parameters object contains 'funcs' array of strings, then the variables will be passed to those names as object members name: object.funcName1(itemFromList1).
function objWQueue(){
	this.playlistFunc 	=[]; //Contains names of functions that have been added to this object.
	this.playlistVar 	=[]; //Contains names of variables that have been added to this object.
	this.locked			=true; //Avoid play calls until this flag is manually set to true, this resolves boot troubles.
						//And mechanism for an external locking.
	this.stopPlay 		=false; //Flag to stop the play loop, accessible from func members.
						//And mechanism for an internal locking. (like when window resize event fires at beginning AND at end of resize, checking size change permit to not do play stuff twice)
	this.parent 		=false; //Access to parent calling this function, parent.stopPlay will be set if a stop occures.
}

objWQueue.prototype.stack=function(itemToAdd){
	if(typeof(itemToAdd)=='function'){var type='Func';}
	else{var type='Var';}
	playlistName				='playlist'+type;
	onAddName					='on'+type+'Add';
	var index 					= this[playlistName].length;
	var itemName 				= 'item_'+playlistName+'_'+index;
	this[itemName] 				=itemToAdd;
	this[playlistName][index] 	=itemName;
	if(typeof(this[onAddName]) == 'function'){this[onAddName](itemToAdd);}
};


objWQueue.prototype.play=function(objArgs){
	if(this.locked==true){return false;}
	this.stopPlay=false;
	this.parent=( (objArgs !== undefined && objArgs.parent !== undefined)? objArgs.parent:this);

	// Get an items list, either from the object itself, or from parameters.
	if(objArgs !== undefined && objArgs.items !== undefined){ var propsList=objArgs.items; }
	else 	{
		var propsList= new Array(); //Need to copy that way, otherwise it's a pointer and can be problematic with killplaylist.
		for(var i=0;i<this.playlistVar.length;i++){propsList[i]=this[this.playlistVar[i]];}
	}

	// Play object functions with items list as arg.
	for(var i=0;i<this.playlistFunc.length;i++){
		if(this.itsOk()==false){break;}
		this[this.playlistFunc[i]](propsList, this);
	}

	// Play named functions if asked in params as funcs[name1, ..].
	if(objArgs !== undefined && objArgs.funcs !== undefined){ for(var i=0;i<objArgs.funcs.length;i++){
		if(this.itsOk()==false){break;}
		this[objArgs.funcs[i]](propsList, this);
	}}

	//Kill playlist when needed
	if(objArgs !== undefined && objArgs.killPlaylist !== undefined){
		for(var i=this.playlistVar.length-1;i>=0;i--){
			delete this[this.playlistVar[i]]; //remove object.propertie
			this.playlistVar.splice(dojo.array.indexOf(this.playlistVar, this.playlistVar[i]) ,1); //remove propertie name from playlistVar
		}
	}
};

objWQueue.prototype.itsOk= function(){
	if(this.stopPlay == false){return true;}
	else{
		this.parent.stopPlay=true;
		return false;
	}
};