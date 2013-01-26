<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/css.css"  />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<link type="text/css" href="slide/bottom.css" rel="stylesheet" />
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/TTF_400-TTF_700.font.js" type="text/javascript"></script>
<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.js"></script>
<script type="text/javascript" src="slide/jquery.pikachoose.js"></script>
<script language="javascript">
			$(document).ready(
				function (){
					$("#pikame").PikaChoose({carousel:true,carouselOptions:{wrap:'circular'}});
				});
</script>
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
			<div id="main">
            	<div id="content1">
			<?  
$id_pro=$_GET['id_pro'];
require_once('config.php');
$sql="select * from tb_project where id_project='$id_pro' ";
$result=mysql_query($sql);
$number=mysql_num_rows($result);

	 while($rs=mysql_fetch_array($result)) {
		$id_project=$rs['id_project'];
		$name_pro=$rs['name_pro'];
		$type_pro=$rs['type_pro'];
		$title_pro=$rs['title_pro'];
		$price=$rs['price'];
		$manage=$rs['manage'];
		$tel=$rs['tel'];
		$web=$rs['web'];
		$email=$rs['email'];
		$feature=$rs['feature'];
		$descrip=$rs['descrip'];
		$date=$rs['date'];
		$img_pro=$rs['img_pro'];
		?>
        <h3 id="white_green"><?=$name_pro;?></h3>
        <p><em><?=$title_pro;?></em></p> 
        <p><em>เริ่มต้นที่ : <?=$price;?></em></p>
      <!--  <p align="center"> -->
           <? // if ($img_pro=="")  {	?>
           <? // }else {  ?>
                <!--<img src="admin/photo/<? //=$img_pro;?>" border="0" width='180px' /> -->
           <? // }	?> 
      <!-- </p> -->
       <div class="pikachoose">
        <ul id="pikame" class="jcarousel-skin-pika">                
            <?
				$sql2 = "select * from img_pro where id_project='$id_project'";
                $result2 = mysql_query($sql2);
                $number = mysql_num_rows($result2);
								
            if ($number == '0') {
                echo "<div align='center'><img src='images/default_thumbnails.gif' border='0' width='200' height='150'/></div>";
            } else {
                while ($rs2 = mysql_fetch_array($result2)) {
						$id_imgpro = $rs2['id_imgpro'];
                		$name_img = $rs2['name_img'];
                    ?>		 
                    <li><img src="admin/project/<?= $name_img; ?>" border="0" /></li>
                    <?
                }
            }
            ?>	
        </ul>
	</div>
    <h3  >รายละเอียดโครงการ</h3>
						<table width="100%">
						  <tbody>
							<tr>
							  <td class="label">Feature</td>
									<td class="value"><?=$feature;?></td>
								</tr>
								<tr>
									<td class="label">ชื่อโครงการ  </td>
									<td class="value"><?=$name_pro;?></td>
								</tr>
							<tr>
							  <td class="label">ประเภทโครงการ  </td>
								<td class="value"><?=$type_pro;?></td>
								</tr>
							<tr>
                            	<td class="label">ดำเนินการโดย </td>
                            	<td class="value"> <?=$manage;?></td></tr>
							<tr>
                            	<td class="label">ติดต่อ </td>
                            	<td class="value"> <?=$tel;?></td>
								</tr>
                           <?  if ($email<>"")  { ?>
                            <tr>
								<td class="label">อีเมล์ </td>
                            	<td class="value"> <?=$email;?></td>
                             </tr>
                            <?php } ?>
                            <?  if ($web<>"")  { ?>
							<tr>
                            	<td class="label">เว็บไซต์ </td>
                            	<td class="value"> <?=$web;?></td>
						     </tr>
                             <?php } ?>
                             <tr>
                            	<td class="label"> รายละเอียดเพิ่มเติม </td>
                            	<td class="value"> <?=$descrip;?></td>
								</tr>
                                
						  </tbody>
			  </table>
                        
			<h3 id="pink">สอบถามข้อมูล</h3>
			<div id="comment">
            	<div id="comment_form">
                <form action="check/project.php" method="post" id="form_comment" >
                <table width="750" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                    	<p>
                            <select name="request" id="request"/>
                            <option value="สนใจซื้อ">สนใจซื้อ</option>
                            <option value="ต้องการข้อมูลเพิ่มเติม">ต้องการข้อมูลเพิ่มเติม</option>
                            <option value="ขอโบว์ชัวโครงการ">ขอโบว์ชัวโครงการ</option>
                            <option value="ต้องการขอเข้าชมโครงการ">ต้องการขอเข้าชมโครงการ</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                        </p>
                        <p> ชื่อ :<br/><input name="name" type="text" class="text" id="name" > </p>
                        <p> เบอร์ติดต่อ :<br/><input name="name" type="text" class="text" id="name"  maxlength="10">
                        </p>
                        <p>	อีเมล :<br/><input name="email" type="text" class="text" id="email" ></p>
                    </td>
                    <td>
                    	<p> ข้อความ : <br/>
                <textarea rows="6" name="question" id="question" cols="40" class="text"></textarea></p>
            <input type="submit" value="ส่งคำถาม" class="sent"/></p>
            <input type="hidden" name="id_gen" value="<? echo $id_project; ?>" />
                    </td>
                  </tr>
                </table> 
        </form>	
                </div>
            </div>
	
	<?php } ?>					
        
        
             <div id="clear"></div>	
             </div>    
			</div>
            <div id="right">
				<?php include("banner_right.php");?>
			  	<?php include("service_facebook.php");?>
				<?php include("service_bank.php");?>
				<?php include("service_thai.php");?>
			</div><!--end right -->
			<div id="clear"></div>
		</div><!--end wrap -->
	</div><!--end all -->
		<?php include("footer.php");?>
</body>
</html>





						
						
