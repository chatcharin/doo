<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?
$date=date("d-m-Y");
$time=date("H:i:s");
$request=$_POST['request'];
$name=$_POST['name'];
$email=$_POST['email'];
$comment=$_POST['comment'];
$id_gen=$_POST['id_gen'];

require_once('../config.php');
$SQL="INSERT INTO tb_comment
values('','$id_gen','$request','$name','$email','$comment','$date','$time') "; 
$dbquery = mysql_query($SQL) or die(mysql_error());

if($dbquery<>0)
{
	echo"<script>alert('ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว')</script>";
	echo"<meta http-equiv='refresh' content='0;URL=../post_view.php?id_gen=$id_gen'>";
} else {
	echo "<H3>ERROR : ไม่สามารถแสดงความคิดเห็นได้</H3>";
}	
mysql_close();
?>