<?php

if ( !isset( $GLOBALS[ "modulejson" ] ) || !is_array( $GLOBALS[ "modulejson" ] ) ) {
   $GLOBALS[ "modulejson" ] = [];
}

$GLOBALS[ "modulejson" ][ "disclaimer" ] = json_decode( '{"fields":[{"id":"text1","role":"input","type":"html","value":"<div style=\"width:850px;margin-left:100px;\"> <p><span style=\"font-weight:bold;font-size:20pt;font-family:\\'Avenir\\'\">Disclaimer</span></p>  <p></p>  <p class=\"\" style= \"text-align:justify;margin-bottom:0.0000in;margin-top:0.0000in;margin-right:0.0000in\" awml:style=\"Normal\"><span style= \"font-style:italic;font-size:16pt;font-family:\\'Avenir\\'\"> ROTDIF</span> <span style= \"font-size:16pt;font-family:\\'Avenir\\'\">is distributed \"as is\", without any warranty, including any implied warranty of merchantability or fitness for a particular use. The authors assume no responsibility for, and shall not be liable for, any special, indirect, or consequential damages, or any damages whatsoever, arising out of or in connection with the use of this software. </p> </div> "}],"label":"Official Disclaimer","moduleid":"disclaimer","nooutputhr":"true","noreset":"true","nosubmit":"true"}' );
?>
