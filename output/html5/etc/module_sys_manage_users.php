<?php

if ( !isset( $GLOBALS[ "modulejson" ] ) || !is_array( $GLOBALS[ "modulejson" ] ) ) {
   $GLOBALS[ "modulejson" ] = [];
}

$GLOBALS[ "modulejson" ][ "sys_manage_users" ] = json_decode( '{"autosubmit":"true","docrootexecutable":"ajax/sys_config/sys_manageusers.php","executable":"sys_manage_users","fields":[{"id":"sysuserreport","label":"","role":"output","type":"html"}],"label":"Sys_Manage_Users","moduleid":"sys_manage_users","nojobcontrol":"true","noreset":"true","resource":"local","submit_label":"Refresh","submitpolicy":"all","uniquedir":"on"}' );
?>
