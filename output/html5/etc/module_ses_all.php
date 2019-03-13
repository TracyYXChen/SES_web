<?php

if ( !isset( $GLOBALS[ "modulejson" ] ) || !is_array( $GLOBALS[ "modulejson" ] ) ) {
   $GLOBALS[ "modulejson" ] = [];
}

$GLOBALS[ "modulejson" ][ "ses_all" ] = json_decode( '{"executable":"main_ses.py","fields":[{"default":"header4","id":"ses_label","label":"Sparse Ensemble Selection(SES)","posthline":"true","prehline":"true","role":"input","type":"label"},{"help":"Enter a name to run this task","id":"run_name","label":"run name","required":"true","role":"input","type":"text"},{"default":"","id":"data_label","label":"DATA","posthline":"true","prehline":"true","role":"input","type":"label"},{"accept":".txt","help":"Upload experiment data file","id":"exp_location","label":"Experiment Data File","required":"true","role":"input","type":"lrfile"},{"accept":".txt","help":"Upload ensemble matrix file","id":"mat_location","label":"Ensemble Matrix File","required":"true","role":"input","type":"lrfile"},{"default":"","id":"runmenu_label","label":"RUN MENU","posthline":"true","prehline":"true","role":"input","type":"label"},{"id":"progress_output","label":"Progress: ","max":1,"role":"output","type":"progress"},{"cols":40,"id":"progress_text","label":"Calculation Report: ","role":"output","type":"textarea"},{"id":"output_ses","label":"SES Results File: ","multiple":"true","role":"output","type":"file"}],"label":"Calculate","moduleid":"ses_all","notify":"ychen151@terpmail.umd.edu","submitpolicy":"login"}' );
?>
