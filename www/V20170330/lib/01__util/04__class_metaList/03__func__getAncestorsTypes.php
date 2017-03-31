<?php
function getAncestorsTypes($path){
	#if item path if the default one use the default lineage values.
	#No lineage when calling an item directly, regardless of tree (ex.: http://.../xyz.php?path=/id__aDirectNumberAndNotTheDefaultOne)
	$lineageArrOfTypes = array();
	if( strlen($path)>strlen($GLOBALS['GET']['pathByDefault']) ){
		$noStartChar=preg_replace('~^'.preg_quote(DIRECTORY_SEPARATOR).'~','',$path);
		$parents = preg_split('~'.preg_quote(DIRECTORY_SEPARATOR).'~', $noStartChar);
		array_pop($parents); //Remove the item itself from ancestors list
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
	return $lineageArrOfTypes;
}
?>