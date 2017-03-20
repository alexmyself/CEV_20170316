// Geometry related helper
//	geoHelper.get.t('nodeClass');
//	geoHelper.set.t('nodeClass', value or selector to copy from)
//	geoHelper.set.t('nodeClass', 123);
//	geoHelper.set.t('nodeClass', 'nodeRef');
//	geoHelper.set.wO('myNode').get.wI('oneContainer');
// Get / Set measures and coordinates with a unified method
function lambdaFunc(){ return false;}

function propsMethodList(parent){
	this.t 	=new lambdaFunc();
	this.l 	=new lambdaFunc();
	this.r 	=new lambdaFunc();
	this.wO	=new lambdaFunc();
	this.wI =new lambdaFunc();
	this.hO =new lambdaFunc();
	this.hI =new lambdaFunc();
	this.b =new lambdaFunc();
	this.max =new lambdaFunc();
	this.parent=parent;
}


function classGeoHelper(){
	this.get 	= new propsMethodList(this);
	this.set 	= new propsMethodList(this);
	this.fill 	= new propsMethodList(this);

	this.targetsList 	= false;
	this.targetsFirst 	= false;
	this.modelsList		= false;
	this.modelsFirst	= false;
	this.setList 		= function(selector, listNamePrefix){
		if(!nodeExist(selector)){
			this[listNamePrefix+'List'] 	= false;
			this[listNamePrefix+'First'] 	= false;
			return false;
		}
		else{
			this[listNamePrefix+'List'] 	= dojo.query(selector);
			this[listNamePrefix+'First'] 	= this[listNamePrefix+'List'].first();
//			if(listNamePrefix=='models') {this.modelsFirst.style('display', 'block');}
			return true;
		}
	};
	this.resetList 		= function(listNamePrefix){this[listNamePrefix+'List']=false; this[listNamePrefix+'First']=false;};
	this.tmp 			= false;


	this.set.wO=function(selector, valueOrSelector){this.parent.setter.func(selector, valueOrSelector, 'wO');};
	this.set.hO=function(selector, valueOrSelector){this.parent.setter.func(selector, valueOrSelector, 'hO');};
	this.set.hI=function(selector, valueOrSelector){this.parent.setter.func(selector, valueOrSelector, 'hI');};
	this.set.wI=function(selector, valueOrSelector){this.parent.setter.func(selector, valueOrSelector, 'wI');};
	this.set.l=function(selector, valueOrSelector){this.parent.setter.func(selector, valueOrSelector, 'l');};
	this.set.t=function(selector, valueOrSelector){this.parent.setter.func(selector, valueOrSelector, 't');};

	this.setter={};
	this.setter.parent=this;
	this.setter.func=function(selector, valueOrSelector, prop){
		//selector and value are presents
		if(!this.parent.setList(selector, 'targets')){return false;}
		if(valueOrSelector === undefined){return false;}
		
		// if valueOrSelector is a value
		if(isNaN(valueOrSelector)===false){ this.parent.tmp = valueOrSelector; }
		// else if is a selector
		else if( this.parent.setList(valueOrSelector, 'models') ) {
			if 		(prop == 'wO'){this.parent.tmp = this.parent.get.wO(valueOrSelector);}
			else if (prop == 'hO'){this.parent.tmp = this.parent.get.hO(valueOrSelector);}
			else if (prop == 'wI'){this.parent.tmp = this.parent.get.wI(valueOrSelector);}
			else if (prop == 'hI'){this.parent.tmp = this.parent.get.hI(valueOrSelector);}
			else if (prop == 'l') {this.parent.tmp = this.parent.get.l(valueOrSelector);}
			else if (prop == 't') {this.parent.tmp = this.parent.get.t(valueOrSelector);}
		}
		//No node to copy from and no value provided..out.
		else {return false;}

		if (prop == 'wO'){
			var mL 			= dojo.style.get(this.parent.targetsFirst, 'marginLeft');
			var mR 			= dojo.style.get(this.parent.targetsFirst, 'marginRight');
			var value 		= geoHelper.tmp + mL + mR;
			this.parent.targetsList.forEach( function(item, i){ dojo.geo.setMarginBox(item, { w: value});}, this);
		}
		else if (prop == 'hO'){
			var mT 			= dojo.style.get(this.parent.targetsFirst, 'marginTop');
			var mB 			= dojo.style.get(this.parent.targetsFirst, 'marginBottom');
			var value 		= geoHelper.tmp + mT + mB;
			this.parent.targetsList.forEach( function(item, i){ dojo.geo.setMarginBox(item, { h: value});}, this);
		}
		else if (prop == 'wI'){ this.parent.targetsList.forEach( function(item, i){ dojo.geo.setContentSize(item, {w:this.parent.tmp}); }, this);}
		else if (prop == 'hI'){ this.parent.targetsList.forEach( function(item, i){ dojo.geo.setContentSize(item, {h:this.parent.tmp}); }, this);}
		else if (prop == 'l'){
			var mL= dojo.style.get(this.parent.targetsFirst, 'marginLeft');
			var value= this.parent.tmp - mL;
			this.parent.targetsList.forEach( function(item, i){ dojo.geo.setMarginBox(item, {l: value}); }, this);
		}
		else if (prop == 't'){
			var mT= dojo.style.get(this.parent.targetsFirst, 'marginTop');
			var value= this.parent.tmp - mT;
			this.parent.targetsList.forEach( function(item, i){ dojo.geo.setMarginBox(item, {t: value}); }, this);
		}
		this.parent.resetList('targets');
		this.parent.resetList('models');
	};

//############################################################
	//Fill modelsList and common .get stuff 
	this.get.init = function(selector, action){
		//Nodes lists could already exists if this function is called from inside a geoHelper setter function.
		if(this.parent.modelsList || nodeExist(selector) ){
			var reset=false;
			if(!this.parent.modelsList){
				this.parent.setList(selector, 'models');
				reset=true;
			}
			value=action(this.parent);
 			if(reset==true){this.parent.resetList('models');}
			return value;
		}
		else {return 0;}
	};
//############################################################
	this.get.wO =function(selector){
		action = function(parent){ return dojo.geo.getMarginBox(parent.modelsList[0]).w - dojo.style.get(parent.modelsFirst, 'marginRight') - dojo.style.get(parent.modelsFirst, 'marginLeft');};
		return this.init(selector, action);
	};
//##############################################################
	this.get.wI =function(selector){
		action = function(parent){ return dojo.geo.getContentBox(parent.modelsList[0]).w; };
		return this.init(selector, action);
	};
//############################################################
	this.get.hO =function(selector){
		action = function(parent){ return dojo.geo.getMarginBox(parent.modelsList[0]).h - dojo.style.get(parent.modelsFirst, 'marginTop') - dojo.style.get(parent.modelsFirst, 'marginBottom'); };
		return this.init(selector, action);
		};
//############################################################
	this.get.hI =function(selector){
		action = function(parent){ return dojo.geo.getContentBox(parent.modelsList[0]).h ;};
		return this.init(selector, action);
	};
//############################################################
	this.get.t  =function(selector){
		action = function(parent){ return dojo.geo.getMarginBox(parent.modelsList[0]).t + dojo.style.get(parent.modelsFirst, 'marginTop');};
		return this.init(selector, action);
	};
//############################################################
	this.get.l  =function(selector){
		action = function(parent){ return dojo.geo.getMarginBox(parent.modelsList[0]).l + dojo.style.get(parent.modelsFirst, 'marginLeft');};
		return this.init(selector, action);	
	};
//############################################################
	this.get.r  =function(selector){
		action = function(parent){ return parent.get.l(selector) + parent.get.wO(selector);};
		return this.init(selector, action);	
	};
//############################################################
	this.get.b  =function(selector){
		action = function(parent){ return parent.get.t(selector) + parent.get.hO(selector);};
		return this.init(selector, action);	
	};
//############################################################
	
	
	this.get.max.w=function(selector){ return geoHelper.get.max.func(selector, 'wO');};
	this.get.max.h=function(selector){ return geoHelper.get.max.func(selector, 'hO');};
	this.get.max.t=function(selector){ return geoHelper.get.max.func(selector, 't');};
	this.get.max.l=function(selector){ return geoHelper.get.max.func(selector, 'l');};
	this.get.max.b=function(selector){ return geoHelper.get.max.func(selector, 'b');};
		
	this.get.max.func= function(selector,prop){
		if(!nodeExist(selector)){return false;}
		geoHelper.get.max.tmpFuncName=prop;
		geoHelper.get.max.tmpVal=0;
		dojo.query(selector).forEach(function(item){
			var tmp=geoHelper.get[geoHelper.get.max.tmpFuncName](item);
			if(tmp > geoHelper.get.max.tmpVal){ geoHelper.get.max.tmpVal= tmp;}
		}, this);
		return parseFloat(geoHelper.get.max.tmpVal);
	};

	this.spaceIn=function(itemsSelector, itemLineQty, spaceSelector){
		if(!nodeExist(itemsSelector)){return false;}
		var spaceW=0;
		if(isNaN(spaceSelector)===false){spaceW= spaceSelector;}
		else{spaceW = geoHelper.get.wI(spaceSelector);}
		var itemW = geoHelper.get.wO(itemsSelector);
		var margin = Math.floor( (spaceW - Math.ceil(itemLineQty * itemW) ) / (itemLineQty +1) );
		dojo.query(itemsSelector).style({ 'marginLeft': margin+'px' });
		return parseFloat(margin);
	};
}