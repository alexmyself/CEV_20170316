<?php
#Moteur de remplacement
function replacementMotor($argArr){
	/*
	Parameters:
	$argArr['dataArr']			= array('containerName'=>$obj->data[])
	$argArr['modelStr']			= $obj->model['model']
	$argArr['isChild']			= internal flag for motif re-matching
	*/
	if(!array_key_exists('isChild', $argArr)){$argArr['isChild']==false;}

	$sentArgArr=$argArr;
	$sentArgArr['isChild']=true;
	$modelCompleted=replaceLoop($sentArgArr);

	#Play as long as new tags appears
	if($argArr['isChild']==false){
		$repassArr=$argArr;
		$repassArr['modelStr']=$modelCompleted;
		$repassArr['isChild']=true;
		$modelCompletedNth=replaceLoop($repassArr);
		while($modelCompleted != $modelCompletedNth){
			$modelCompleted=$modelCompletedNth;
			$repassArr['modelStr']=$modelCompletedNth;
			$modelCompletedNth=replaceLoop($repassArr);
		}

	}
	#Output the completed text
	return $modelCompleted;
}


function replaceLoop($argArr){
	/*
	keys/values in dataArr array can be:
		dataArr[ string tagName] => value: string tagContent 	'text from tagName.txt' 																data/tagName.txt				(final value alone)
		dataArr[ string tagName] => value: array  tagContent	[ subkey string] 			=> 'text from subkey.txt'									data/tagName/subkey.txt			(final value)
		dataArr[ string tagName] => value: array  tagContent	[ subkey int]				=> string '__xyzContent'									data/tagName/__xyz.txt 			(stacked values, $arr['oneName'][]='bla', or '__xyz.txt')
		dataArr[ string tagName] => value: array  tagContent	[ subkey string0-9{x}_] 	=> array 					=> ['subTagName'] => string 	data/tagName/01_subTagName.txt		(indexed values, $arr['subLink']['0_']['url']='bla')
		dataArr[ string tagName] => value: array  tagContent	[ subkey string] 			=> array					=> [mixed above things]			data/tagName/anotherTagName/... 	(aka: normal stuff, list of subdirs content)

		Full dir max possibility, treated in this order:
		1 data/tagName/anotherTagName/
		2 data/tagName/__xyz1.txt 				! Concat if indexed exists, loop otherwise.
		2 data/tagName/__xyz2.txt
		3 data/tagName/01_subTagName.txt
		3 data/tagName/02_subTagName.txt
		4 data/tagName/firstName.txt 			! Not a tagName.txt otherwise it will remove ___tagName___ and __xyz.txt won't have a target anymore.
		4 data/tagName/secondName.txt 			! Apply on every models generated by indexed or stacked if exists.
		
		! Block/Looping conflict:
			-firstName is ok, it will only use a firstNameStart/Stop block and won't loop as it has a unique name.
			-__xyz1&2 can be concatenated at ___tagName___, or uses each the block ___tagNameStart___ ___tagName___ ___tagNameStop___, and so killing those tags in the model.
			-01_ 02_ will use the block each in a loop.

		___tagNameStart___ 	___firstName___ 	___secondName___ 	___tagName___ 			___subTagName___ 	___anotherTagNameStart___ ... ___anotherTagNameStop___ 	___tagNameStop___
		___tagNameStart___ 	___firstName___ 	___secondName___ 	___tagName___ 			___subTagName___ 	anotherTagContent 										___tagNameStop___
		___tagNameStart___ 	___firstName___ 	___secondName___ 	xyz1,2 Content 			___subTagName___ 	anotherTagContent 										___tagNameStop___
						 	___firstName___ 	___secondName___ 	xyz1,2 Content 			01_subTagContent 	anotherTagContent
						 	___firstName___ 	___secondName___ 	xyz1,2 Content 			02_subTagContent 	anotherTagContent
						 	firstName.txt 	 	___secondName___  	xyz1,2 Content 			01_subTagContent 	anotherTagContent
							firstName.txt 	 	secondName.txt  	xyz1,2 Content 			01_subTagContent 	anotherTagContent
							...
	*/
	$prefixChar=$GLOBALS['tagPreffix'];
	$suffixChar=$GLOBALS['tagSuffix'];
	$modelCompleted = $argArr['modelStr'];
	foreach ($argArr['dataArr'] as $tagName => $tagContent) {

		#Check if property is used in the model, else go next.
		# build the regexp for tag alone and start/stop block in model.
		$standardTag 	=$prefixChar.$tagName.$suffixChar;
		$startTag		=$prefixChar.$tagName.'Start'.$suffixChar;
		$stopTag		=$prefixChar.$tagName.'Stop'.$suffixChar;
		if( (strpos($argArr['modelStr'], $standardTag)===false) && (strpos($argArr['modelStr'], $startTag)===false)){continue;}

		#Lists ___tagNameStart___ /stop blocks from model.
		$modelBlocks=findBlocks($modelCompleted, $tagName);
		#Remove eventual block locking tag.
		// Fail: (blocks disappears) if($modelBlocks != false){ foreach ($modelBlocks as $key => $value) { $modelBlocks[$key]=preg_replace('~\['.$tagName.'BlockLock\]~', '', $value);}}

		#Fill data lists by type, only if it's not a final value, in which case there's only to fill the model.
		$stackedPack 	=false;
		$indexedPack	=false;
		$normalPack 	=false;
		$finalPack 		=false;
		if( is_array($tagContent) ){
			foreach ($tagContent as $contentKey => $contentValue) {
				if 		(is_int($contentKey)) 						{$stackedPack[] 			=(is_array($contentValue)?  replacementMotor(array('dataArr'=> array($tagName=>$contentValue), 'modelStr'=>$standardTag, 'isChild'=>true)) : $contentValue);}
				elseif 	(preg_match('~^[0-9]+_$~', $contentKey) ) 	{$indexedPack[$contentKey] 	=$contentValue;}
				elseif 	(is_array($contentValue)) 					{$normalPack[$contentKey] 	=$contentValue;}
				elseif 	(is_string($contentKey)) 					{$finalPack[$contentKey] 	=$contentValue;}
			}
		}
		else{$finalPack[$tagName]=$tagContent;}

		#Complete blocks first and replace them in the $modelCompleted.
		if($modelBlocks != false){
			#Modify the blocks models
			$completedModelBlocks=array();
			foreach ($modelBlocks as $blockNum => $block) {
				$completedModelBlocks[$blockNum]=$block;
				if($normalPack != false) 									{ foreach ($normalPack as $subDirName => $subDirContent) {$completedModelBlocks[$blockNum]=replacementMotor(array('dataArr'=>array( $subDirName=>$subDirContent), 'modelStr'=> $completedModelBlocks[$blockNum], 'isChild'=> true) );} }
				if( ($stackedPack != false) && ($indexedPack != false) ) 	{ $completedModelBlocks[$blockNum]=textReplace($standardTag, implode($stackedPack), $completedModelBlocks[$blockNum]);}
			}
			#Multiply and modify them
			foreach ($modelBlocks as $blockNum => $block) {
				$completedBlocksPack=false;
				if($indexedPack != false) 		{foreach ($indexedPack as $index => $values) 	{$completedBlocksPack[]=replacementMotor(array('dataArr'=> $values, 'modelStr'=>$completedModelBlocks[$blockNum], 'isChild'=>true)); }}
				elseif( $stackedPack != false) 	{foreach ($stackedPack as $int => $text) 		{$completedBlocksPack[]=replacementMotor(array('dataArr'=> array($tagName=>$text), 'modelStr'=>$completedModelBlocks[$blockNum], 'isChild'=>true)); }}
				#If completed blocks have been generated, pack them and replace their tags in the model
				if($completedBlocksPack != false) 	{$completedModelBlocks[$blockNum]=implode($completedBlocksPack); }
			}
			foreach ($completedModelBlocks as $blockNum => $block) { $modelCompleted=textReplace($modelBlocks[$blockNum], $block, $modelCompleted); }
			$modelCompleted=textReplace($startTag,'',$modelCompleted);
			$modelCompleted=textReplace($stopTag,'',$modelCompleted);
		}
		

		#Replace the two kinds of values that possibly needs no block
		#Complete model with stacked values if tag is still present
		if($stackedPack){
			$modelCompleted=textReplace($standardTag, implode($stackedPack), $modelCompleted);
//			$modelCompleted=textReplace($prefixChar.$tagName.'Start'.$suffixChar, '', $modelCompleted);
//			$modelCompleted=textReplace($prefixChar.$tagName.'Stop'.$suffixChar, '', $modelCompleted);
		}
		
		#Now replace final values
		if($finalPack != false){
			foreach ($finalPack as $tag => $text) {
				$modelCompleted=textReplace($prefixChar.$tag.$suffixChar, $text, $modelCompleted);
				$modelCompleted=textReplace($prefixChar.$tag.'Start'.$suffixChar, '', $modelCompleted);
				$modelCompleted=textReplace($prefixChar.$tag.'Stop'.$suffixChar, '', $modelCompleted);
			}
		}
	}
	return $modelCompleted;	
}
?>