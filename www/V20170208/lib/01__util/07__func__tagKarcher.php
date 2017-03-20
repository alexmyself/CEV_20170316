<?php
function tagKarcher($stringToClean, $prefixChar=null, $suffixChar=null){
	#Tags Karcher
	if($prefixChar==null){$prefixChar=$GLOBALS['tagPreffix'];}
	if($suffixChar==null){$suffixChar=$GLOBALS['tagSuffix'];}

	#Remove unused blocks
	$blocksArr= findBlocks($stringToClean);
	if($blocksArr!==false){ foreach($blocksArr as $key => $value){  $stringToClean= textReplace($value, '', $stringToClean); } }

	#Remove unused alones tags
	$stringToClean = preg_replace('~'.$prefixChar.'(?!'.$suffixChar.').+'.$suffixChar.'~', '', $stringToClean);
	return $stringToClean;
}
?>