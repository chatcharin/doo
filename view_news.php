<?  require_once('config.php');
$sql="select * from tb_news order by id_news desc LIMIT 4 ";
$result=mysql_query($sql);
$number=mysql_num_rows($result);
?>
 <div id="content1">
		<h1 id="red">บทความเกี่ยวกับบ้าน</h1>
    
	<?  while($rs=mysql_fetch_array($result)) {
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
		
	<?php } ?>						
						<div id="clear"></div>
					<div id="link_news_All"><a href="view_news_all.php" class="view_news" >ดูบทความทั้งหมด</a></div>
				</div><!--end content1 -->
             


						
					
     	

