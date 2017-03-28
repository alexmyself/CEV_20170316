<?php
class software__default extends metaSoftware{
	protected function login() 	{return true;} 	//No login needed for defaults values
	protected function play() 	{

		#get asked Item datas
		$askedItem = new metaList($GLOBALS['urlParams']['path']);
		$GLOBALS['itemsData']['askedPage'][$askedItem->data['id']] = $askedItem->properties();
		unset($askedItem);

		#It's admitted that all items contains only one deep level of content and are reachable at root of tree dir.
		#get children datas
		#Build root tree asked item dir name: rank__0003__id__20003000 => id__20003000
		$dirInfos= fs::dirNameInfos($GLOBALS['urlParams']['path']);
		$treeDirName = 'id__'.$dirInfos['id'];
		$contentPathFs = $GLOBALS['PATHS']['tree'].DIRECTORY_SEPARATOR.$treeDirName;									// /../motorRoot/tree + / + id__200200000
		if(($containersPaths = lister($contentPathFs, 'dirs')) !== false){ 												// /../motorRoot/tree/id__200200000/ dirs
			foreach($containersPaths as $containerPath){ 																// /../motorRoot/tree/id__200200000/content
				$containerName=fs::pathLastPart($containerPath); 														// content
				if(($itemsPaths = lister($containerPath, 'dirs')) !== false){ 											// /../motorRoot/tree/id__200200000/content/ dirs
					foreach($itemsPaths as $itemPath){ 																	// /../motorRoot/tree/id__200200000/content/id__200xyz000
						$itemName=fs::pathLastPart($itemPath);
						$obj = new metaList($GLOBALS['urlParams']['path'].'/'.$containerName.'/'.$itemName);
						$GLOBALS['itemsData'][$containerName][$obj->data['id']]=$obj->properties();
						unset ($obj);
					}
				}
			}
		}
	}
}
?>