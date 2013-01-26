<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?
$date=date("d-m-Y");
$time=date("H:i:s");
$request=$_POST['request'];
$name=$_POST['name'];
$email=$_POST['email'];
$question=$_POST['question'];
$id_project=$_POST['id_project'];

require_once('../config.php');
$SQL="INSERT INTO tb_question
values('','$id_project','$name','$request','$email','$question','$date','$time') "; 
$dbquery = mysql_query($SQL) or die(mysql_error());

if($dbquery<>0)
{   
	echo"<script>alert('ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว')</script>";
	echo"<meta http-equiv='refresh' content='0;URL=../detail_project.php?id_pro=$id_project'>";
} else {
	echo "<H3>ERROR : ไม่สามารถแสดงความคิดเห็นได้</H3>";
}	
mysql_close();
?>