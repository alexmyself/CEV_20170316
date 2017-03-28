<?php
#Path: ..maybe a path?
#Prefix: string to use specific handler function name. Default prefix is 'handler' and function name is 'handler_[php|jpg|html|..]'
#Return: != null to receive an eventual output from ran functions.
function loopInclude($path, $prefix = null, $return = null){
//echo "\n\nloopInclude diving in: ".$path;
	if($prefix == null){$prefix = 'handler';}
	if( ($pathList= lister($path, 'all'))==false){return false;}
	natSortArr($pathList);
	$output = null;
	foreach($pathList as $entry){
		if(is_file($entry) && function_exists($prefix.'_'.getFileExtension($entry))){
//echo "\n\thandling file: ".$entry;
			$handlerFuncName = $prefix.'_'.getFileExtension($entry);
			if($return == null){ $handlerFuncName($entry);}
			else{ $output .= $handlerFuncName($entry);}
//echo "\t done...";
		}
		elseif(is_dir($entry)){
			if($return == null){loopInclude($entry, $prefix, $return);}
			else{$output .= loopInclude($entry, $prefix, $return);}
		}
	}
	if($return != null){return $output;}
}
?>