<?php
include 'vendor/autoload.php';
include 'core/config.inc';
include 'core/mycore.inc';
include 'tpl/header.inc';

$result = getMembers(); 

foreach($result as $res) {
	print_r($res);
}

include 'tpl/footer.inc';
?>
