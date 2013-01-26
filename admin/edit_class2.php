<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<?
$id_edit=$_POST['id_edit'];
$name=$_POST['name'];
$nameen=$_POST['nameen'];
$shot=$_POST['shot'];

include "../config.php";

		$query="select * from tb_class where id_class='$id_edit' ";
		$id_class = mysql_query($query) or die(mysql_error());
		$row_rs= mysql_fetch_assoc($id_class);
		$id_class=$row_rs['id_class'];
		
			$sql="update tb_class set  
			name_class='$name' , name_classen='$nameen' , shot='$shot' where id_class='$id_edit' ";
			$result=mysql_query($sql);
			
if ($result) {
	echo"<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
	echo("<meta http-equiv='refresh' content='0;URL=add_class.php'>");
} else {
	echo "<H3>ERROR : ไม่สามารถแก้ไขข้อมูลได้</H3>";
}
mysql_close();
?>