<?php
	session_start();
	$id = $_GET['id'];
	$user = $_GET['user'];
	$pass = $_GET['pass'];
	$activepass = $_GET['activepass'];
	include("connect.php");		
	if($id == "" || $user == "" || $pass == ""){
		rd("index.php");
		return false;
	}	
		
	if(!(preg_match('/^[a-z]+$/i',$user))){
		rd("index.php");	
		return false;
	}
	
	$pass = strtolower($pass);	
	if(!(preg_match('/^[a-z0-9]+$/i',$pass))){
		rd("index.php");
		return false;
	}
	$activepass = strtolower($activepass);	
	if(!(preg_match('/^[a-z0-9]+$/i',$activepass))){
		rd("index.php");
		return false;
	}
	
	$pass = md5($pass);
	
	if($id == "active"){
		$sql = "update iuser set activeuser=1 where user='$user' and pass='$pass' and activepass='$activepass'";
		$checkactive = mysql_query($sql);
		$sql = "select * from iuser where user='$user' and pass='$pass' and activeuser=1";
		$result = mysql_query($sql);
		if($rs = mysql_fetch_array($result)){
			$_SESSION['userlogin'] = $user;
			echo "<script>alert('Active Register Complete');</script>";
		}else{
			session_destroy();
		}		
		rd("index.php");		
		return false;
	}else if ($id == "remove"){
		$sql = "delete from iuser where user='$user' and pass='$pass' and activepass='$activepass'";
		mysql_query($sql);
		$sql = "delete from createroom where user='$user'";
		mysql_query($sql);
		session_destroy();
		rd("index.php");
		return false;
	}else{		
		return false;
	}
	
	
?>
