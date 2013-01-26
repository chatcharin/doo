<?php
	// connect database by pratipan.bs@gmail.com 19-05-2011
	$link = mysql_connect("localhost","root","");
	mysql_select_db("ilink");
	
	
	// redirect page by pratipan.bs@gmail.com
	function rd($page){
		echo "<META HTTP-EQUIV=Refresh CONTENT='0; URL=$page'>";	
	}
	
	// Acitve user by pratipan.bs@gmail.com
	function activeuser($user, $pass, $email, $activepass){
		require_once './mail/class.phpmailer.php';

		$mail = new PHPMailer ();

		$mail -> From = "register.webilink@gmail.com";
		$mail -> FromName = "Active Regsiter WebiLink";
		$mail -> AddAddress ($email);		
		$mail -> Subject = "Active Regsiter WebiLink";
		$mail -> Body  = "<h3>Thank You!  Wellcome To Active Register Camchat Room By 4 Xtreme </h3>";
		$mail -> Body .= "<h4>Username : $user</h4>";
		$mail -> Body .= "<h4>Password : $pass</h4>";
		$mail -> Body .= "<b>Click Here Active Now ! : </b><a href=http://camchat.4x-treme.com/active.php?id=active&user=$user&pass=$pass&activepass=$activepass>Click Active Now !</a><br/>";
		$mail -> Body .= "<br/><a href=http://camchat.4x-treme.com/active.php?id=active&user=$user&pass=$pass&activepass=$activepass>http://camchat.4x-treme.com/active.php?id=active&user=$user&pass=$pass&activepass=$activepass</a>";
		//$mail -> Body .= "<br/><br/><b>Remove : </b><a href=camchat.4x-treme.com/camchat/active.php?id=remove&user=$user&pass=$pass>Remove</a>";
		$mail -> IsHTML (true);

		$mail->IsSMTP();
		$mail->Host = 'ssl://smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPAuth = true;
		$mail->Username = 'register.webilink@gmail.com';
		$mail->Password = 'webilinkregister2011';

		if(!$mail->Send()) {
			//echo 'Error: ' . $mail->ErrorInfo;
		}
		else {
			//echo "Success";
		}		
	}
	
	// Random pass active by pratipan.bs@gmail.com
	function rand_str($length = 10, $chars = 'abcdefghijklmnopqrstuvwxyz1234567890')
	{    
		$chars_length = (strlen($chars) - 1);    
		$string = $chars{rand(0, $chars_length)};   
		for ($i = 1; $i < $length; $i = strlen($string))
		{        
			$r = $chars{rand(0, $chars_length)};      
			if ($r != $string{$i - 1}) $string .=  $r;
		}   
		return $string;
	}

?>