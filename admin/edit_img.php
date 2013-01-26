<?php


//variable
$num = $_POST['num'];
$id = $_POST['id'];
$imgT = $_POST['imgT'];
for ($i = 0; $i < $num; $i++) {
    $img[$i] = $_POST['img' . $i];
}


//logo
$lastName = explode(".", $imgT);
$logo = "pro_" . $id . "." . $lastName[1];
$file_up = "picture_title." . $lastName[1];
include '../config.php';
$sql = "update tb_project set img_pro='$logo' where id_project='$id'";
$result = mysql_query($sql);
if ($result) {
    copy("temp/" . $file_up, "photo/" . $logo);

    //img
    $sql = "select * from img_pro where id_project='$id'";
    $result = mysql_query($sql);
    $number = mysql_num_rows($result);
    $i = 0;
    while ($rc = mysql_fetch_array($result)) {
        $name_images = $rc['name_img'];
        mysql_query("update img_pro set name_img='$img[$i]' where name_img='$name_images'");
        $i++;
    }
    if ($number < 14) {
        for ($i = $number; $i < $num; $i++) {
            if ($img[$i] != "") {
                $imgName = $id . "_" . $img[$i];
                mysql_query("insert into img_pro values('','$id','$imgName')");
                copy("temp/" . $img[$i], "project/" . $imgName);
                unlink("temp/" . $img[$i]);
            }
        }
    }
}
?>
