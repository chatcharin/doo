<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<?
$id_edit = $_POST['id_edit'];
$name = $_POST['name'];
$type = $_POST['type'];
$title = $_POST['title'];
$price = $_POST['price'];
$manage = $_POST['manage'];
$tel = $_POST['tel'];
$web = $_POST['web'];
$email = $_POST['email'];
$feature = $_POST['feature'];
$description = $_POST['description'];
$date = date("d-m-Y H:i:s");
$province = $_POST['e_province1'];
$amphur = $_POST['e_amphur1'];


include "../config.php";

$query = "select * from tb_project where id_project='$id_edit' ";
$id_project = mysql_query($query) or die(mysql_error());
$row_rs = mysql_fetch_assoc($id_project);
$id_project = $row_rs['id_project'];

$sql = "update tb_project set  
			name_pro='$name' ,
			type_pro='$type' ,
			title_pro='$title' ,
			price='$price' ,
			manage='$manage' ,
			tel='$tel',
			web='$web',
			email='$email',
                                                            prov ='$province',
                                                            amp = '$amphur',
			feature='$feature',
			descrip='$description',
			date='$date'
			where id_project='$id_edit' ";
$result = mysql_query($sql);


if ($result) {
    echo("<meta http-equiv='refresh' content='0;URL=add_Project.php'>");
} else {
    echo "<H3>ERROR : ไม่สามารถแก้ไขข้อมูลได้</H3>";
}
mysql_close();
?>