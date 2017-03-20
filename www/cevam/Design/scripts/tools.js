//_____Tools Functions_______________________________________________
//___________________________________________________________________
function moteurAffichage(dataArrObj, modeleStr, container){
	var modeleFinal = new String();
	//Pour chaque item:
	for (var itemObj in dataArrObj){
		var modeleVierge = modeleStr;
		//Pour chaque propriétés de l'item:
		for(var itemProp in dataArrObj[itemObj]){
			var valeur = dataArrObj[itemObj][itemProp]
			if(typeof(valeur) != 'object'){
				modeleVierge = replaceText(modeleVierge, itemProp, valeur);
				}
			else{
				var startTag = '__'+itemProp+'Start__';
				var startRegexp = new RegExp('.*'+startTag,'g');
				var subObjModel = modeleVierge.replace(startRegexp,'');
				var stopTag = '__'+itemProp+'Stop__';
				var stopRegexp = new RegExp(stopTag+'.*','g');
				subObjModel = subObjModel.replace(stopRegexp,'');
				var subBloc = new String();
				for (var i in valeur){
					subBloc += replaceText(subObjModel, itemProp, valeur[i]);
					}
				var subRegexp = new RegExp(startTag+'.*'+stopTag,'g');
				modeleVierge = modeleVierge.replace(subRegexp, subBloc);
				}
			}
		modeleFinal += modeleVierge;
		}
	require(["dojo/dom-construct"], function(domConstruct){
		domConstruct.place(modeleFinal, container);
		});
	}

function replaceText(chaineOriginale, motif, remplacant){
	var regExp = new RegExp('__'+motif+'__', 'g');
	var newText = chaineOriginale.replace(regExp, remplacant); 
	return newText;
	}
	
function show(id){
	node = document.getElementById(id);
	if (node.style.display == 'none'){
		node.style.display = '';}
	else{node.style.display = 'none';}
	}