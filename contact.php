<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/css.css"  />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/TTF_400-TTF_700.font.js" type="text/javascript"></script>
<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.js"></script>
<title>home property lanna</title>
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
			<div id="main_all">
				<div id="content_all">
				<h1 id="white_green"> ติดต่อสอบถาม แจ้งปัญหาการใช้งาน </h1>
					<div id="contact">
					<div id="contact_detail"><img src="images/logo_property.png" width="205" height="75" /><br /><br />
                    ติดต่อสอบถามหรือแจ้งปัญหาการใช้งานได้ที่<br /><br />

						<strong>ฝ่ายขาย</strong><br />
						<strong>โทรศัพท์ : 088-259-0382 (9.00 - 18.00 น.)</strong><br />
						Email : sale@propertylanna.com<br/>
                        website : www.propertylanna.com<br/><br/>
						หรือ ส่งคำถามของคุณโดยกล่องข้อความด้านขวา<br /> <br /> 
                    	<p class="notice">ที่อยู่สำนักงาน : 23/5 ถนน เจริญประเทศ ตำบล ช้างคลาน อำเภอเมือง จังหวัดเชียงใหม่ 50100
                     
                   
                    </p>
                    </div>
					<div id="contact_form">
                    <form action="check/get_problem.php" method="post" id="form_contact">
						<p>ชื่อของคุณ :<br/><input type="text" name="prob_name" id="prob_name" class="text">*</p>
						<p>อีเมลของคุณ :<br/><input type="text" name="prob_email" id="prob_email" class="text">*</p>
						<p>เบอร์ติดต่อ :<br/><input type="text" name="prob_tel" id="prob_tel" class="text">*</p>
						<p>ข้อความ :<br/><textarea rows="5" name="prob_area" id="prob_area" cols="50" class="text"></textarea>*</p>
						<p><input type="submit" value="ส่งข้อความ" class="sent"/></p> </form>
				   </div>
				   <div id="clear"></div>
			       </div>
				</div><!--end content_all -->  
			</div>
			<div id="clear"></div>
		</div><!--end wrap -->
	</div><!--end all -->
		<?php include("footer.php");?>
</body>
</html>

