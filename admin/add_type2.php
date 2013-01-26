<?
$name=$_POST['name'];
$nameen=$_POST['nameen'];
 if ($name=="") {
	echo "กรุณากรอกชื่อประเภทสินทรัพย์";
	echo "<meta http-equiv='refresh' content='1;URL=add_type.php'>";exit();
	
}
require_once('../config.php');
$sql="INSERT INTO tb_type VALUES('','$name','$nameen')";
$result=mysql_query($sql);

if ($result) {
	echo "<meta http-equiv='refresh' content='0;URL=add_type.php'>";
} else {
	echo "<H3>ERROR : ไม่สามารถเพิ่มประเภทสินค้าได้</H3>";
}	
mysql_close();
?>