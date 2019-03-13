<?php

function getModulesNames(){
	$modules = array();
	array_push($modules,"welcome");
	array_push($modules,"tutorial");
	array_push($modules,"acknowledgements");
	array_push($modules,"disclaimer");
	array_push($modules,"ses_all");
	array_push($modules,"jobmonitor");
	array_push($modules,"jobintegritycheck");
	array_push($modules,"sysuserslist");
	array_push($modules,"sys_manage_users");
	array_push($modules,"jobshistory_1");
	array_push($modules,"sys_file_manager");
	
	return $modules;
}
?>