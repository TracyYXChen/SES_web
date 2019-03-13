<?php

if ( !isset( $GLOBALS[ "modulejson" ] ) || !is_array( $GLOBALS[ "modulejson" ] ) ) {
   $GLOBALS[ "modulejson" ] = [];
}

$GLOBALS[ "modulejson" ][ "sub_plotly" ] = json_decode( '{"executable":"test_subplot.py","fields":[{"id":"subplot","label":"Example subplot","role":"output","type":"plotly"}],"help":"help for Plotly","label":"plotly plot","moduleid":"sub_plotly","uniqueid":"on"}' );
?>
