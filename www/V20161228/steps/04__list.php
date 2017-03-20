<?php

#Set big categories
$GLOBALS['itemsData']=array();								#All datas goes here, like: ...[id]=$propertyArr (come from class metaList).

#Get site item datas
$objSite= new metaList('/id__000000000000000001');
$GLOBALS['itemsData']['site'][$objSite->data['id']]=$objSite->properties();
unset($objSite);


#get asked Item datas
$askedItem = new metaList($GLOBALS['urlParams']['path']);
$GLOBALS['itemsData']['askedPage'][$askedItem->data['id']] = $askedItem->properties();
unset($askedItem);

/*
Previous method, using links in the tree dir.
Was ok and nice, but needs sftp access to create links and finally i've never used more than one deep level in the tree so it's not very needed/useful in regard of the problem that sftp access can be.
#get children datas
$contentPath = $GLOBALS['PATHS']['tree'].$GLOBALS['urlParams']['path']; 						// /../motorRoot/tree + /id__200100000/content/id__200200000

if(($containersPaths = lister($contentPath, 'dirs')) !== false){ 								// /../motorRoot/tree/id__200100000/content/id__200200000/ dirs
	foreach($containersPaths as $containerPath){ 												// /../motorRoot/tree/id__200100000/content/id__200200000/content
		$containerName=fs::pathLastPart($containerPath); 										// content
		if(($itemsPaths = lister($containerPath, 'dirs')) !== false){ 							// /../motorRoot/tree/id__200100000/content/id__200200000/content/ dirs
			foreach($itemsPaths as $itemPath){ 													// /../motorRoot/tree/id__200100000/content/id__200200000/content/id__200xyz000
				$obj = new metaList(textReplace($GLOBALS['PATHS']['tree'],'',$itemPath));
				$GLOBALS['itemsData'][$containerName][$obj->data['id']]=$obj->properties();
				unset ($obj);
			}
		}
	}
}
*/

#Now it's admitted that all items contains only one deep level of content and are reachable at root of tree dir.
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
?>