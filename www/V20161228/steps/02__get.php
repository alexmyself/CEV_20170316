<?php
#$GLOBALS['askedPage']['id'] is set later in 04_list.
$GLOBALS['urlParams']['path']		= (array_key_exists('path', $_GET) && preg_match('~^'.DIRECTORY_SEPARATOR.'[[:alnum:]_'.DIRECTORY_SEPARATOR.']+$~',$_GET['path'])==1)?	$_GET['path']	: $GLOBALS['GET']['pathByDefault'];
$GLOBALS['urlParams']['software']	= (array_key_exists('user', $_SESSION) 	&& $_SESSION['user'][$_GET['software']]['isLogged'] == true)?	$_GET['software'] : $GLOBALS['GET']['softwareByDefault'];
$GLOBALS['urlParams']['display'] 	= (array_key_exists('display',$_GET) && (preg_match('~^[[:alnum:]_]+$~',$_GET['display'])==1) )? $_GET['display']	: $GLOBALS['GET']['displayByDefault'];
#$GLOBALS['urlParams']['clientW'] 	= (array_key_exists('clientW',$_GET) && (preg_match('~^[-\+]?[[:digit:]]*\.*[[:digit:]]+$~',$_GET['clientW'])==1) )? $_GET['clientW']	: $GLOBALS['GET']['clientWByDefault'];
#$GLOBALS['urlParams']['clientH'] 	= (array_key_exists('clientH',$_GET) && (preg_match('~^[-\+]?[[:digit:]]*\.*[[:digit:]]+$~',$_GET['clientH'])==1) )? $_GET['clientH']	: $GLOBALS['GET']['clientHByDefault'];
$GLOBALS['urlParams']['pageId'] 	= $GLOBALS['uidNow'];

//echo $GLOBALS['urlParams']['clientW'].'  x  '.$GLOBALS['urlParams']['clientH'];


#Flag to easily remove non previously checked/setted args that can be passed to htmlParamsRebuild (hellArr)
$GLOBALS['urlParams']['lastArg']= 'end';

#Set html args for the askedPage or whatever if an array is given as parameter, for last form it return the result.
function htmlGetParamsRebuild($data=null, $skipAuth=true){
	$skipAuthList[]='pageId';
	if($data==null){$data=$GLOBALS['urlParams'];}
	else{$data=array_merge($GLOBALS['urlParams'], $data);}
	if(array_key_exists('allArgs', $data)){array_splice($data, array_search('allArgs',array_keys($data)),1);}
	$aA=null;

	if($skipAuth==true){foreach ($skipAuthList as $key){ array_splice($data, array_search($key,array_keys($data)), 1); } }

	array_splice($data, array_search('lastArg', array_keys($data)));

	foreach ($data as $key => $val){
		$char = (strlen($aA)==0)? '?':'&amp;';
		$aA.=$char.$key.'='.$val;
	}

	if($data==null){$GLOBALS['urlParams']['allArgs'] = $aA;}
	return $aA;
}
htmlGetParamsRebuild();
?>