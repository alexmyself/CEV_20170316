<?php
/*
Fill an array with values from all files in a dir,
and overwrite existing values with new ones
*/

function getAndMerge($path,&$arr){ if(is_dir($path)){ $arr = array_replace_recursive($arr, loadDatas($path)); } }
?>