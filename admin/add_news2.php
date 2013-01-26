<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$name=$_POST['name'];
$detail=$_POST['detail'];

$date=date("d-m-Y");

$fileupload=$_FILES['fileupload']['tmp_name'];
$fileupload_name=$_FILES['fileupload']['name'];
$fileupload_size=$_FILES['fileupload']['size'];
$fileupload_type=$_FILES['fileupload']['type'];

include "../config.php";
$sql="INSERT INTO tb_news values('','$name','$detail','','$date' ) ";
$result=mysql_query($sql);

if ($fileupload) {

	$array_last=explode(".",$fileupload_name);
	$c=count($array_last)-1; 
	$lastname=strtolower($array_last[$c]) ;
	
	if ($lastname=="gif" or $lastname=="jpg" or $lastname=="png") {

		$query="select * from tb_news order by id_news desc";
		$id_new = mysql_query($query) or die(mysql_error());
		$row_rs= mysql_fetch_assoc($id_new);
		$id_news=$row_rs['id_news'];

		$photoname=$id_news.".".$lastname;
		copy($fileupload,"photo/news_".$photoname);
		copy($fileupload,"../photo/news_".$photoname);

		$sql3="update tb_news set photo='news_$photoname' where id_news ='$id_news' ";
		$result3=mysql_query($sql3);

	} 
	unlink($fileupload);
} 
echo"<script>alert('ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว')</script>";
echo "<meta http-equiv='refresh' content='0;URL=add_news.php'>";

mysql_close();
?>
