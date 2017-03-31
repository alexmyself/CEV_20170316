<?php
# A 18 digit time based string used as Unique Identifier for each html page generated.
$GLOBALS['uidNow']= getUid();

# A digit, unique, used to build uids inside html code. Ex: <form id='pack_action__uid_<?php echo getUidOnPage(); \?\>
# Echo in html: func to have new uid, GLOBALS to keep using a value.
$GLOBALS['uidOnPage']= 0;
$GLOBALS['uidOnPage']= getUidOnPage();
?>