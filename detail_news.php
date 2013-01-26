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
            	<?  require_once('config.php');
$id_news =  isset($_REQUEST['id_news']) ? $_REQUEST['id_news'] : 0;
$sql="select * from tb_news where id_news='$id_news' ";
$result=mysql_query($sql);
$number=mysql_num_rows($result);

	 while($rs=mysql_fetch_array($result)) {
		$id_news=$rs['id_news'];
		$name=$rs['name'];
		$detail=$rs['detail'];
		$photo=$rs['photo'];
		$date=$rs['date'];
		?>
					<h1><?=$name;?></h2>
						<p><em>Post in : <?=$date;?></em></p>
						<p align="center">
                            <?  if ($photo=="")  {	?>
                            
                            <?  }  else {  ?>
                            <img src="photo/<?=$photo;?>" border="0" width='492px' height='328px' />
                            <?	}	?> 
                        </p>
						<p> <?=$detail;?></p>
          
		
	<?php } ?>	
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

