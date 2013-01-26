
<?

$amphur = $_POST['amphur'];
$province = $_POST['province'];
$num = $_POST['num'];
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
$upload = $_POST['upload'];
echo $num;
for ($i = 0; $i < $num; $i++) {
    $img[$i] = $_POST['img' . $i];
}

include "../config.php";
$sql = "INSERT INTO tb_project values('','$name','$type','$title','$price','$manage','$tel','$web','$email','$province','$amphur','$feature','$description','$date','') ";
$result = mysql_query($sql);
if ($result) {
    $query = "select * from tb_project order by id_project desc";
    $id_project = mysql_query($query) or die(mysql_error());
    $row_rs = mysql_fetch_assoc($id_project);
    $id_project1 = $row_rs['id_project'];
    if ($upload != '') {
        $lastName = explode(".", $upload);
        $img_name = "pro_" . $id_project1 . "." . $lastName[1];
        copy("temp/$upload", "photo/$img_name");
        mysql_query("update tb_project set img_pro='$img_name' where id_project='$id_project1' ");
    }
    for ($i = 0; $i < $num; $i++) {
        $myPictureName = $id_project1 . "_" . $img[$i];
        mysql_query("insert into img_pro values('','$id_project1','$myPictureName')");
        copy("temp/" . $img[$i], "project/" . $myPictureName);
        unlink("temp/" . $img[$i]);
    }
}
mysql_close();
?>
