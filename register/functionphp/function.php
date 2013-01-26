<?php	
	function showusers(){		
		$sql = "select * from iuser";
		$result = mysql_query($sql);	
		$users = array();
		while($rs = mysql_fetch_array($result)){
			array_push($users,$rs[1]);		
		}	
		return $users;
	}
	function showrooms(){
		$sql = "select * from createroom";
		$result = mysql_query($sql);
		$rooms = array();
		while($rs = mysql_fetch_array($result)){
			array_push($rooms,$rs[0]);
		}
		return $rooms;
	}
	//risize file pratipan.bs@gmail.com
	function resizephp($folder,$images){
		$height = 200; //กำหนดขนาดความสูง
		$size = getimagesize($folder.$images);
		$width = round($height*$size[0]/$size[1]); //ขนาดความกว้่างคำนวนเพื่อความสมส่วนของรูป		
		if($size[2] == 1) {	
			$images_orig = imagecreatefromgif($folder.$images); //resize รูปประเภท GIF
		} else if($size[2] == 2) {
			$images_orig = imagecreatefromjpeg($folder.$images); //resize รูปประเภท JPEG
		}else if($size[2] == 3){
			$images_orig = imagecreatefrompng($folder.$images); //resize รูปประเภท png
		}
		$photoX = imagesx($images_orig);
		$photoY = imagesy($images_orig);
		$images_fin = imagecreatetruecolor($width, $height);
		imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		imagejpeg($images_fin, $folder.$images); //ชื่อไฟล์ใหม่
		imagedestroy($images_orig);
		imagedestroy($images_fin);
	}
	//return date time
	function rdate(){
		return date("F j Y h:i a"); ;
	}
	//check ip
	function rip(){
		$ip=getenv(REMOTE_ADDR);		
		if (getenv(HTTP_X_FORWARDED_FOR))
			$ip=getenv(HTTP_X_FORWARDED_FOR);
		else
			$ip=getenv(REMOTE_ADDR);
		return $ip;
	}
?>