<?php
if (count($_POST) != 0){
	# Prepare html:
		#__ $_POST	['action1Uuid']['software'] = 'admin';
		#			['action1Uuid']['command']	= 'create';
		#			['action2Uuid']['software'] = 'stat';
		#			['action2Uuid']['command']	= 'addTo';
	# To php:
		#$GLOBALS['softwaresCommandsPacks']['uid1']['software']= 'admin';
		#$GLOBALS['softwaresCommandsPacks']['uid1']['command']= 'create';
		#$GLOBALS['softwaresCommandsPacks']['uid2']['software']= 'admin';
		#$GLOBALS['softwaresCommandsPacks']['uid2']['command']= 'create';
	
	$GLOBALS['softwaresCommandsPacks']=array();

	foreach($_POST as $uid => $commandsArr){
		if(!array_key_exists('software', $commandsArr) || !array_key_exists('command', $commandsArr)){continue;}
		if(!class_exists('software__'.$commandsArr['software']) || !method_exists('software__'.$commandsArr['software'], $commandsArr['command'])){ continue;}
		$GLOBALS['softwaresCommandsPacks'][$uid]=$commandsArr;
	}

	foreach ($GLOBALS['softwaresCommandsPacks'] as $uid => $commandsArr) { softwareHandler($commandsArr); }
}
?>