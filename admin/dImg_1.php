<?php

$name_del = $_GET['name_del'];
include '../config.php';
$result = mysql_query("delete from tb_image where name_img='$name_del'");
if ($result) {
    if (file_exists("../postphoto/$name_del")) {
        unlink("../postphoto/$name_del");
    } else {
        echo $name_del;
    }
}
?>

