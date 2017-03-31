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
		foreach($list as $itemPath){
			$itemName=fs::pathLastPart($itemPath);
			$obj = new metaList($itemPath);
			$obj->data['htmlLink']= preg_replace('~sitemap~', $GLOBALS['GET']['softwareByDefault'], $obj->data['htmlLink']);
			$tmpArr[]=$obj->properties(); //Here all occurences of all items are stored.
			$GLOBALS['itemsData']['content'][$obj->data['id']]= $obj->properties(); //Here only one occurence can appear to avoid multiples treatments (ten children will call ten times their parent for lineage purpose for ex).
			unset ($obj);
		}
		//And we need all occurences to be treated.
		$GLOBALS['itemsData']['content']=$tmpArr;
		//Put path back
		$GLOBALS['urlParams']['path']= $savedPath;
	}
}
?>