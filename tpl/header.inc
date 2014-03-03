<!doctype html>
<html>

<head>
	<?php include 'jss.inc'; ?>

</head>

<body>
<div class="container">
	<?php include 'nav.inc'; ?>
	<?php 
	
		if(!isset($_SESSION['loggedin']) && in_array(getCurrPage(),$memberpages) ) {
			echo 'You are not authorized to access this page. Please login first';
			exit;
		}
	?>
	
	