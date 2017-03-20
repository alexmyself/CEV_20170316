<?php
class fs{
	function __construct(){ $this->okToRun = true;}
	var $myMeta;
	var $okToRun;

	#Return an associative array with values from dir name, like id and rank.
	static function dirNameInfos($path){
		$arrInfos = explode('__', $path);
		$assocArrInfos=array();
		if( count($arrInfos)==1 && strlen($arrInfos[0])==18 ){$assocArrInfos['id']=$arrInfos[0];}
		elseif(count($arrInfos)==1){return false;}
		else{ for($i=0; $i<count($arrInfos); $i+=2){ $assocArrInfos[$arrInfos[$i]]=$arrInfos[$i+1]; } }
		return $assocArrInfos;
	}
	
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

	function getProperty($id, $propertyName){return file_get_contents($GLOBALS['PATHS']['stock'].DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$propertyName.'.txt');}

	static function pathFsToHtml($path){
		$httpPath = preg_replace('~'.preg_quote($GLOBALS['motorRoot']).'~','',$path);
		$httpPath = preg_replace('~'.preg_quote(DIRECTORY_SEPARATOR).'~','/',$httpPath);
		return $GLOBALS['PATHS']['httpMotorRoot'].'/'.$httpPath;
	}
/*
	static function pathHtmlToFs($path){
		$httpPath = preg_replace('/', DIRECTORY_SEPARATOR, $path);
		$httpPath = $GLOBALS['motorRoot'].$httpPath);
		
		return $GLOBALS['PATHS']['httpMotorRoot'].'/'.$httpPath;
	}
*/	
	static function pathLastPart($path, $removeExtension = null){
		#remove trailing slash if any
		$name = preg_replace('~'.preg_quote(DIRECTORY_SEPARATOR).'$~', '', $path);
		$name = basename($name);
		$name = ($removeExtension === null)? $name : preg_replace('~\.[^\.]*$~','',$name);
		return $name;
	}

	static function getContent($path){
		$content=null;
		if(preg_match('~\.(png|jpg|gif|ico)$~', $path)== 1){ $content = fs::pathFsToHtml($path);}
		elseif(preg_match('~\.(php|html|txt|css|js)$~', $path)== 1){
			if(function_exists('handlerForHtmlOutput_'.getFileExtension($path))){
				$handlerFuncName = 'handlerForHtmlOutput_'.getFileExtension($path);
				$content = $handlerFuncName($path);
			}
		}
		return $content;
	}
	
	#Call only with path arg and target string and exclude arr, not the followings ones. Returns an array of strings. Stops diving deeper in dir tree on matching name, ie: will never find a /../target/target dir.
	static function dirTreeByName($path, $targetDirName, $excludeArr, $internalArr=array(), $internalFlag=false){
		#if param path end by param dirName, add it to the list
		if(fs::pathLastPart($path)==$targetDirName){$internalArr[]=$path;}
		#scan subdirs
		elseif( ($treeArr = lister($path, 'dirs')) !== false){ 
			foreach($treeArr as $dir){ 
				if(  (count($excludeArr)>0) && (preg_match('/(' .implode('|', $excludeArr) .')/', $dir) == 1) ){continue;}
				$internalArr= fs::dirTreeByName($dir, $targetDirName, $excludeArr, $internalArr, 'running');
			}
		}
		#return collected dirs
		if( ($internalFlag == false) && !(count($internalArr)>0) ) {return false;}
		return $internalArr;
	}

	function create(){}
}
?>