<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php

function upimg($img, $imglocate) {

    global $file_up;
    if ($img['name'] != '') {
        $fileupload1 = $img['tmp_name'];
        $lastName = explode(".", $img['name']);
        include '../config.php';
        $sql = "select * from tb_count";
        $result = mysql_query($sql);
        while ($rc = mysql_fetch_array($result)) {
            $count = $rc['name_count'];
        }
        if ($count < 100) {
            $count++;
            mysql_query("update tb_count set name_count = '$count' where id_count ='1'");
        } else {
            $count = 1;
            mysql_query("update tb_count set name_count = '$count' where id_count ='1'");
        }
        $file_up = $count . "." . $lastName[1];
        if ($fileupload1) {
            $array_last = explode(".", $file_up);
            $c = count($array_last) - 1;
            $lastname = strtolower($array_last[$c]);
            if ($lastname == "gif" or $lastname == "jpg" or $lastname == "jpeg" or $lastname == "png") {
                copy($fileupload1, $imglocate . $file_up);
            }
        }
        mysql_close();
    }
}

if ($_FILES['file']['name'] != "") {

    upimg($_FILES['file'], "../temp/");
    echo "<script language=\"javascript\">";
    echo "var pl=top.document.getElementById('img_area');";
    echo "pl.innerHTML+=\"<img src='../temp/$file_up' width='120' height='130' title='$file_up' alt='$file_up' /><span style='cursor:pointer;' onclick='delMyImg1(this);''>ลบ</span>\";";
    echo "top.document.form1.action='';";
    echo "top.document.form1.target='';";
    echo "</script>";
    echo "<meta http-equiv=\"Refresh\" content=\"0;URL=uImg?d_img=" . $file_up . "\" />";
}
?>
<?php
//if ($_GET['d_img'] != "") {
//          unlink("temp/" . $_GET['d_img']);
//}
?>


