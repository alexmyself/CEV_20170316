<?php
# Return a string prefixed with zeros to match neededLength
function addLeadingZeros($mixVar, $neededLength){
	$string = strval($mixVar);
	if(strlen($string)>$neededLength){return false;}
	if(strlen($string)==$neededLength){return $string;}
	$zeroBlock= '';
	for($i=0; $i< $neededLength-strlen($string); $i++){ $zeroBlock.='0'; }
	$zeroBlock.= $string;
	return $zeroBlock;
}
?>