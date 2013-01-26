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
			<div id="main">
            	<div id="content1">
<? 
//$id_type_select = $_GET['id_type'];
 $prov_id = isset($_REQUEST['pro_id']) ? $_REQUEST['pro_id'] : 1;
 //echo $_REQUEST['type_id']."<br/>";
 $type_id_s = (trim($_REQUEST['type_id'])!="") ? " where id_type = '".$_REQUEST['type_id']."'" : "";
 $type_id_2 = (trim($_REQUEST['type_id'])!="") ? " and id_type = '".$_REQUEST['type_id']."' " : "";
 $class_id_s =(trim($_REQUEST['class_id'])!="") ? " and id_class = '".$_REQUEST['class_id']."' " : "";
 $province_s =(trim($_REQUEST['province'])!="") ? " where province = '".$_REQUEST['province']."' " : "";
 $district_s = (trim($_REQUEST['district'])!="") ? " and amphur = '".$_REQUEST['district']."' " : "";
 //echo $_REQUEST['class_id']."<br/>";
 //echo $_REQUEST['province']."<br/>";
 //echo $_REQUEST['district']."<br/>";
 //echo $_REQUEST['lowcost']."<br/>";
 //echo $_REQUEST['hicost']."<br/>";
 if(isset($_REQUEST['lowcost']))
    $lowcost_s = is_numeric($_REQUEST['lowcost']) ? " and price >= ".$_REQUEST['lowcost']." " : ""; 
 if(isset($_REQUEST['hicost']))
    $hicost_s = is_numeric($_REQUEST['hicost']) ? " and price <= ".$_REQUEST['hicost']." " : ""; 
?>
<?php 
// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){   
	global $urlquery_str;
	$pPrev=$chk_page-1;
	$pPrev=($pPrev>=0)?$pPrev:0;
	$pNext=$chk_page+1;
	$pNext=($pNext>=$total_p)?$total_p-1:$pNext;		
	$lt_page=$total_p-4;
	if($chk_page>0){  
		echo "<a  href='?s_page=$pPrev&urlquery_str=".$urlquery_str."' class='naviPN'>Prev</a>";
	}
	if($total_p>=11){
		if($chk_page>=4){
			echo "<a $nClass href='?s_page=0&urlquery_str=".$urlquery_str."'>1</a><a class='SpaceC'>. . .</a>";   
		}
		if($chk_page<4){
			for($i=0;$i<$total_p;$i++){  
				$nClass=($chk_page==$i)?"class='selectPage'":"";
				if($i<=4){
				echo "<a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";   
				}
				if($i==$total_p-1 ){ 
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";   
				}		
			}
		}
		if($chk_page>=4 && $chk_page<$lt_page){
			$st_page=$chk_page-3;
			for($i=1;$i<=5;$i++){
				$nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page=".intval($st_page+$i)."'>".intval($st_page+$i+1)."</a> ";   	
			}
			for($i=0;$i<$total_p;$i++){  
				if($i==$total_p-1 ){ 
				$nClass=($chk_page==$i)?"class='selectPage'":"";
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";   
				}		
			}									
		}	
		if($chk_page>=$lt_page){
			for($i=0;$i<=4;$i++){
				$nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page=".intval($lt_page+$i-1)."'>".intval($lt_page+$i)."</a> ";   
			}
		}		 
	}else{
		for($i=0;$i<$total_p;$i++){  
			$nClass=($chk_page==$i)?"class='selectPage'":"";
			echo "<a href='?s_page=$i&urlquery_str=".$urlquery_str."' $nClass  >".intval($i+1)."</a> ";   
		}		
	} 	
	if($chk_page<$total_p-1){
		echo "<a href='?s_page=$pNext&urlquery_str=".$urlquery_str."'  class='naviPN'>Next</a>";
	}
}   
?>

<? 
require_once('config.php');
if($type_id_s!=""){
$sql2="select name_type from tb_type ".$type_id_s;
$result2=mysql_query($sql2);
$rs2=mysql_fetch_array($result2);
//$name_type = $rs2['name_type'];
}else {
//$name_type = "ผลการค้นหาทั้งหมด";
}
?>
		<h1 id="blue">ผลการค้นหาทั้งหมด</h1>        
<?php
require_once('config.php');
if($province_s =="") 
   $q = "select * from tb_general where 1 ".$type_id_2.$class_id_s;
else 
   $q = "SELECT tb_general.* FROM tb_general inner join tb_location ON tb_general.id_gen=tb_location.id_gen ".$province_s.$district_s." ";
if($lowcost_s != "")
   $q.=$lowcost_s;
if($hicost_s != "")
   $q.=$hicost_s;

$q.= " ORDER BY id_gen desc ";
//echo $q;
$qr=mysql_query($q);
$total=mysql_num_rows($qr);
$e_page=15; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
$chk_page=1;
if(!isset($_GET['s_page'])){   
	$_GET['s_page']=0;   
}else{   
	$chk_page=$_GET['s_page'];     
	$_GET['s_page']=$_GET['s_page']*$e_page;   
}   
$q.=" LIMIT ".$_GET['s_page'].",$e_page";
$qr=mysql_query($q);
if(mysql_num_rows($qr)>=1){   
	$plus_p=('$chk_page*$e_page')+mysql_num_rows($qr);   
}else{   
	$plus_p=('$chk_page*$e_page');       
}   
$total_p=ceil($total/$e_page);   
$before_p=('$chk_page*$e_page')+1; 

if ($total<>0) {
      ?>
<div id="all_house_post">พบประกาศทั้งหมด <span> <?=$total;?> </span> ประกาศ  </div>	
	
	  <?
            $i = 0;
            while ($rs = mysql_fetch_array($qr)) {
                  $id_gen = $rs['id_gen'];
                  $id_user = $rs['id_user'];
                  $topic = $rs['topic'];
                  $id_type = $rs['id_type'];
				  $id_class = $rs['id_class'];
                  $date = $rs['date'];
                  $counter = $rs['counter'];
                  $price = $rs['price']; 
				  $id_unit = $rs['id_unit'];
				  $rai = $rs['rai'];
				  $ngan = $rs['ngan'];
				  $tarang = $rs['tarang'];
				  
				  {
                        $sql2 = "select name_type from tb_type where id_type='$id_type' ";
                        $result2 = mysql_query($sql2);
                        $rs2 = mysql_fetch_array($result2);
                        $name_type = $rs2['name_type'];
                  } 
				   {
				        $sql3      = "select * from tb_class where id_class='$id_class' ";
                        $result3   = mysql_query($sql3);
                        $rs3       = mysql_fetch_array($result3);
                        $name_class = $rs3['name_class'];
				  
				  }
				  {
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
								
								$sql5 = "select * from province where PROVINCE_ID='$province' ";
                        		$result5 = mysql_query($sql5);
                        		$rs5 = mysql_fetch_array($result5);
                        		$PROVINCE_NAME = $rs5['PROVINCE_NAME']; 
				  }
                        $sql6 = "select * from tb_image where id_gen='$id_gen' LIMIT 1";
                        $result6 = mysql_query($sql6);
                        $rs6 = mysql_fetch_array($result6);
                        $name_img = $rs6['name_img'];
               			
                  $i++;
                  ?>	
              <div id="all_house"> <!-- all_house_img --> 
				 <div id="all_house_img">
                            <?  if ($name_img=="")  {	?>
                            <a href="post_view.php?id_gen=<?=$id_gen;?>"/>
                            <img src="images/default_thumbnails.gif" border="0" title="<?=$topic;?>" alt="<?=$topic;?>" /> </a>
                            <?  }  else {  ?>
                            <a href="post_view.php?id_gen=<?=$id_gen;?>">
                            <img src="postphoto/<?=$name_img;?>" border="0" title="<?=$topic;?>" alt="<?=$topic;?>" width='110px' height='80px' /> </a>
                            <?	}	?> 
                             <span>รหัส &nbsp;<?=$id_gen;?><?=$id_type;?></span>
                </div><!-- all_house_img --> 
				 <div><a class="headerlink" href="post_view.php?id_gen=<?=$id_gen;?>">-<?=$name_class;?>-&nbsp;<?=$topic;?></a><img src="images/news.gif" width="22" height="9" /> <img src="images/update.gif" /></div>
						<div class="g">
							ประเภท : <?=$name_type;?> <br>
							จังหวัด : <?=$PROVINCE_NAME;?><br>
							อำเภอ : <?=$AMPHUR_NAME;?><br>
							ขนาดพื้นที่ : <?=$rai;?>&nbsp;ไร่&nbsp;<?=$ngan;?>&nbsp;งาน&nbsp;<?=$tarang;?>&nbsp;ตารางวา<br>
                        </div>
						<div class="g2">
							<span>ราคา: <?=$price;?></span> <br>
							แก้ไขเมื่อ : <?=$date;?><br>
							ผู้เข้าชม: <?=$counter;?><br>
							<a class="view" href="post_view.php?id_gen=<?=$id_gen;?>">ดูรายละเอียด</a>
                </div>
                         <div id="clear"></div>
					</div>

	<?php } } ?> 	
									
<?php if($total>0){ ?>
<div class="browse_page"  >		
<?	 
 page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);
?>
  </div>
  <div id="clear"></div>
<? }?>
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
     	

