<?php

#Set big categories
$GLOBALS['itemsData']=array();								#All datas goes here, like: ...[id]=$propertyArr (come from class metaList).

#Get site item datas
$objSite= new metaList('000000000000000001');
$GLOBALS['itemsData']['site'][$objSite->data['id']]=$objSite->properties();
unset($objSite);

//Launch class to fill $GLOBALS['itemsData']['containerNameX,Y,Z..']['anIdX,Y,Z...']['datas']

softwareHandler( htmlQueryToArray(htmlQueryRebuild()) );
echo "\nVICTOIRE!!! ---".__FILE__;
?>