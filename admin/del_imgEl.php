<?php


$name_del = $_GET['name_del'];
include '../config.php';
$sql = "update tb_project set img_pro='' where img_pro = '$name_del'";
mysql_query($sql);
if (file_exists("photo/$name_del")) {
    unlink("photo/$name_del");
    echo "File $name_del ถูกลบเรียบร้อยแล้ว !!";
} else {
    echo "เกิดข้อผิดผลาดเกี่ยวกับ Directory File !!!";
}
mysql_close();
?>
