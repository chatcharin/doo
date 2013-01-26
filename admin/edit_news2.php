<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$id_edit=$_POST['id_edit'];
$name=$_POST['name'];
$detail=$_POST['detail'];
$photo=$_POST['photo'];
$date=date("d-m-Y");

$fileupload=$_FILES['fileupload']['tmp_name'];
$fileupload_name=$_FILES['fileupload']['name'];
$fileupload_size=$_FILES['fileupload']['size'];
$fileupload_type=$_FILES['fileupload']['type'];


include "../config.php";
if ($fileupload) {

	$array_last=explode(".",$fileupload_name);
	$c=count($array_last)-1; 
	$lastname=strtolower($array_last[$c]) ;
	
	if ($lastname=="gif" or $lastname=="jpg" or $lastname=="jpeg") {

		$photoname=$id_edit.".".$lastname;
		copy($fileupload,"photo/news_".$photoname);
		copy($fileupload,"../photo/news_".$photoname);

		$sql3="update tb_news set photo='news_$photoname' where id_news='$id_edit' ";
		$result3=mysql_query($sql3);
	} 
	unlink($fileupload);
} 

$sql="update tb_news set  
			name='$name',
			detail='$detail',
			date='$date' where id_news='$id_edit' ";
$result=mysql_query($sql);

if ($result) {
	echo "<meta http-equiv='refresh' content='0;URL=add_news.php'>";
} else {
	echo "$sql";
	echo "<H3>ERROR : ไม่สามารถแก้ไขข้อมูลได้</H3>";
}
mysql_close();
?>
