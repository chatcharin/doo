<?
$name=$_POST['name'];
$nameen=$_POST['nameen'];
$shot=$_POST['shot'];
 if ($name=="") {
	echo "กรุณากรอกชื่อประเภทประกาศ";
	echo "<meta http-equiv='refresh' content='1;URL=add_class.php'>";exit();
	
}
require_once('../config.php');
$sql="INSERT INTO tb_class VALUES('','$name','$nameen','$shot')";
$result=mysql_query($sql);

if ($result) {
	echo "<script>alert('ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว')</script>";
	echo "<meta http-equiv='refresh' content='0;URL=add_class.php'>";
} else {
	echo "<H3>ERROR : ไม่สามารถเพิ่มประเภทสินค้าได้</H3>";
}	
mysql_close();
?>