<?php
error_reporting(0);
error_reporting(E_ERROR);
/*-------------- Create Session ---------------------*/
@session_start();
$checkmember = $_SESSION['userlogin'];

/*-------------- End Create Session -----------------*/

/*-------------- include connect and function -------*/
include("connect.php");
include("./functionphp/function.php");
/*--------------  end include -----------------------*/

/*-------------- check login ------------------------*/
if ($checkmember != "") {
   // rd("profile.php?ss=all");
   /* Change to update user to Post Tark Edit */
    
   /* hidden Register                         */
   return false;
}
?>

<?
/*--------------- end check login ---------------------*/
//$att = $_GET['att'];
//if ($att != "") {
//    echo"<script> alert('Please Register !!!'); </script>";
//    rd("index.php");
//}
//login by pratipan.bs@gmail.com
$user = $_POST['user'];
$pass = $_POST['pass'];
/*----- Check SQL injunktion hack ----*/
if ($user != "" && $pass != "") {
    $ichar = strlen($pass);
    for ($i = 0; $i < $ichar; $i++) {
        $ch = substr($pass, $i, 1);
        if ($ch == "'" || $ch == "\\" || $ch == "`") {
            echo "<script>alert('Error !!!');</script>";
            rd("index.php");
            return false;
        }
    }

    //$reuser = str_replace("'", "", $user);	
    $pass = md5($pass);

    //echo "<script>alert('$pass');</script>";
/*----- Check User in DataBase -------*/
    $sql = "select * from iuser where user='$user' and pass='$pass' and activeuser=1";
    $result = mysql_query($sql);
    if ($rs = mysql_fetch_array($result)) {
        $_SESSION['userlogin'] = $user;
        rd("profile.php?ss=all");
        return false;
    } else {
        echo "<script>alert('Username And Password Incorrect Or No Active Email!!!');</script>";
        rd("index.php");
        return false;
    }
}
/* ------- End Check -------------*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/css.css"  />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/TTF_400-TTF_700.font.js" type="text/javascript"></script>
<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.js"></script>
<title>Doo Home</title>
</head>
<script type="text/javascript"> 
    Cufon.replace('h1,h2,h3,h4'); 
</script>
<body>
	<div id="all">
			<?php  include("header.php");?>
			<div id="top">
				<?php  include("search_box.php");?>
				<?php  include("banner_top.php");?>
			</div>
		<div id="wrap">
			<div id="main">
            <?php include ("view_project.php");?>
			<?php include ("post_showall.php");?>	
			<?php include ("view_news.php");?>
                 
			</div>
            <div id="right">
				<?php include("banner_right.php");?>
			  	<?php include("service_facebook.php");?>
				<?php include("service_bank.php");?>
				<?php include("service_thai.php");?>
			</div><!--end right -->
			<div id="clear"></div>
			<!--<div id="main_all">
				<div id="content_all">
				<h1 id="red">สมัครสมาชิก</h1>
					sssss<br />ssssssss
				</div><!--end content_all  
			</div>
			<div id="clear"></div>-->
		</div><!--end wrap -->
	</div><!--end all -->
		<?php include("footer.php");?>
</body>
</html>
<?php
$email = $_POST[email];
if($email!=""){
/*-------------- insert user register ---------------*/
$fileupload = $_FILES['fileupload']['tmp_name'];
$fileupload_name = $_FILES['fileupload']['name'];
$fileupload_size = $_FILES['fileupload']['size'];
$fileupload_type = $_FILES['fileupload']['type'];
$userregis = $_POST[userregis];
//echo $userregis;

//echo $email;
$pass = $_POST[passregis];
//echo $pass;
$repass = $_POST[repass];
//echo $repas;
$ck = $_POST[ck];
//echo "<script>alert('$ck');</script>";
if (!$ck) {
    return false;
}
//echo $ck;
$x = "0";
$var = "0";
//echo $userregis.$email.$pass,$repass;
//----------------check user------------------------------------//
if ($userregis == "" || $email == "" || $pass == "" || $repass == "") {
    //echo "<script>alert('Data Error !!!');</script>";
    return false;
} else {
    $iuser = strlen($userregis);
    if ($iuser < 5 || $iuser > 10) {
        echo "<script>alert('Username Must Length 5 To 10 Characters !!!');</script>";
        return false;
    }
    $ipass = strlen($pass);
    if ($ipass < 6 || $ipass > 15) {
        echo "<script>alert('Password Must Length 6 To 15 Characters !!!');</script>";
        return false;
    }
}


$userregis = strtolower($userregis);
if (!(preg_match('/^[a-z]+$/i', $userregis))) {
    echo "<script>alert('User a-z only !!!');</script>";
    return false;
}

$pass = strtolower($pass);
if (!(preg_match('/^[a-z1-9]+$/i', $pass))) {
    echo "<script>alert('password a-z or 1-9 only !!!');</script>";
    return false;
}

$pass = md5($pass);

//---------------------check username------------------------------------------------------//

$result = mysql_query("SELECT * FROM iuser WHERE user='$userregis'");
if ($linex = mysql_fetch_array($result)) {
    echo "<script>alert('Because user have already.');</script>";
    return false;
}


//---------------------email chack-------------------------------------------------------------//

$result = mysql_query("SELECT email FROM iuser WHERE email='$email'");
if ($linex = mysql_fetch_array($result)) {
    echo "<script>alert('Because email have already.');</script>";
    return false;
}


if ($fileupload != "") {
    $array_last = explode(".", $fileupload_name);
    $c = count($array_last) - 1;
    $lastname = strtolower($array_last[$c]);
    if ($lastname == "gif" or $lastname == "jpg" or $lastname == "jpeg" or $lastname == "png") {
        $name = $userregis . "." . $lastname;
        copy($fileupload, "members/" . $name);
        unlink($fileupload);
        resizephp("members/", $name);
    } else {
        $name = "null.jpg";
    }
} else {
    $name = "null.jpg";
}

$activepass = rand_str();
$sql = "insert into iuser values(null, '$userregis', '$pass', '$email', '$name', 0, '$activepass')";
$i = mysql_query($sql);
mysql_close($conn_);
if ($i == 1) {
    activeuser($userregis, $repass, $email, $activepass);
    //$_SESSION['userlogin'] = $userregis;
    echo "<script>alert('Register Complete And \\nCheck Email And Acitve Register \\nregister.webilink@gmail.com only!!!');</script>";
    rd("index.php");
    return false;
} else {
    echo "<script>alert('Register False');</script>";
    rd("index.php");
    return false;
}
}
?>