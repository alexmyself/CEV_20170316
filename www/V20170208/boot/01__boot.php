<?php
//require_once('debug.php');

$motorRoot = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..').DIRECTORY_SEPARATOR;

require_once('02__func__getFileExtension.php');
require_once('03__func__handlers.php');
require_once('04__func__natSortArr.php');
require_once('05__func__lister.php');
require_once('06__func__loopInclude.php');
require_once($motorRoot.'conf'.DIRECTORY_SEPARATOR.'01__paths.php');

loopInclude($GLOBALS['PATHS']['lib']);
loopInclude($GLOBALS['PATHS']['conf']);
?>