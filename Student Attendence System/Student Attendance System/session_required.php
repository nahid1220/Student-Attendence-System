<?php
	session_start();
	if(!isset($_SESSION['userId']) || empty($_SESSION['userId'])){
		header('location:index.php');
	}
?>