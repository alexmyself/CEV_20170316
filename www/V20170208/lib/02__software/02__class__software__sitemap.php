<?php
class software__sitemap extends metaSoftware{
	protected function login() 	{return true;} 	//No login needed for defaults values
	protected function play() 	{
		$infos=fs::dirNameInfos($GLOBALS['GET']['pathByDefault']);
		$list=fs::itemsTree($infos['id']);

//Clear path param to avoid any page to be treated as the askedPage
$savedPath= $GLOBALS['urlParams']['path'];
$GLOBALS['urlParams']['path']='none';

//Call every items to fill $GLOBALS['itemsData']
$tmpArr=[];
foreach($list as $itemPath){ 																	// /../motorRoot/tree/id__200200000/content/id__200xyz000
	$itemName=fs::pathLastPart($itemPath);
	$obj = new metaList($itemPath);
	$obj->data['htmlLink']= preg_replace('~sitemap~', $GLOBALS['GET']['softwareByDefault'], $obj->data['htmlLink']);
//	$obj->data['htmlLink']= htmlspecialchars($obj->data['htmlLink']);
	$tmpArr[]=$obj->properties(); //Here all occurences of all items are stored.
	$GLOBALS['itemsData']['content'][$obj->data['id']]= $obj->properties(); //Here only one occurence can appear to avoid multiples treatments.
	unset ($obj);
}
//And we need all occurences to be treated.
$GLOBALS['itemsData']['content']=$tmpArr;

//Put path back
$GLOBALS['urlParams']['path']= $savedPath;


/*		#get asked Item datas
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
*/	}
}
?>