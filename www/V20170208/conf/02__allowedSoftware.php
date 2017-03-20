<?php
# Allowed softwares are all files in /libPhp/02_software/.
/*
$arrayOfDirs = lister($GLOBALS['PATHS']['lib'].DIRECTORY_SEPARATOR.'02__software', 'dirs');
if(is_array($arrayOfDirs)){ foreach ($arrayOfDirs as $key => $value) { $GLOBALS['allowedSoftware'][]=$value; } }
unset($arrayOfDirs);
/*
# Allowed types are all root dirs in /stock/. (article, rubrique, user...)
$arrayOfDirs = lister($GLOBALS['PATHS']['stock'], 'dirs');
function allowedType($param){ $GLOBALS['allowedType'][]=preg_replace('~^.*'.preg_quote(DIRECTORY_SEPARATOR).'~','',$param); }
array_map( 'allowedType', $arrayOfDirs);
unset($arrayOfDirs);
*/

?>