<?  require_once('config.php');
$sql="select * from tb_project order by id_project desc LIMIT 6 ";
$result=mysql_query($sql);
$number=mysql_num_rows($result);
?>
<div id="content1">
	<h1 id="green">บ้านในโครงการ</h1>
    
	<?  while($rs=mysql_fetch_array($result)) {
		$id_project=$rs['id_project'];
		$name_pro=$rs['name_pro'];
		$price=$rs['price'];
		$img_pro=$rs['img_pro'];
		
		?>
        <div id="project">
							<div>
                            <a href="detail_project.php?id_pro=<?=$id_project;?>">
                            <?php  if ($img_pro=="")  {	?>
								<img src="images/default_project.jpg" title="<?=$name_pro;?>" border="0" width="180" height="135"  />
                            <?php  }else {  ?>
                                <img src="admin/photo/<?=$img_pro;?>" title="<?=$name_pro;?>" border="0"  width="180" height="135" />							                            <?php  } ?> 
                                </a> 
                                                       
								<span class="price_tag">เริ่มต้น <?=$price;?> บาท</span>
							</div>
							<a class="box_link" href="detail_project.php?id_pro=<?=$id_project;?>"><?=$name_pro;?></a>
		</div>	
	<?php } ?>						
						<div id="clear"></div>
					<div id="link_project_All"><a href="view_projectall.php" class="view_project" >ดูบทความทั้งหมด</a></div>
				</div><!--end content1 -->
             
                    
						
						
					
             
             
             
