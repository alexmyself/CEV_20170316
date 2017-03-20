<?php
class fs{
	function __construct(){
		$this->okToRun = true;
	}
	var $myMeta;
	var $okToRun;
	
	function findIdsByPropertyValue($property, $value){
		$matchingIds = array();
		$itemsList = lister($GLOBALS['PATHS']['stock'], 'dirs');
		if($itemsList ==false){return false;}
		foreach($itemsList as $itemPath){
			$propertyFilesList = lister($itemPath, 'files');
			if(in_array($itemPath.DIRECTORY_SEPARATOR.$property.'.txt', $propertyFilesList) &&
				file_get_contents($itemPath.DIRECTORY_SEPARATOR.$property.'.txt')==$value){
				$matchingIds[] = fs::pathLastPart($itemPath);
				continue;
			}
		}
		if(empty($matchingIds)){ return false;}
		natcasesort($matchingIds);
		return $matchingIds;
	}

	function getProperty($id, $propertyName){
		return file_get_contents($GLOBALS['PATHS']['stock'].DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$propertyName.'.txt');
	}

	function pathLastPart($path, $removeExtension = null){
		$name = preg_replace('~.*'.preg_quote(DIRECTORY_SEPARATOR).'~','',$path);
		if($removeExtension != null){$name = preg_replace('~\.[^\.]*$~','',$name);}
		return $name;
	}

	
	
	function create(){
		
	}
}
?>