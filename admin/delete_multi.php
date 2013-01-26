<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<?
$id_del=$_GET['id_del'];

include "../config.php";
		$sql3="select * from tb_multi where id_multi='$id_del' ";
		$result3=mysql_query($sql3);
		$rs=mysql_fetch_array($result3);
		$name=$rs['name'];
		unlink("upload/$name");
		unlink("../upload/$name");
		
$sql="delete from tb_multi where id_multi='$id_del' ";
$result=mysql_query($sql);


if ($result) {
	echo("<meta http-equiv='refresh' content='0;URL=multi.php'>");
} else {
	echo "<H3>ERROR : ไม่สามารถลบสินค้าได้</H3>";
}
mysql_close();
?>
