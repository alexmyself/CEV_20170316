/*_____AskedPAge Properties*/
surfaces.askedPage={
	w 							: 0,
	titleH 						: 0,
	galleryH 					: 0,
	borderMultiplier 			: 0.8,
	borderBase 					: 0,
	bgTitleOpacity				: 1,
	bgResumeOpacity				: 0.9,
	marginBottom 				: 0,
	marginBottomMultiplier 		: 40,
	marginInnerContent 			: 0,
	marginInnerContentMultiplier: 3,


	math 	: function(){
		this.w=surfaces.display.w;
		this.titleH=surfaces.stdMargin*7;
		this.galleryH=this.titleH*4;
		this.borderBase = surfaces.stdBorder * this.borderMultiplier;
		this.marginBottom= this.marginBottomMultiplier * surfaces.stdMargin;
		this.marginInnerContent= this.marginInnerContentMultiplier * surfaces.stdMargin;
	}
};
surfaces.stack(function(nodesList, parent){surfaces.askedPage.math();});