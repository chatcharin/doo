<?php

$name_del = $_GET['name_del'];
include '../config.php';
$sql = "delete from img_pro where name_img = '$name_del'";
mysql_query($sql);
if (file_exists("project/$name_del")) {
    unlink("project/$name_del");
    echo "File $name_del ถูกลบเรียบร้อยแล้ว !!";
} else {
    echo "เกิดข้อผิดผลาดเกี่ยวกับ Directory File !!!";
}
mysql_close();

?>
