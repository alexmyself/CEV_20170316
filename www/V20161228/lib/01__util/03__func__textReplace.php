<?php
function textReplace($target, $replacement, $text, $debug=false){
	(function_exists($replacement)===true)? $isFunc=true : $isFunc=false;
	if($isFunc==false){ $text =preg_replace('~'.preg_quote($target,'~').'~', $replacement, $text);}
	else{ $text =preg_replace_callback('~'.preg_quote($target,'~').'~', $replacement, $text);}
	return $text;
}
?>