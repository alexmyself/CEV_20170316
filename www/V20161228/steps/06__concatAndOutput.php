<?php
###############################################################################
##ITEMS models packing
#Grab a copy of asked page datas for later repass
$idKeys=array_keys($GLOBALS['itemsData']['askedPage']);
$askedPageDatas=$GLOBALS['itemsData']['askedPage'][$idKeys[0]]['data'];


#Pack completed models
foreach ($GLOBALS['itemsData'] as $keyContainerName => $arrItems) {
	foreach ($arrItems as $keyItemId => $itemDatas) {
		#Make a fake data table to be treated as stacked values by the replacement motor.
		$GLOBALS['itemsData'][$keyContainerName]['pack'][$keyContainerName][] = $itemDatas['model']['model'];
		unset($GLOBALS['itemsData'][$keyContainerName][$keyItemId]);
	}
}

#Get the site model and remove it to prevent any further treatment.
$html=array_shift($GLOBALS['itemsData']['site']['pack']['site']);
array_shift($GLOBALS['itemsData']);

#Push askedPage to the end of the table to be the last executed.
$askedPage=array_shift($GLOBALS['itemsData']);
array_push($GLOBALS['itemsData'], $askedPage);





#Place everything in the site model
foreach ($GLOBALS['itemsData'] as $keyContainerName => $arrItems) {
	$html=replacementMotor(array('dataArr' => $arrItems['pack'], 'modelStr'=>$html));
}
#Replay asked page to fill every tags over the site which could involve it's values
$html=replacementMotor(array('dataArr'=>$askedPageDatas, 'modelStr'=>$html));


#Replace unique ids
$string= $GLOBALS['tagPreffix'].'uidForElement'.$GLOBALS['tagSuffix'];
$html =textReplace($string, 'getUidForElement', $html);

#Clean
$html=tagKarcher($html);

#Output
echo $html;

?>