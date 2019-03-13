<?php

if ( !isset( $GLOBALS[ "modulejson" ] ) || !is_array( $GLOBALS[ "modulejson" ] ) ) {
   $GLOBALS[ "modulejson" ] = [];
}

$GLOBALS[ "modulejson" ][ "tutorial" ] = json_decode( '{"fields":[{"id":"text1","role":"input","type":"html","value":"<div style=\"width:850px;margin-left:100px;\"> <p><span style=\"font-weight:bold;font-size:20pt;font-family:\\'Avenir\\'\">Disclaimer</span></p>  <p></p>  <p class=\"\" style= \"text-align:justify;margin-bottom:0.0000in;margin-top:0.0000in;margin-right:0.0000in\" awml:style=\"Normal\"><span style= \"font-style:italic;font-size:16pt;font-family:\\'Avenir\\'\"> For a quick ROTDIF tutorial,</span> <span style= \"font-size:16pt;font-family:\\'Avenir\\'\">Please click <a href=\"https://drive.google.com/open?id=1kJJXEVtpoZ-KZ5p_pt1TByJGcBkxHVjc\" target=\"_blank\">here to view</a> </p> </div> "}],"label":"ROTDIF tutorial","moduleid":"tutorial","nooutputhr":"true","noreset":"true","nosubmit":"true"}' );
?>
