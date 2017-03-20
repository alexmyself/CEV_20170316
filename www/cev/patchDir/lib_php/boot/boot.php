<?php
require_once('getFileExtension.php');
require_once('handlers.php');
require_once('01_func_lister.php');
require_once('loopInclude.php');
loopInclude(realpath(dirname(__FILE__) . '/..').'/util');
$root = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR;
$GLOBALS['PATHS']['httpRoot']= 'http://'.$_SERVER['SERVER_NAME'].'/';
$GLOBALS['PATHS']['images']= $GLOBALS['PATHS']['httpRoot'].'patchDir/htmlCommon/images/';
?>