<?
$id_gen = $_GET['id_gen'];

include "config.php";

$query = "select * from tb_general where id_gen='$id_gen' ";
$id_gen = mysql_query($query) or die(mysql_error());
$row_rs = mysql_fetch_assoc($id_gen);
$id_gen = $row_rs['id_gen'];
$counter = $row_rs['counter'];
$cou = $counter + 1;

$sql = "update tb_general set  
			counter='$cou' where id_gen='$id_gen' ";
$result = mysql_query($sql);
?>
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
    <style type="text/css">
        #map_canvas {
            width:450px;
            height:120px;
        }
    </style>
    <script stype="text/javascript">
        $(document).ready(function(){
            $.ajax({
                type:"POST",
                url:"get_marker.php",
                data:"id=" + <?= $id_gen ?>,
                success:function(marker){
                    $('#map_canvas').html("<img title='คลิกเพือดูแผนที่' style='border:5px solid #ccc;cursor:pointer;' src='http://maps.google.com/staticmap?center="+marker+"&amp;zoom=7&amp;size=500x100&amp;maptype=roadmap&amp;markers="+marker+"&amp;key=AIzaSyAUf3LAxep-Yce9tOPTWsjintjII3dyxIQ'/>"); 
                    
                }
            });
            $('#map_canvas').hover(function(){
                $(this).children().css('border','5px solid #3399ff');
            },function(){
                $(this).children().css('border','5px solid #ccc');
            });
            $('#map_canvas').click(function(){
                window.location="map_google.php?id=<?= $id_gen ?>";
            });
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
				 <?
        require_once('config.php');
        $sql1 = "select * from tb_general where id_gen='$id_gen'";
        $result1 = mysql_query($sql1);
        $number = mysql_num_rows($result1);

        while ($rs = mysql_fetch_array($result1)) {
            $id_gen = $rs['id_gen'];
            $id_user = $rs['id_user'];
            $topic = $rs['topic'];
            $id_class = $rs['id_class'];
            $id_type = $rs['id_type'];
            $price = $rs['price'];
            $id_unit = $rs['id_unit'];
            $rai = $rs['rai'];
            $ngan = $rs['ngan'];
            $tarang = $rs['tarang'];
            $date = $rs['date'];
            $counter = $rs['counter']; {
                $sql2 = "select * from tb_type where id_type='$id_type' ";
                $result2 = mysql_query($sql2);
                $rs2 = mysql_fetch_array($result2);
                $id_type = $rs2['id_type'];
                $name_type = $rs2['name_type'];

                $sql2 = "select * from tb_class where id_class='$id_class' ";
                $result2 = mysql_query($sql2);
                $rs2 = mysql_fetch_array($result2);
                $id_class = $rs2['id_class'];
                $name_class = $rs2['name_class'];
            } {
                $sql4 = "select * from tb_location where id_gen='$id_gen' ";
                $result4 = mysql_query($sql4);
                $rs4 = mysql_fetch_array($result4);
                $amphur = $rs4['amphur'];

                $sql4 = "select * from amphur where AMPHUR_ID='$amphur' ";
                $result4 = mysql_query($sql4);
                $rs4 = mysql_fetch_array($result4);
                $AMPHUR_NAME = $rs4['AMPHUR_NAME'];
            } {
                $sql5 = "select * from tb_location where id_gen='$id_gen' ";
                $result5 = mysql_query($sql5);
                $rs5 = mysql_fetch_array($result5);
                $province = $rs5['province'];
                $lat = $rs5['lat'];
                $lng = $rs5['lng'];

                $sql5 = "select * from province where PROVINCE_ID='$province' ";
                $result5 = mysql_query($sql5);
                $rs5 = mysql_fetch_array($result5);
                $PROVINCE_NAME = $rs5['PROVINCE_NAME'];
            } {
                $sql7 = "select * from tb_location where id_gen='$id_gen' ";
                $result7 = mysql_query($sql7);
                $rs7 = mysql_fetch_array($result7);
                $tambon = $rs7['tambon'];

                $sql7 = "select * from district where DISTRICT_ID='$tambon' ";
                $result7 = mysql_query($sql7);
                $rs7 = mysql_fetch_array($result7);
                $DISTRICT_NAME = $rs7['DISTRICT_NAME'];
            } {
                $sql9 = "select * from tb_contact where id_gen='$id_gen' ";
                $result9 = mysql_query($sql9);
                $rs9 = mysql_fetch_array($result9);
                $name = $rs9['name'];
                $email = $rs9['email'];
                $tel = $rs9['tel'];
            }
            $sql6 = "select * from tb_image where id_gen='$id_gen'";
            $result6 = mysql_query($sql6);
            $rs6 = mysql_fetch_array($result6);
            $name_img = $rs6['name_img'];
            ?>         
                 <div id="content1">
					<h4><?= $topic; ?></h4>
					<h3  ><span>1</span>ข้อมูลประกาศ</h3>
						<table width="100%">
						  <tbody>
							<tr>
							  <td class="label">ประเภทประกาศ</td>
									<td class="value"><strong> <?= $name_class; ?>&nbsp;<?= $name_type; ?><br />บริเวณ ตำบล&nbsp;<?= $DISTRICT_NAME; ?> อำเภอ&nbsp;<?= $AMPHUR_NAME; ?> จังหวัด&nbsp;<?= $PROVINCE_NAME; ?></strong></td>
								</tr>
								<tr>
									<td class="label">รหัสเลขที่ประกาศ</td>
									<td class="value"><?= $id_user; ?><?= $id_gen; ?><?= $id_type; ?></td>
								</tr>
							<tr>
							  <td class="label">สถานที่ตั้ง</td>
									<td class="value">อำเภอ&nbsp;<?= $AMPHUR_NAME; ?> จังหวัด&nbsp;<?= $PROVINCE_NAME; ?>
										
											<div id="map_canvas"></div>
										
							  </td>
								</tr>
							<tr><td class="label">ขนาดที่ดิน</td><td class="value"><?= $rai; ?>&nbsp;ไร่&nbsp;<?= $ngan; ?>&nbsp;งาน&nbsp;<?= $tarang; ?>&nbsp; ตร.ว.</td></tr>
							<tr><td class="label">ราคาขาย</td><td class="value"><?= $price; ?></td>
								</tr>
                                <tr><td class="label">&nbsp; </td><td class="value"><a id="print" href="#" target="_blank">พิมพ์ใบประกาศ</a></td>
								</tr>
						  </tbody>
			  </table>
					<h3 ><span>2</span>รูปภาพประกอบ</h3>
						<div class="pikachoose">
                <ul id="pikame" class="jcarousel-skin-pika">    
                    <?
                    $sql8 = "select * from tb_image where id_gen='$id_gen' ";
                    $result8 = mysql_query($sql8);
                    $number = mysql_num_rows($result8);
                    if ($number == '0') {
                        echo "<div align='center'><img src='images/default_thumbnails.gif' border='0' width='200' height='150'/></div>";
                    } else {
                        while ($rs8 = mysql_fetch_array($result8)) {
                            $id_gen = $rs8['id_gen'];
                            $name_img = $rs8['name_img'];
                            ?>		 
                            <li><img src="postphoto/<?= $name_img; ?>" border="0" /></li>
                            <?
                        }
                    }
                    ?>	
                </ul>
            </div>
           <h3 ><span>3</span>รายละเอียดเพิ่มเติม</h3>
            <?
            $sql8 = "select * from tb_detail where id_gen='$id_gen' ";
            $result8 = mysql_query($sql8);
            $rs8 = mysql_fetch_array($result8);
            $detail = $rs8['detail'];

            if ($detail == "") {?>
                <div id="detail_more">  ไม่มีข้อมูล </div>
            <? } else { ?>                
                <div id="detail_more"><?= $detail; ?> </div>
            <? } ?>	
					
						
			<h3 ><span>4</span>ข้อมูลผู้ลงประกาศ</h3>
							<table width="100%">
							<tbody>
								<tr>
									<td class="label">ผู้ลงประกาศ</td>
									<td class="value"><?= $name; ?></td>
								</tr>
								<tr>
									<td class="label">เบอร์โทรศัพท์ติดต่อ</td>
									<td class="value"><?= $tel; ?></td>
								</tr>
								<tr>
									<td class="label">อีเมล</td>
									<td class="value"><?= $email; ?></td>
								</tr>
								<tr><td class="label">แก้ไขล่าสุด</td>
								<td class="value"><?= $date; ?></td></tr>
							</tbody>
						</table>
                         <? } ?>
                         <!--ตอบกระทู้ -->

        <h3 id="pink">สอบถามข้อมูล</h3>
			<div id="comment">
            	<div id="comment_form">
                <form action="check/comment.php" method="post" id="form_comment" >
                <table width="750" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                    	<p>
                            <select name="request" id="request"/>
                            <option value="สนใจซื้อ">สนใจซื้อ</option>
                            <option value="ต้องการข้อมูลเพิ่มเติม">ต้องการข้อมูลเพิ่มเติม</option>
                            <option value="ขอโบว์ชัว">ขอโบว์ชัว</option>
                            <option value="ขอเข้าชม">ขอเข้าชม</option>
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
                <textarea rows="6" name="comment" id="comment" cols="40" class="text"></textarea></p>
            <input type="submit" value="ส่งคำถาม" class="sent"/></p>
            <input type="hidden" name="id_gen" value="<? echo $id_gen; ?>" />
                    </td>
                  </tr>
                </table> 
        </form>	
                </div>
            </div>
            
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
