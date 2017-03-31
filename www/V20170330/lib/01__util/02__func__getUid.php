<?php
# Return a 18 digit time based string used as Unique Identifier for each html page generated.
function getUid(){
	if(PHP_VERSION >= '5.1.0'){date_default_timezone_set('Europe/Paris');}
	$time = date('YmdHis');
	$microTime = preg_replace('~.+\.~','', microtime(true));
	$microTime = preg_replace('~ .*~','', $microTime);
	$time .= $microTime;
	#18char
	$missing = 18 - strlen($time);
	if($missing > 0){
		for ($i=0; $i < $missing; $i++){
			$time .= '0';
		}
	}
	elseif($missing < 0){
		$regexp= '~.{'.abs($missing).'}$~';
		$time = preg_replace($regexp, '', $time);
	}
	return $time;	
}


# Return a digit, unique, used to build uids inside html code. Ex: <form id='pack_action_<?php echo getUidOnPage(); \?\>
function getUidOnPage(){
	$GLOBALS['uidOnPage'] += 1;
	return $GLOBALS['uidOnPage'];
}
$GLOBALS['uidForElement']=0;
function getUidForElement(){
	$GLOBALS['uidForElement'] += 1;
	return $GLOBALS['uidForElement'];
}
?>