// Math and hold main sizes
surfaces.unit='px';//mm
surfaces.stdMargin=0;
surfaces.stdBorder=0;
surfaces.borderMin=1;
surfaces.fontBase=1;
surfaces.fontMinHeightMm=2.5;
surfaces.fontMinHeightPx=null; //Will be set in sizeText() at first call.
surfaces.fontHeightList=null; //Will be set in sizeText() at first call.
surfaces.ratio= 1.5/1; //20/9;
surfaces.imgRatio=12/7;
surfaces.a4Ratio=Math.sqrt(2);
surfaces.opacityMin=0.85;
surfaces.opacityMin2=0.8;
surfaces.opacity1=0.1;


surfaces.screen={
	w 					: 0,
	h 					: 0,
	lastW 				: 0,
	lastH 				: 0,
	orientationChanged 	: false,
	math 			:function(parent){
		this.lastW=this.w;
		this.lastH=this.h;
		this.w= parseFloat(dojo.win.getBox().w);
		this.h= parseFloat(dojo.win.getBox().h);
		if(this.lastW==this.w ){ parent.stopPlay=true; }
		if( this.lastW > this.lastH){var lastOrientation= "landscape";}
		else{var lastOrientation= "portrait";}
		if( this.w > this.h){var orientation= "landscape";}
		else{var orientation= "portrait";}
		if(orientation != lastOrientation){
			surfaces.fontMinHeightPx=null;
			surfaces.fontHeightList=null;
			this.orientationChanged=true;
		}
		else{this.orientationChanged= false;}
	}
};
surfaces.stack(function(nodesList, parent){surfaces.screen.math(parent);});


surfaces.scrollBar={
	w 	: 0,
	h 	: 0,
	math 	: function(){
		if(this.w==0){
			var tmp = dojo.construct.create('div', {style:{width:'100px', height:'100px', position:'absolute', overflow:'scroll'}}, dojo.baseWin.body());
			this.w = parseFloat(tmp.offsetWidth) - parseFloat(tmp.clientWidth);
			dojo.construct.destroy(tmp);
		}
	}
};
surfaces.stack(function(nodesList, parent){surfaces.scrollBar.math();});


surfaces.math=function(){ 
	this.stdMargin=this.screen.w/350;
	this.stdBorder= this.stdMargin;
};
surfaces.stack(function(nodesList, parent){surfaces.math();});