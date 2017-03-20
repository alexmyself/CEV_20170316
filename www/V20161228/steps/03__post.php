<?php
if (count($_POST) == 0){ return;}
# Prepare html:
	#__ $_POST['action']	['action1Uuid']['software']= 'admin';
	#			['action1Uuid']['command']	= 'create';
	#			['action2Uuid']['software']= 'stat';
	#			['action2Uuid']['command']	= 'addTo';
# To php:
	#$pack_action'1'['software']= 'admin';
	#$pack_action'1'['command']	= 'create';
	#$pack_action'2'['software']= 'stat';
	#$pack_action'2'['command']	= 'addTo';

foreach($_POST as $label => $contenu){
	if($label == 'action'){
		$listOfActionsToDo = array();
		foreach($contenu as $actionX => $contenuX){
			if (isset(${'pack_'.$actionX}) == false){
				${'pack_'.$actionX} = array();
				$listOfActionsToDo[] = 'pack_'.$actionX;
			}
			$field = $contenuX;
			foreach($field as $labelOfField => $valueOfField){
				${'pack_'.$actionX}[$labelOfField] = $valueOfField;
			}
		}
		if (count($listOfActionsToDo) == 0){ return;}
		foreach($listOfActionsToDo as $packName){
			#Check if software is allowed to be ran
			$GLOBALS['$flag_ok'] = true;
			if(array_key_exists('software', ${$packName})==false){return;}
			function tempFunc($val, $key){
				if($key == 'software'){
					if(in_array($val, $GLOBALS['allowedSoftware'])==false){
						$GLOBALS['$flag_ok'] = false;
					}
				}
			}
			array_walk_recursive(${$packName}, 'tempFunc');
			if($GLOBALS['$flag_ok'] == false){return;}
			$parent = null;
			$packObject = new metaSoftware($parent, ${$packName});
			unset($packObject);
		}
	}
}
?>