<?php

$topic = $_POST['topic'];
$topicen = $_POST['topicen'];
$classs = $_POST['classs'];
$typee = $_POST['typee'];
$province = $_POST['province'];
$amphur = $_POST['amphur'];
$tambon = $_POST['tambon'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$ri = $_POST['ri'];
$ngan = $_POST['ngan'];
$tarang = $_POST['tarang'];
$price = $_POST['price'];
$des = $_POST['des'];
$desen = $_POST['desen'];
$name = $_POST['name'];
$nameen = $_POST['nameen'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$idG = $_POST['idG'];
$date = date('d-m-Y');
$address = $_POST['addr'];
$addressen = $_POST['addren'];
$road = $_POST['road'];
$roaden = $_POST['roaden'];
$soy = $_POST['soi'];
$soyen = $_POST['soien'];
$num = $_POST['num'];
$locData = $_POST['locData'];
$locDataen = $_POST['locDataen'];
$unit = $_POST['unit'];
for ($i = 0; $i < $num; $i++) {
    $img[$i] = $_POST['img' . $i];
}
//echo $topic . " : " . $classs . " : " . $typee . " : " . $province . " : " . $amphur . " : " . $tambon . " : " . $lat . " : " . $lng . " : " . $ri . " : " . $ngan . " : " . $tarang . " : " . $price . " : " . $des . " : " . $name . " : " . $tel . " : " . $email . " : " . $idG;
include '../config.php';
$result = mysql_query("update tb_general set topic='$topic',topicen='$topicen',id_class='$classs',id_type='$typee',price='$price',id_unit='$unit',rai='$ri',ngan='$ngan',tarang='$tarang',date='$date' where id_gen='$idG'");
if ($result) {
    $result = mysql_query("update tb_location set address='$address',addressen='$addressen',road='$road',roaden='$roaden',soy='$soy',soyen='$soyen',province='$province',amphur='$amphur',tambon='$tambon',detail='$locData',detailen='$locDataen',lat='$lat',lng='$lng' where id_gen='$idG'");
    if ($result) {
        $url = "http://maps.googleapis.com/maps/api/staticmap?center=$lat,$lng&zoom=15&markers=color:blue%7Clabel:H%7C$lat,$lng&size=600x400&sensor=false";
        $gImg = "Gmap_$idG.jpg";
        $gUrl = 'gImg/' . $gImg . '';
        file_put_contents($gUrl, file_get_contents($url));
        $result = mysql_query("update tb_gimage set name_gmap='$gImg',url_gmap='../$gUrl' where id_gen='$idG'");
    }
    if ($result) {
        $result = mysql_query("update tb_detail set detail='$des',detailen='$desen' where id_gen='$idG'");

        if ($result) {
            $result = mysql_query("update tb_contact set name='$name',nameen='$nameen',email='$email',tel='$tel' where id_gen='$idG'");
            if ($result) {
                $sql = "select * from tb_image where id_gen='$idG'";
                $result = mysql_query($sql);
                $number = mysql_num_rows($result);
                $i = 0;
                while ($rc = mysql_fetch_array($result)) {
                    $name_images = $rc['name_img'];
                    mysql_query("update tb_image set name_img='$img[$i]' where name_img='$name_images'");
                    $i++;
                }
                if ($number < 5) {
                    for ($i = $number; $i < $num; $i++) {
                        if ($img[$i] != "") {
                            $imgName = $idG . "_" . $img[$i];
                            mysql_query("insert into tb_image values('','$idG','$imgName')");
                            copy("../temp/" . $img[$i], "../postphoto/" . $imgName);
                            unlink("../temp/" . $img[$i]);
                        }
                    }
                }
            }
            echo "ทำการแก้ไขเรียบร้อยแล้ว !!!";
        }
    }
}
?>
