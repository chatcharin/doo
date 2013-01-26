<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$id_del=$_GET['id_del']; 
include "../config.php";
					
$sql="select name_img from tb_image where id_gen='$id_del' ";
$result=mysql_query($sql);
while($r=mysql_fetch_array($result)) {
	$name_img=$r['name_img'];
	
	if (file_exists("../postphoto/$name_img")){
		unlink("../postphoto/$name_img");
	}
	if (file_exists("../postphoto/$name_img")){
		unlink("../postphoto/$name_img");
	}
}

$sql="delete from tb_image where id_gen='$id_del' ";
mysql_query($sql);
												
			$sql="delete from tb_general where id_gen='$id_del' ";
			$result=mysql_query($sql);
						
			$sql3="delete from  tb_location where id_gen='$id_del' ";
			$result=mysql_query($sql3);
			
			$sql4="delete from tb_detail where id_gen='$id_del' ";
			$result=mysql_query($sql4);
			
			$sql5="delete from  tb_contact where id_gen='$id_del' ";
			$result=mysql_query($sql5);
			


if ($result) {
	 echo("<meta http-equiv='refresh' content='0;URL=edit_post.php'>");
} else {
	echo "<H3>ERROR : ไม่สามารถลบสินค้าได้</H3>";
}
mysql_close();
?>