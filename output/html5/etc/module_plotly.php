<?php

if ( !isset( $GLOBALS[ "modulejson" ] ) || !is_array( $GLOBALS[ "modulejson" ] ) ) {
   $GLOBALS[ "modulejson" ] = [];
}

$GLOBALS[ "modulejson" ][ "plotly" ] = json_decode( '{"executable":"plotly.py","fields":[{"id":"subplot","label":"Example subplot","role":"output","type":"plotly"}],"help":"help for Plotly","label":"plotly plot","moduleid":"plotly","uniqueid":"on"}' );
?>
