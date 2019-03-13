<?php

if ( !isset( $GLOBALS[ "modulejson" ] ) || !is_array( $GLOBALS[ "modulejson" ] ) ) {
   $GLOBALS[ "modulejson" ] = [];
}

$GLOBALS[ "modulejson" ][ "jobintegritycheck" ] = json_decode( '{"docrootexecutable":"ajax/sys_config/sys_jobintegritycheck.php","executable":"jobintegritycheck","fields":[{"help":"Correct fixable errors","id":"fixerrors","label":"Fix errors","role":"input","type":"checkbox"}],"label":"Jobintegritycheck","moduleid":"jobintegritycheck","resource":"local","submitpolicy":"all","uniquedir":"on"}' );
?>
