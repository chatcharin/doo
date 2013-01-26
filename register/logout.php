<?php
	session_start();
	include("connect.php");
	//$_SESSION['userlogin'] = "";
	session_destroy();
	rd("index.php");	 
?>