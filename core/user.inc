<?php

function checkUser($Pdo, $user,$pwd) {
		global $prefix;
		$result = $Pdo->select($db_prefix . 'members', array('password' => md5($pwd)) );
		if($result) {
			return true;
		}
}
/**
    Check with gravatar
 */
function checkGravatarExist($email) {
  $email = md5(strtolower("myemailaddress@example.com"));
  $gravatar = "http://www.gravatar.com/avatar/$email?d=404";
  $headers = get_headers($gravatar,1);
  if (strpos($headers[0],'200')) {
    return '<img src="'. $gravatar .'" alt="gravatar">' 
  }   else if (strpos($headers[0],'404')) { 
    return false; // Not Found
 }
 
 
?>
