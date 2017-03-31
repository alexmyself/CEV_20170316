<?php
class fs{
	function __construct(){ $this->okToRun = true;}
	var $myMeta;
	var $okToRun;

	#Return an associative array with values from dir name, like id and rank.
	static function dirNameInfos($path){
		$arrInfos = explode('__', basename($path) );
		$assocArrInfos=array();
		if( count($arrInfos)==1 && strlen($arrInfos[0])==18 ){$assocArrInfos['id']=$arrInfos[0];}
		elseif(count($arrInfos)==1){return false;}
		else{ for($i=0; $i<count($arrInfos); $i+=2){ $assocArrInfos[$arrInfos[$i]]=$arrInfos[$i+1]; } }
		return $assocArrInfos;
	}
	
	//Return a http url corresponding to local fs path.
	static function pathFsToHtml($path){
		$httpPath = preg_replace('~'.preg_quote($GLOBALS['motorRoot']).'~','',$path);
		$httpPath = preg_replace('~'.preg_quote(DIRECTORY_SEPARATOR).'~','/',$httpPath);
		return $GLOBALS['PATHS']['httpMotorRoot'].'/'.$httpPath;
	}

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

	static function itemsTree(string $rootId, $targetOnly=false, string $previousPath=''): array{
		$output 	= [];
		$rootInfos 	= fs::dirNameInfos($rootId);
		$rootFsPath = $GLOBALS['PATHS']['tree'].DIRECTORY_SEPARATOR.'id__'.$rootInfos['id'];
		if($previousPath==''){
			$previousPath='/id__'.$rootInfos['id'];
			$output[]=$previousPath;
		}
		if( ($dirs = lister($rootFsPath, 'dirs')) === false){ return $output;}
		if($targetOnly!==false && in_array($rootFsPath.DIRECTORY_SEPARATOR.$targetOnly, $dirs)===false ){return $output;}
		if($targetOnly!==false){$dirs = [$rootFsPath.DIRECTORY_SEPARATOR.$targetOnly];}
		foreach ($dirs as $containerPath) {
			if(($containedItems = lister($containerPath, 'dirs'))===false){continue;}
			$containerDir= fs::pathLastPart($containerPath);
			foreach ($containedItems as $itemPath) {
				$itemDir 	= fs::pathLastPart($itemPath);
				$itemInfos 	= fs::dirNameInfos($itemDir);
				$itemHtmlPath = $previousPath.'/'.$containerDir.'/'.$itemDir;
				$output[]= $itemHtmlPath;
				$output= array_merge($output, fs::itemsTree('id__'.$itemInfos['id'], $targetOnly, $itemHtmlPath) );
			}
		}
		return $output;
	}

	static function lastMod(string $path): string{
		if(preg_match('~'.preg_quote(DIRECTORY_SEPARATOR).'$~', $path)!=1){$path.=DIRECTORY_SEPARATOR;}
		return date ("Y-m-d",  filemtime($path.'.'));
	}
}
?>