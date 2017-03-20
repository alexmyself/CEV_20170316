<?php
function loopInclude($path, $prefix = null, $return = null){
	if($prefix == null){$prefix = 'handler';}
	if( ($pathList= lister($path, 'all'))==false){return false;}
	natSortArr($pathList);
	$output = null;
	foreach($pathList as $entry){
		if(is_file($entry) && function_exists($prefix.'_'.getFileExtension($entry))){
			$handlerFuncName = $prefix.'_'.getFileExtension($entry);
			if($return == null){$handlerFuncName($entry);}
			else{$output .= $handlerFuncName($entry);}
		}
		elseif(is_dir($entry)){
			if($return == null){loopInclude($entry, $prefix, $return);}
			else{$output .= loopInclude($entry, $prefix, $return);}
		}
	}
	if($return != null){return $output;}
}
?>