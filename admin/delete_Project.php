<?

$id_del = $_GET['id_del'];

include "../config.php";
//1
$sql3 = "select * from tb_project where id_project='$id_del' ";
$result3 = mysql_query($sql3);
$rs = mysql_fetch_array($result3);
$id_p = $rs['id_project'];
$img_pro = $rs['img_pro'];
unlink("photo/$img_pro");

//2
$sql = "select * from img_pro where id_project='$id_p' ";
$result = mysql_query($sql);
while ($rc = mysql_fetch_array($result)) {
    unlink("project/" . $rc['name_img'] . "");
}

//delete
$sql = "delete from img_pro where id_project='$id_p'";
if (mysql_query($sql)) {
    $sql = "delete from tb_project where id_project='$id_p' ";
    $result = mysql_query($sql);
}
if ($result) {
    echo("<meta http-equiv='refresh' content='0;URL=add_Project.php'>");
} else {
    echo "<H3>ERROR : ไม่สามารถลบสินค้าได้</H3>";
}
mysql_close();
?>