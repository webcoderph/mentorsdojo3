<?php
//functions
function show_404() {
	header("HTTP/1.0 404 Not Found");
    header("Status: 404 Not Found");	
	exit;
}


function chopExtension($filename) {
   return substr($filename, 0, strrpos($filename, '.'));
}

function getCurrPage() {
	return chopExtension(__FILE__);
}

function getMembers() {
	return PDOWrapper::instance()->select( $pre . 'members');
}

function getMentors() {
	return PDOWrapper::instance()->select( $pre . 'members',array('user_type' => 'M'));
}

function getMentees() {
	return PDOWrapper::instance()->select( $pre . 'members',array('user_type' => 'E'));
}

function getPerson($uid) {
	return PDOWrapper::instance()->select( $pre . 'members',array('id' => $uid));
}
