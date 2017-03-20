<?php
function loopInclude($path){
	$pathList= lister($path, 'all');
	sort($pathList);
	foreach($pathList as $entry){
		if(is_file($entry) && function_exists('handler_'.getFileExtension($entry))){
			$handlerFuncName = 'handler_'.getFileExtension($entry);
			$handlerFuncName($entry);
		}
		elseif(is_dir($entry)){ loopInclude($entry);}
	}
}
?>