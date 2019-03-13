<?php

if ( !isset( $GLOBALS[ "modulejson" ] ) || !is_array( $GLOBALS[ "modulejson" ] ) ) {
   $GLOBALS[ "modulejson" ] = [];
}

$GLOBALS[ "modulejson" ][ "pt" ] = json_decode( '{"executable":"pt.py","fields":[{"backgroundcolor":"black","height":"400px","help":"drag a box to zoom, right click to zoom out","hover":"true","id":"plotout1","label":"plot 1","role":"output","selzoom":"true","titlefontclass":"header3","type":"plot2d","width":"800px"},{"backgroundcolor":"white","height":"400px","help":"drag a box to zoom, right click to zoom out","hover":"true","id":"plotout2","label":"plot 2","role":"output","selzoom":"true","titlefontclass":"header3","type":"plot2d","width":"800px"},{"backgroundcolor":"green","height":"400px","help":"drag a box to zoom, right click to zoom out","hover":"true","id":"plotout3","label":"plot 3","role":"output","selzoom":"true","titlefontclass":"header3","type":"plot2d","width":"800px"},{"id":"outputref","label":"input json reference","role":"output","type":"file"},{"id":"outputres","label":"results json reference","role":"output","type":"file"}],"label":"pt","moduleid":"pt","uniqueid":"on"}' );
?>
