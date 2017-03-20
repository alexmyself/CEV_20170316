<?php
function getAncestorsTypes($path){
	#BIG design mistake, occurences have to be updated each for _every_ appearance of an item somewhere as a sub item, it's just impossible to update manually each sub items' occurence for every new tree here or there...
	#PATCH: using path from 'tree' dir and using links to make a set of items to appear somewhere else. (google said 2000char is ok in an url &arg=blabla{2000})
	#So two method: get occurence from file or from path.

	#Il faut appeler les obj parents avec un path car leur nom ne contient plus d'occurence.
	# &path=/id__200100000000000000/content/classement__1__id__200200000000000000

	#if item path if the default one use the default lineage values.
	#No lineage when calling an item directly, regardless of tree (ex.: http://.../xyz.php?path=/id__aDirectNumberAndNotTheDefaultOne)
	if( strlen($path)>strlen($GLOBALS['GET']['pathByDefault']) ){
		$noStartChar=preg_replace('~^'.preg_quote(DIRECTORY_SEPARATOR).'~','',$path);
		$parents = preg_split('~'.preg_quote(DIRECTORY_SEPARATOR).'~', $noStartChar);
		array_pop($parents);
		$newPath='';
		for($ihere=0;$ihere<count($parents);$ihere +=2){
			$newPath.=DIRECTORY_SEPARATOR.$parents[$ihere]; 	// '/id__200100000000000000'
			$objy= new metaList($newPath);
			$newPath.=DIRECTORY_SEPARATOR.$parents[$ihere+1]; 	// '/id__200100000000000000/content'
			$lineageArrOfTypes[]=$objy->data['type']; 	// 'rubrique'?
			$lineageArrOfTypes[]=$parents[$ihere+1];
			#Add parent datas to navigation if the actual object is the asked one.
			if($path==$GLOBALS['urlParams']['path']){ 
				$GLOBALS['itemsData']['navigation'][$objy->id]=$objy->properties();
				$GLOBALS['itemsData']['navigation'][$objy->id]['model']['model']=$GLOBALS['itemsData']['navigation'][$objy->id]['model']['navigation'];
			}
			unset($objy);
		}
	}
	else{
		$lineagePathOfTypes=$GLOBALS['lineageDefaultRoot'];
		$lineageArrOfTypes=preg_split('~/~', $lineagePathOfTypes);
	}
	return $lineageArrOfTypes;
}
?>