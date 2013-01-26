<?php

//1
$user_id = $_POST['user_id'];
$topic = $_POST['topic'];
$topicen = $_POST['topicen'];
$data_class = $_POST['data_class'];
$data_type = $_POST['data_type'];
$postPrice = $_POST['postPrice'];
$unit = $_POST['unit'];
$rai = $_POST['rai'];
$ngan = $_POST['ngan'];
$tarang = $_POST['tarang'];
$indate = date("d-m-Y");
$outdate = date("d-m-Y H:i:s", mktime(date("H"), date("i") + 0, date("s") + 0, date("m") + 3, date("d") + 0, date("Y") + 0));

//2
$postAddress = $_POST['postAddress'];
$postAddressen = $_POST['postAddressen'];
$postRoad = $_POST['postRoad'];
$postRoaden = $_POST['postRoaden'];
$postSoy = $_POST['postSoy'];
$postSoyen = $_POST['postSoyen'];
$postProvince = $_POST['postProvince'];
$postAmphur = $_POST['postAmphur'];
$postTambon = $_POST['postTambon'];
$marker_lat = $_POST['marker_lat'];
$marker_lng = $_POST['marker_lng'];
$locationData = $_POST['locationData'];
$locationDataen = $_POST['locationDataen'];

//3
$img1 = $_POST['img1'];
$img2 = $_POST['img2'];
$img3 = $_POST['img3'];
$img4 = $_POST['img4'];
$img5 = $_POST['img5'];
//4
$detailArea = $_POST['detailArea'];
$detailAreaen = $_POST['detailAreaen'];

//5
$postName = $_POST['postName'];
$postNameen = $_POST['postNameen'];
$postEmail = $_POST['postEmail'];
$postTel = $_POST['postTel'];


include '../../config.php';
//1
$sql = "insert into tb_general
values('','$user_id','$topic','$topicen','$data_class','$data_type','$postPrice','$unit','$rai','$ngan','$tarang','$indate','$outdate','0') ";
$result = mysql_query($sql);
if ($result) {
    //2
    $sql = "select id_gen from tb_general order by id_gen desc";
    $result = mysql_query($sql);
    $rc = mysql_fetch_assoc($result);
    $id_gen = $rc['id_gen'];
    $sql = "insert into tb_location 
      values  ('','$id_gen','$postAddress','$postAddressen','$postRoad','$postRoaden','$postSoy','$postSoyen','$postProvince','$postAmphur','$postTambon','$locationData','$locationDataen','$marker_lat','$marker_lng')";
    $result = mysql_query($sql);
    if ($result) {
        //3
        if ($img1 != '') {
            $sql = "insert into tb_image values('','$id_gen','$id_gen$id_gen$id_gen$img1')";
            if (mysql_query($sql)) {
                copy("../temp/$img1", "../../postphoto/" . $id_gen . $id_gen . $id_gen . $img1);
                unlink("../temp/$img1");
            }
        }
        if ($img2 != '') {
            $sql = "insert into tb_image values('','$id_gen','$id_gen$id_gen$id_gen$img2')";
            if (mysql_query($sql)) {
                copy("../temp/$img2", "../../postphoto/" . $id_gen . $id_gen . $id_gen . $img2);
                unlink("../temp/$img2");
            }
        }
        if ($img3 != '') {
            $sql = "insert into tb_image values('','$id_gen','$id_gen$id_gen$id_gen$img3')";
            if (mysql_query($sql)) {
                copy("../temp/$img3", "../../postphoto/" . $id_gen . $id_gen . $id_gen . $img3);
                unlink("../temp/$img3");
            }
        }
        if ($img4 != '') {
            $sql = "insert into tb_image values('','$id_gen','$id_gen$id_gen$id_gen$img4')";
            if (mysql_query($sql)) {
                copy("../temp/$img4", "../../postphoto/" . $id_gen . $id_gen . $id_gen . $img4);
                unlink("../temp/$img4");
            }
        }
        if ($img5 != '') {
            $sql = "insert into tb_image values('','$id_gen','$id_gen$id_gen$id_gen$img5')";
            if (mysql_query($sql)) {
                copy("../temp/$img5", "../../postphoto/" . $id_gen . $id_gen . $id_gen . $img5);
                unlink("../temp/$img5");
            }
        }

        //4
        $sql = "insert into tb_detail values('','$id_gen','$detailArea','$detailAreaen')";
        if (mysql_query($sql)) {
            //5
            $sql = "insert into tb_contact values('','$id_gen','$postName','$postNameen','$postEmail','$postTel')";
            if (mysql_query($sql)) {
                echo "1";
            }
        }
        
        $url = "http://maps.googleapis.com/maps/api/staticmap?center=$marker_lat,$marker_lng&zoom=15&markers=color:blue%7Clabel:H%7C$marker_lat,$marker_lng&size=600x400&sensor=false";
        $gImg = "Gmap_$id_gen.jpg";
        $gUrl = '../gImg/' . $gImg . '';
        file_put_contents($gUrl, file_get_contents($url));
        $sql = "insert into tb_gimage value('','$id_gen','$gImg','$gUrl')";
        mysql_query($sql);
    }
    mysql_close();
}
?>
