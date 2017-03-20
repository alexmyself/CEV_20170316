<?php
function handler_php($path){require_once $path ;}
function handler_html($path){ echo file_get_contents($path); }
function handler_css($path){ echo '	<link rel="stylesheet" type="text/css" href="'.fs::pathFsToHtml($path).'">';}
function handler_js($path){echo '	<script type="text/javascript" src="'.fs::pathFsToHtml($path).'"></script>';}
#preg_replace('~'.preg_quote(DIRECTORY_SEPARATOR).'~','/',preg_replace('~'.preg_quote($GLOBALS['motorRoot']).'~', $GLOBALS['PATHS']['httpMotorRoot'], $path))
#preg_replace('~'.preg_quote(DIRECTORY_SEPARATOR).'~','/',preg_replace('~'.preg_quote($GLOBALS['motorRoot']).'~', $GLOBALS['PATHS']['httpMotorRoot'], $path))


function handlerForHtmlOutput_php($path){
	ob_start();
	include($path);
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
function func_alias($target, $original) { eval("function $target() { \$args = func_get_args(); return call_user_func_array('$original', \$args); }"); }
func_alias('handlerForHtmlOutput_txt', 'handlerForHtmlOutput_php');

function handlerForHtmlOutput_html($path){return PHP_EOL.file_get_contents($path);}


//__________Link to external file______________________
function handlerForHtmlOutput_css($path){return PHP_EOL.'	<link rel=\'stylesheet\' property=\'stylesheet\' type=\'text/css\' href=\''.fs::pathFsToHtml($path).'\'>';}
function handlerForHtmlOutput_js($path){ return PHP_EOL.'	<script type="text/javascript" src="'.fs::pathFsToHtml($path).'"></script>';}
//_____________________________________________________

//or
/*
//__________Concat to one html file____________________
function handlerForHtmlOutput_css($path){return PHP_EOL.'<style  type="text/css"       >'.file_get_contents($path).'</style>';}
function handlerForHtmlOutput_js($path){ return PHP_EOL.'<script type="text/javascript">'.file_get_contents($path)."</script>";}
//______________________________________________________
*/
?>