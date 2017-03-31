<?php
#Return string ___tagStart___ string ___tagStop___ or ___everythingStart___ ... ___everythingStop___ if no tag provided
function findBlocks($model, $tag=false, $prefixChar=false, $suffixChar=false){
	#Set delimiters
	if($prefixChar==null){$prefixChar=$GLOBALS['tagPreffix'];}
	if($suffixChar==null){$suffixChar=$GLOBALS['tagSuffix'];}

	#Set tag
	$tagAnonymousArr= false;
	if($tag===false){
		$tag='(?!'.$suffixChar.').+';
		$tagAnonymousArr= array();
	}

	#Build the regexp for start block in model.
	$startTag=$prefixChar.$tag.'Start'.$suffixChar;

	#Get tags present in model.
	if($tagAnonymousArr!==false){ 
		preg_match_all('~'.$startTag.'~', $model, $tagAnonymousArr);
		if( is_array($tagAnonymousArr) && (count($tagAnonymousArr[0])>0)){ $tagAnonymousArr=$tagAnonymousArr[0];}
		else{$tagAnonymousArr= array();}
	}
	else{$tagAnonymousArr= array($tag);}


	$blocksInModelArray= array();

	foreach ($tagAnonymousArr as $value) {
		#clean the tag if it comes from anonymous way.
		$value=textReplace('Start'.$suffixChar, '', $value);
		$value=textReplace($prefixChar, '', $value);
		$startTag				=$prefixChar.$value.'Start'.$suffixChar;
		$stopTag				=$prefixChar.$value.'Stop'.$suffixChar;
		#assertions start with (?= for positive assertions and (?! for negative assertions. For example, \w+(?=;) matches a word followed by a semicolon
		#and foo(?!bar) matches any occurrence of "foo" that is not followed by "bar"
		#$blockMotifToReplace 	='~'.$startTag.'(?!'.$stopTag.').*'.$stopTag.'~s';
		#above example doesn't work as expected, it matches the longest match possible. This is called a 'greedy' regexp, it's the default behavior.
		#a '?' after a quantifier (like '*') makes this search 'ungreedy', the shortest match possible, and only for this '*'.
		#$blockMotifToReplace 	='~'.$startTag.'.*?'.$stopTag.'~s';
		#a U modifier makes the entire pattern ungreedy and faster than the '?' technique.
		$blockMotifToReplace 	='~'.$startTag.'.*'.$stopTag.'~Us';
		$tmpArr=false;
		preg_match_all($blockMotifToReplace, $model, $tmpArr);
		if( is_array($tmpArr) && (count($tmpArr[0])>0)){ $blocksInModelArray= array_merge($blocksInModelArray, $tmpArr[0]); }
	}
	
	if(count($blocksInModelArray)>0){return $blocksInModelArray;}
	return false;
}
?>