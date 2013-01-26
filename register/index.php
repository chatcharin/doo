<?php
@session_start();
$checkmember = $_SESSION['userlogin'];
include("connect.php");
include("./functionphp/function.php");
if ($checkmember != "") {
   // rd("profile.php?ss=all");
   /* Change to update user to Post Tark Edit */
    
       
   /* hidden Register                         */
   return false;
}
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
        <link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">
            <link rel="stylesheet" href="default.css" type="text/css" media="screen" />
            <title>Cam Chat-Video Chat Room</title>
            <script type="text/javascript" src="prototype.js"></script>
            <script type="text/javascript">
                function sub() {
                    //alert(bgsignin);
                    var username = $('form2').getInputs("text");
                    var email = $('form2').getInputs("text");
                    var password = $('form2').getInputs("password");
                    var repassword = $('form2').getInputs("password");
                    var box = $('form2').getInputs("checkbox");
                    if ((username[0].value == "") || (email[1].value == "") || (password[0].value == "") || (repassword[1].value == "") || (password[0].value != repassword[1].value)) {
                        alert("Please check for incorrect data.");
                    }

                    else if (box[0].checked == false) {
                        alert("Please checkbox");
                    }

                    if ((username[0].value != "") && (email[1].value != "") && (password[0].value != "") && (repassword[1].value != "") && (password[0].value == repassword[1].value) && (box[0].checked == true)) {
                        document.form2.submit();
                    }
                }
            </script>
    </head>
    <body>

        <div id="header">
            <div id="logo"><a href="index.php"><img src="images/logo_video_camchat.png" border="0" /></a></div>
            <?php if ($checkmember == "") { ?>

                <div id="login">
                    <form name='f1' action='index.php' method="post">
                        <label>Username:<br /><input type='text' name='user' ></label>
                        <label>Password:<br /><input type='password' name='pass' ></label>
                        <label class="bntlogin">&nbsp;<br/><input class="btn" type='submit' value='LOGIN'></label>
                    </form>
                </div>

            <?php } ?>
        </div>
        <div id="wrap">
            <div id="content"> 
                <form method='post' action='index.php'>
                    <?php

                    // สร�?า�?�?ั�?�?�?�?ั�?�? สำหรั�?�?สด�?�?าร�?�?�?�?ห�?�?า   
                    function page_navigator($before_p, $plus_p, $total, $total_p, $chk_page) {
                        global $urlquery_str;
                        $pPrev = $chk_page - 1;
                        $pPrev = ($pPrev >= 0) ? $pPrev : 0;
                        $pNext = $chk_page + 1;
                        $pNext = ($pNext >= $total_p) ? $total_p - 1 : $pNext;
                        $lt_page = $total_p - 4;
                        if ($chk_page > 0) {
                            echo "<a href='?ss=1&s_page=$pPrev&urlquery_str=" . $urlquery_str . "' class='naviPN'>Prev</a>";
                        }
                        if ($total_p >= 11) {
                            if ($chk_page >= 4) {
                                echo "<a $nClass href='?ss=1&s_page=0&urlquery_str=" . $urlquery_str . "'>1</a><a class='SpaceC'>. . .</a>";
                            }
                            if ($chk_page < 4) {
                                for ($i = 0; $i < $total_p; $i++) {
                                    $nClass = ($chk_page == $i) ? "class='selectPage'" : "";
                                    if ($i <= 4) {
                                        echo "<a $nClass href='?ss=1&s_page=$i&urlquery_str=" . $urlquery_str . "'>" . intval($i + 1) . "</a> ";
                                    }
                                    if ($i == $total_p - 1) {
                                        echo "<a class='SpaceC'>. . .</a><a $nClass href='?ss=1&s_page=$i&urlquery_str=" . $urlquery_str . "'>" . intval($i + 1) . "</a> ";
                                    }
                                }
                            }
                            if ($chk_page >= 4 && $chk_page < $lt_page) {
                                $st_page = $chk_page - 3;
                                for ($i = 1; $i <= 5; $i++) {
                                    $nClass = ($chk_page == ($st_page + $i)) ? "class='selectPage'" : "";
                                    echo "<a $nClass href='?ss=1&s_page=" . intval($st_page + $i) . "'>" . intval($st_page + $i + 1) . "</a> ";
                                }
                                for ($i = 0; $i < $total_p; $i++) {
                                    if ($i == $total_p - 1) {
                                        $nClass = ($chk_page == $i) ? "class='selectPage'" : "";
                                        echo "<a class='SpaceC'>. . .</a><a $nClass href='?ss=1&s_page=$i&urlquery_str=" . $urlquery_str . "'>" . intval($i + 1) . "</a> ";
                                    }
                                }
                            }
                            if ($chk_page >= $lt_page) {
                                for ($i = 0; $i <= 4; $i++) {
                                    $nClass = ($chk_page == ($lt_page + $i - 1)) ? "class='selectPage'" : "";
                                    echo "<a $nClass href='?ss=1&s_page=" . intval($lt_page + $i - 1) . "'>" . intval($lt_page + $i) . "</a> ";
                                }
                            }
                        } else {
                            for ($i = 0; $i < $total_p; $i++) {
                                $nClass = ($chk_page == $i) ? "class='selectPage'" : "";
                                echo "<a href='?ss=1&s_page=$i&urlquery_str=" . $urlquery_str . "' $nClass  >" . intval($i + 1) . "</a> ";
                            }
                        }
                        if ($chk_page < $total_p - 1) {
                            echo "<a href='?ss=1&s_page=$pNext&urlquery_str=" . $urlquery_str . "'  class='naviPN'>Next</a>";
                        }
                    }
                    ?>
                    <div class="index">
                        <ul >
                            <?php
                            $q = "select * from createroom room";
                            //$q.=" ORDER BY province_id ";
                            $q.="";
                            $qr = mysql_query($q);
                            $total = mysql_num_rows($qr);
                            $e_page = 12; // �?ำห�?ด �?ำ�?ว�?ราย�?ารที�?�?สด�?�?�?�?ต�?ละห�?�?า   
                            if (!isset($_GET['s_page'])) {
                                $_GET['s_page'] = 0;
                            } else {
                                $chk_page = $_GET['s_page'];
                                $_GET['s_page'] = $_GET['s_page'] * $e_page;
                            }
                            $q.=" LIMIT " . $_GET['s_page'] . ",$e_page";
                            $qr = mysql_query($q);
                            if (mysql_num_rows($qr) >= 1) {
                                $plus_p = ($chk_page * $e_page) + mysql_num_rows($qr);
                            } else {
                                $plus_p = ($chk_page * $e_page);
                            }
                            $total_p = ceil($total / $e_page);
                            $before_p = ($chk_page * $e_page) + 1;
                            ?>

                            <?php
                            while ($rs = mysql_fetch_array($qr)) {
                                ?>
                                <?php
                                if ($rs[1] != "") {
                                    $link = "<a href='ckpasschat.php?roomname=$rs[0]'>";
                                } else {
                                    $link = "<a href='chat.php?roomname=$rs[0]'>";
                                }
                                ?>
                                <li >

                                    <span>
    <?php echo "$link<img src='rooms/$rs[4]' title='$rs[2]' width=140px height=140px style='border:#DDDDDD solid 1px' /></a> "; ?> 						
                                        <div id="nameroomindex">
                                            <div id="status1">
                                                <?php if ($rs[1] != "") { ?><img src="image/label-red.png" width="10px" height="10px" title="Private Room" /><?php echo $rs[0]; ?>
    <?php } else { ?><img src="image/label-green.png" title="Public Room" width="10px" height="10px"/><?php echo $rs[0]; ?>													<?php } ?>
                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $rs[0] ;  ?>
                                        </div> 

                                    </span>
                                </li>

<?php } ?>
                        </ul>
                        <br class="clearit" />
                            <?php if ($total > 0) { ?>
                            <div class="browse_page">
                                <?php
                                // เรีย�?�?�?�?�?า�?�?ั�?�?�?�?ั�?�? สำหรั�?�?สด�?�?าร�?�?�?�?ห�?�?า   
                                page_navigator($before_p, $plus_p, $total, $total_p, $chk_page);
                                ?> 
                            </div>
<?php } ?> 
                    </div>							
                </form>	
            </div>
            <div id="register">
<?php if ($checkmember == "") { ?>
                    <div class="titleregis">Register Free camchat	</div>
                    <div class="contentregis">
                        <form id="form2" name="form2"  method="POST" enctype="multipart/form-data">							
                            <div><label>Username</label><input type='text' name='userregis' width="60px">*</div>
                            <div><label>Password</label><input type='password' name='passregis'>*</div>
                            <div><label>Re-Password</label><input type='password' name='repass'>
                                    *</div>
                            <div><label>Email</label><input type='text' name='email'>*</div>
                            <div><label>Picture<br />( jpg ,gif ,png )</label><input type='file' name='fileupload' size="13" /><input type="hidden" name="MAX_FILE_SIZE" value="100000"/> </div>							
                            <div><label>Read Me</label><span>Camchat has a strict policy regarding copyright violation, nudity and other items you can find in the terms of use. if you do not follw the terms, you will be banned from the site.</span></div>
                            <div><label><input type="checkbox" name="ck" value="ON"/></label>I agree to the terms of use.</div>
                            <div><label>&nbsp;</label><input class='btn' type='submit' value="Register" name="rebg" onClick="sub(this.value);"></div>
                        </form>
                    </div>
                    <?php
                }
                ?>

            </div>

        </div>
        <div class="clear-all"></div> 
        <div id="footer">
            Copyright &copy; 2011 4Xtreme Co.,Ltd
        </div>

        <?php
        $fileupload = $_FILES['fileupload']['tmp_name'];
        $fileupload_name = $_FILES['fileupload']['name'];
        $fileupload_size = $_FILES['fileupload']['size'];
        $fileupload_type = $_FILES['fileupload']['type'];

        /*
          if($fileupload_size > 100000){
          echo "<script>alert('Error !!! Max Picture Size 1MB');</script>";
          rd("index.php");
          return false;
          } */

        $userregis = $_POST[userregis];
        //echo $userregis;

        $email = $_POST[email];
        //echo $email;

        $pass = $_POST[passregis];
        //echo $pass;

        $repass = $_POST[repass];
        //echo $repass;

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
        mysql_close($link);
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
        ?>
    </body>
</html>
