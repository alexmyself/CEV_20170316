<?php
//The sort method preserves key/value but modify their index only for displaying the array:
//ex: the firt line in the array, index 0 wordX could become the third line once the array has sorted but the index 0 stay unchanged, very strange.
// not cool with int keys as here, the sorted array won't work as expected in 'for' loop for example,
//the result is good placement inside the array but indexes are not changed, it's strange..
//Patching with a foreach

function natSortArr(&$arr){
	if(!is_array($arr) || !(count($arr)>0)){return false;}
	$newArr=array();
	$keyArr=array_keys($arr);
	natcasesort($keyArr);
	if(is_int($keyArr[0])){
		natcasesort($arr);
		foreach ($arr as $key => $value) { $newArr[]=$value; }

	}
	else{ foreach ($keyArr as $value) { $newArr[$value]=$arr[$value]; } }
	$arr= $newArr;
}
?>