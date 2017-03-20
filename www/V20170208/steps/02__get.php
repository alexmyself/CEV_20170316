<?php
/**
* 	GET url params sanitizing and related functions.
*
*	All possibles keys have to appear here, otherwise they'll mostly be ignored any further.
*	Asked by url params are stored in a second array after values have been cleaned.
*
* 	@var array $GLOBALS['urlParams']['getParamName']= 'get param value'.
*	@var array $GLOBALS['urlParamsAsked'] ['getParamName']= 'get param value'.
*/
$GLOBALS['urlParams']['software']	= (array_key_exists('software', $_GET) 	&& (preg_match('~^[[:alnum:]_]+$~',urldecode($_GET['software']) )==1) )?											$_GET['software'] 	: urlencode($GLOBALS['GET']['softwareByDefault']);
$GLOBALS['urlParams']['path']		= (array_key_exists('path', $_GET) 		&& (preg_match('~^'.DIRECTORY_SEPARATOR.'[[:alnum:]_'.DIRECTORY_SEPARATOR.']+$~',urldecode($_GET['path']) )==1))?	$_GET['path'] 		: urlencode($GLOBALS['GET']['pathByDefault']);
//$GLOBALS['urlParams']['optionals'] 	= null; //Flag, beginning of optionals keys, followings will be used only if provided.
$GLOBALS['urlParams']['pageId'] 	= $GLOBALS['uidNow']; //Allow only known generated page to call once, and only once, for another new page.
$GLOBALS['urlParams']['display'] 	= (array_key_exists('display',$_GET) 	&& (preg_match('~^[[:alnum:]_]+$~',urldecode($_GET['display']) )==1) )? 											$_GET['display'] 	: urlencode($GLOBALS['GET']['displayByDefault']);

$GLOBALS['urlParamsAsked'] = array_intersect_key($GLOBALS['urlParams'], $_GET );


/**
* 	Build an encoded string of safe/checked/known html args templating and with defaults from the $GLOBALS['urlParams'] array.
* 	
* 	@param 	array $args		['datas'] 	['keyName'] 		='value';	key/values to append to url params string.
* 	@param 	array $args 	['skipList']['keyNameToSkip'] 	= null; 	key to skip, string is the key name, not the value.
* 	@return string			'?keyName1=value1&keyName2=value2';
*/
function htmlQueryRebuild(array $args=['datas'=>[], 'skipList'=>[]]): string {
	$defaultValues 			=['datas'=>$GLOBALS['urlParams'], 'skipList'=>[]]; 				//Use a copy of urlParams as a template.
	$usedValues 			=['datas'=>$GLOBALS['urlParamsAsked']]; 									//Use a copy of urlParamsAsked as a template.
	$args['datas'] 			= array_intersect_key($args['datas'], $defaultValues['datas']); //Remove eventuals non known/non GET related keys from provided args.
//	$optionalsList 			= array_slice($defaultValues['datas'], array_search('optionals',array_keys($defaultValues['datas'])) );
//	$defaultValues['datas'] = array_diff_key($defaultValues['datas'], $optionalsList ); 	//Remove optionals keys from template.
	$args 					= array_replace_recursive($usedValues, $args);				//Use updated used values.
	$args['datas'] 			= array_diff_key($args['datas'], $args['skipList']); 			//Remove unwanted keys
	return http_build_query($args['datas']); 												//Build the string
}


function htmlQueryToArray($encodedQuery){
	$outputArr = array();
	parse_str(urldecode($encodedQuery), $outputArr );
	return $outputArr;
}

//htmlQueryToArray(htmlQueryRebuild(array('datas'=> $GLOBALS['urlParams'], 'skipList'=>['pageId']));
?>