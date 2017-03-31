<?php
/*Get content from all files in dir $path and return an array.
Support indexed things, dir, files or files to add without index nor name, just grab everything from a dir and use parent dir as name.
	-dirA
		-fileName.txt
	-dirB
		01_fileNameindexed.html
		02_fileNameindexed.php
		03_...
	-dirC
		__01_fileOne
		__02_fileTwo
		__03_10_fileThree
		__dirD
			__fileD
	array(
	[dirA][fileName]='file content'
	[dirB][01][fileNameindexed]='file content'
	[dirC][]='fileOne content'
	[dirC][]='fileTwo content'
	[dirC][][]='fileD'

	)
*/
function loadDatas($path){
	$arrResult = array();
	if(!($entries = lister($path,'all'))){ return false; }



	foreach($entries as $entry){
		$fileNameNoExtension = fs::pathLastPart($entry, 'removeExtension');
		#check if entry start with an index: 0_fileA.txt, 0_fileB, ...
		$indexed = false;
		if(preg_match('~^[0-9]+_~', $fileNameNoExtension) == 1){
			$indexed = preg_replace('~_.*~','',$fileNameNoExtension);
			$indexed.='_';
			$fileNameNoExtension = preg_replace('~[0-9]+_~','',$fileNameNoExtension);
		}
		#check if entry start with two underscore: __0_fileA.txt, __0_fileB, ...
		$dumbInclude = false;
		if(preg_match('~^__~', $fileNameNoExtension) == 1){$dumbInclude=true;}

		#if it's a final file
		$value = false;
		if(is_file($entry)){ $value = fs::getContent($entry);}
		#else, if it's a dir
		else{$value= loadDatas($entry);}

		if($indexed){$arrResult[$indexed][$fileNameNoExtension]= $value;}
		elseif ($dumbInclude) {$arrResult[]= $value;}
		else{$arrResult[$fileNameNoExtension]= $value;}
	}
	return $arrResult;
}
?>