<?php
//To be used when needed
$GLOBALS['PATHS']['lib']=$GLOBALS['motorRoot'].'lib';
$GLOBALS['PATHS']['conf']=$GLOBALS['motorRoot'].'conf';
$GLOBALS['PATHS']['steps']=$GLOBALS['motorRoot'].'steps';
$GLOBALS['PATHS']['stock']=$GLOBALS['motorRoot'].'stock';
$GLOBALS['PATHS']['tree']=$GLOBALS['motorRoot'].'tree';
$GLOBALS['PATHS']['skeleton']=$GLOBALS['motorRoot'].'skeleton';
$GLOBALS['PATHS']['skeletonDefault']=$GLOBALS['PATHS']['skeleton'].DIRECTORY_SEPARATOR.'default';

$urlRequestProtocol= (empty($_SERVER['HTTPS']))? 'http://':'https://';
$urlRequestNoParams=preg_replace('~\?.*~', '', $_SERVER['REQUEST_URI']);
$urlRequestPath=dirname($urlRequestNoParams);
$urlRequestName=basename($urlRequestNoParams);
$GLOBALS['PATHS']['httpRoot']= $urlRequestProtocol.$_SERVER['SERVER_NAME'];
$GLOBALS['PATHS']['httpMotorRoot']= $GLOBALS['PATHS']['httpRoot'].$urlRequestPath;
$GLOBALS['PATHS']['httpMotorIndex']= $GLOBALS['PATHS']['httpMotorRoot'].'/'.$urlRequestName;
?>