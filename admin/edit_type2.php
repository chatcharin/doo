<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<?
$id_edit=$_POST['id_edit'];

$name=$_POST['name'];
$nameen=$_POST['nameen'];

include "../config.php";

		$query="select * from tb_type where id_type='$id_edit' ";
		$id_type = mysql_query($query) or die(mysql_error());
		$row_rs= mysql_fetch_assoc($id_type);
		$id_type=$row_rs['id_type'];
		
			$sql="update tb_type set  
			name_type='$name' , name_typeen='$nameen' where id_type='$id_edit' ";
			$result=mysql_query($sql);
			
if ($result) {
	echo("<meta http-equiv='refresh' content='0;URL=add_type.php'>");
} else {
	echo "<H3>ERROR : ไม่สามารถแก้ไขข้อมูลได้</H3>";
}
mysql_close();
?>