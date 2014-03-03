<?php
if(empty($_GET['p'])) {
	show_404('Unauthorized page access');
}
include 'vendor/autoload.php';
include 'core/config.inc';
include 'core/mycore.inc';
include 'tpl/header.inc';
include 'tpl/jss.inc';
include 'tpl/footer.inc';
?>

