<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<?
$date=date("d-m-Y");

$fileupload=$_FILES['fileupload']['tmp_name'];
$fileupload_name=$_FILES['fileupload']['name'];
$fileupload_size=$_FILES['fileupload']['size'];
$fileupload_type=$_FILES['fileupload']['type'];

include "../config.php";

$sql="INSERT INTO tb_multi  values('','','','$fileupload_size','$date') ";
$result=mysql_query($sql);
			
if ($fileupload) {
	$array_last=explode(".",$fileupload_name);
	$c=count($array_last)-1; 
	$lastname=strtolower($array_last[$c]) ;
	
	if ($lastname=="gif" or $lastname=="png" or $lastname=="jpg" or $lastname=="doc" or $lastname=="docx" or $lastname=="ppt" or $lastname=="pptx" or$lastname=="xls"or $lastname=="xlsx" or $lastname=="swf" or $lastname=="pdf" or $lastname=="mp3" or $lastname=="avi" or $lastname=="mpeg" or $lastname=="txt" or $lastname=="wav" or $lastname=="wma" or $lastname=="wmv" or $lastname=="rar" or $lastname=="zip") {

		$query="select * from tb_multi order by id_multi desc";
		$id_multi = mysql_query($query) or die(mysql_error());
		$row_rs= mysql_fetch_assoc($id_multi);
		$id_multi=$row_rs['id_multi'];

		$photoname=$id_multi.".".$lastname;
		copy($fileupload,"upload/up_".$photoname);
		copy($fileupload,"../upload/up_".$photoname);

		$sql3="update tb_multi set name='up_$photoname', path='upload/up_$photoname'  where id_multi ='$id_multi' ";
		$result3=mysql_query($sql3);
	}
	else { 
		$query="select * from tb_multi order by id_multi desc";
		$id_multi = mysql_query($query) or die(mysql_error());
		$row_rs= mysql_fetch_assoc($id_multi);
		$id_multi=$row_rs['id_multi'];

		$photoname=$id_multi."_".$fileupload_name;
		copy($fileupload,"upload/up_".$photoname);
		copy($fileupload,"../upload/up_".$photoname);

		$sql3="update tb_multi set name='up_$photoname', path='upload/up_$photoname'  where id_multi ='$id_multi' ";
		$result3=mysql_query($sql3);
	
	 }
	 unlink($fileupload);
}

			
if ($result) {
	echo"<script>alert('บันทึกไฟล์เรียบร้อยแล้ว')</script>";
	echo("<meta http-equiv='refresh' content='0;URL=multi.php'>");
} else {
	echo "<H3>ERROR : ไม่สามารถแก้ไขข้อมูลได้</H3>";
}
mysql_close();
?>