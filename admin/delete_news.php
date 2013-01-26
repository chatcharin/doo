<?

$id_del=$_GET['id_del'];
$photo_del=$_GET['photo_del'];
$photo_del2=$_GET['photo_del'];

include "../config.php";
$sql="delete from tb_news where id_news='$id_del' ";
$result=mysql_query($sql);

if ($photo_del<>"") {
	unlink("photo/".$photo_del);
	$photo_del="../photo/".$photo_del;
	if (file_exists($photo_del)) {
		unlink($photo_del);
	}	
}

mysql_query($sql);


if ($result) {
	echo("<meta http-equiv='refresh' content='0;URL=add_news.php'>");
} else {
	echo "<H3>ERROR : ไม่สามารถลบสินค้าได้</H3>";
}
mysql_close();
?>