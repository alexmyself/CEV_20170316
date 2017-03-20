/*_____ItemContainer Properties*/
//Values used in the itemContainer function, an object with replacement values can be sent to the function, filled with all values or only partially filled.
//ItemContainerInnerGeometry=function('#selector', overidingValues{'textH': '35', 'bgOpacity': '0.5'})
surfaces.itemContainer={
	boxW 						:0, //Not used, a div wich has size and contains .itemContainer thing.
	boxH 						:0,

	containerW 					:false, //Make this different of boxW to get space for some additional decoration if needed (arrows on navigation links for ex.).
	containerH 					:false,

	bgOpacity 					: surfaces.opacityMin,
	bgHoverOpacity 				: surfaces.opacityMin2,
	borderWidth 				: surfaces.borderMin,
	borderType 					: 'solid',
	borderColor 				: 'black',
	borderHoverWidth 			: surfaces.borderMin,
	borderHoverType 			: 'solid',
	borderHoverColor 			: 'black',

	labelBgOpacity 				: 1,
	labelBgHoverOpacity 		: 1,
	labelBorderTopWidth 		: 0,
	labelBorderBottomWidth 		: 0,
	labelBorderLeftWidth 		: 0,
	labelBorderRightWidth 		: 0,
	labelBorderType 			: 'solid',
	labelBorderColor 			: 'black',
	labelBorderHoverWidth 		: surfaces.borderMin,
	labelBorderHoverTopWidth 	: 0,
	labelBorderHoverBottomWidth : surfaces.borderMin,
	labelBorderHoverLeftWidth 	: 0,
	labelBorderHoverRightWidth 	: 0,
	labelBorderHoverType 		: 'solid',
	labelBorderHoverColor 		: 'red',
	labelTextH 					: 1/15,
	labelTextAdsH 				: 1/15,

	imageBgOpacity 				: 0,
	imageBgHoverOpacity 		: 1,
	imageBorderWidth 			: 0,
	imageBorderType 			: 'solid',
	imageBorderColor 			: 'black',
	imageBorderHoverWidth 		: 0,
	imageBorderHoverType 		: 'solid',
	imageBorderHoverColor 		: 'blue',
	imageMarginTop 				: surfaces.stdMargin,
	imageMarginLeft 			: surfaces.stdMargin,

	infoBgOpacity 				: 1,
	infoBgHoverOpacity 			: 1,
	infoBorderWidth 			: 0,
	infoBorderType 				: 'solid',
	infoBorderColor 			: 'black',
	infoBorderHoverWidth 		: surfaces.borderMin,
	infoBorderHoverType 		: 'solid',
	infoBorderHoverColor 		: 'red',
	infoTextH 					: 1/15*0.8,
	infoMarginTop 				: surfaces.stdMargin,
	infoMarginLeft 				: surfaces.stdMargin,

	math 	: function(){
		this.borderWidth 			= surfaces.borderMin;
		this.borderHoverWidth 		= surfaces.borderMin;
		this.labelBorderHoverWidth 	= surfaces.borderMin;
		this.infoBorderHoverWidth 	= surfaces.borderMin;
		
		this.imageMarginTop 		= surfaces.stdMargin;
		this.imageMarginLeft 		= surfaces.stdMargin;
		this.infoMarginTop 			= surfaces.stdMargin;
		this.infoMarginLeft 		= surfaces.stdMargin;
	}
};
surfaces.stack(function(nodesList, parent){surfaces.itemContainer.math();});