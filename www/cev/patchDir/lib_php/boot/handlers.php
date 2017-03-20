<?php
function handler_php($path){require_once $path ;}
function handler_html($path){
	echo file_get_contents($path)."\n";
}
function handler_css($path){
/*	echo '	<script type="text/javascript">
			require(["dojo/ready", "dojo/NodeList-manipulate"], function(ready){
				ready(function(){dojo.query("head").append(\'<link rel="stylesheet" type="text/css" href="'.
					preg_replace('~'.preg_quote(DIRECTORY_SEPARATOR).'~','/',preg_replace('~'.preg_quote($GLOBALS['root']).'~', $GLOBALS['PATHS']['httpRoot'], $path)).
				'">\');});
			});
			</script>'."\n";
*/
	echo '	<link rel="stylesheet" type="text/css" href="'.
					preg_replace('~'.preg_quote(DIRECTORY_SEPARATOR).'~','/',preg_replace('~'.preg_quote($GLOBALS['root']).'~', $GLOBALS['PATHS']['httpRoot'], $path)).
				'">';

}
function handler_js($path){
	echo '	<script type="text/javascript" src="'.
				preg_replace('~'.preg_quote(DIRECTORY_SEPARATOR).'~','/',preg_replace('~'.preg_quote($GLOBALS['root']).'~', $GLOBALS['PATHS']['httpRoot'], $path)).'"></script>'."\n";
}
?>