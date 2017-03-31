<?php
function iAlreadyExists($id, $arrContainerContent){
	if(array_key_exists($id, $arrContainerContent)){return $arrContainerContent[$id];}
	else{return false;}
}
?>