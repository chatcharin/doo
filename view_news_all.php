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
<?  require_once('config.php');
$q="select * from tb_news where 1";
$q.=" ORDER BY id_news desc ";
$qr=mysql_query($q);
$total=mysql_num_rows($qr);
$e_page=10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
$chk_page = 1;
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
<div id="content1">
	<h1 id="blue">บทความเรื่องบ้านทั้งหมด</h1>
    
	<?  
	    while($rs=mysql_fetch_array($qr)) {
		$id_news=$rs['id_news'];
		$name=$rs['name'];
		$detail=$rs['detail'];
		$photo=$rs['photo'];
		$date=$rs['date'];
		if(strlen($name)>40) {
			 mb_internal_encoding("UTF-8");
			 $name= mb_substr($name,0,40)."...";
		} 
		if(strlen($detail)>70) {
			 mb_internal_encoding("UTF-8");
			 $detail= mb_substr($detail,0,70)."...";
		}
		
	?>
        
         <div id="news">
							<div id="news_img">
                            <?  if ($photo=="")  {	?>
                            <a href="detail_news.php?id_news=<?=$id_news;?>" title="<?=$name;?>">
                            <img src="images/default_thumbnails_news.gif" border="0" width='127px' height='85px' /></a></div>
                            <?  }  else {  ?>
                            <a href="detail_news.php?id_news=<?=$id_news;?>" title="<?=$name;?>">
                            <img src="photo/<?=$photo;?>" border="0" width='127px' height='85px' /></a></div>
                            <?	}	?>
							<a class="header_news" href="detail_news.php?id_news=<?=$id_news;?>"><?=$name;?></a><br />
							<?=$detail;?>						
		</div>
		
	<?php } }?>						
<div id="clear"></div>						
<?php if($total>0){ ?>
<div class="browse_page">
<?	 
 page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);

?>
</div>
<div id="clear"></div>
<? } ?>
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



