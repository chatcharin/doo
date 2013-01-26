<?php
session_start();
include('../config.php');
//require_once '../phpclass/dbConnect.php';
$gen_id = 1; //$_REQUEST['gen_id'];
//$dbcon_ = new dbConnect();
//$conn_ = $dbcon_->connect();
$sql_query = 'SELECT
     tb_image.`name_img` AS image,
     tb_general.`topic` AS topic,
     tb_general.`price` AS price,
     tb_general.`id_unit` AS unit,
     tb_general.`rai` AS rai,
     tb_general.`ngan` AS ngan,
     tb_general.`tarang` AS tarang,
     tb_general.`date` AS date,
     tb_general.`outdate` AS outdate,
     tb_general.`counter` AS counter,
     tb_contact.`name` AS contact_name,
     tb_contact.`email` AS contact_email,
     tb_contact.`tel` AS contact_tel,
     tb_location.`address` AS location_address,
     tb_location.`road` AS location_road,
     tb_location.`soy` AS location_soy,
     tb_location.`province` AS location_province,
     tb_location.`amphur` AS location_amphur,
     tb_location.`tambon` AS location_tambon,
     tb_location.`detail` AS location_detail,
     tb_location.`lat` AS location_lat,
     tb_location.`lng` AS location_lng,
     tb_detail.`detail` AS detail_detail,
	 tb_type.`id_type` AS id_type,
     tb_type.`name_type` AS name_type,
     tb_class.`id_class` AS id_class,
     tb_class.`name_class` AS name_class,
     tb_class.`shot` AS class_shot,
     tb_general.`id_gen` AS gen_id
FROM
     `tb_general` tb_general INNER JOIN `tb_contact` tb_contact ON tb_general.`id_gen` = tb_contact.`id_gen`
     INNER JOIN `tb_image` tb_image ON tb_general.`id_gen` = tb_image.`id_gen`
     INNER JOIN `tb_location` tb_location ON tb_general.`id_gen` = tb_location.`id_gen`
     INNER JOIN `tb_detail` tb_detail ON tb_general.`id_gen` = tb_detail.`id_gen`
     INNER JOIN `tb_class` tb_class ON tb_general.`id_class` = tb_class.`id_class`
     INNER JOIN `tb_type` tb_type ON tb_general.`id_type` = tb_type.`id_type`
     where tb_general.`id_gen` = "' . $gen_id . '"';
echo $sql_query;
$reply = mysql_query($sql_query, $conn_);
if (!$reply) {
    echo 'Error!' . mysql_error($conn_);
    $extra = '../index.php';
    header('Refresh: 3 ' . $extra);
} else {
    $count = mysql_num_rows($reply);
    $pic;
    $th_topic;
    $th_type;
    $th_class;
    $th_province = '';
    $th_amphur = '';
    ;
    $th_area = '';
    $en_area = '';
    $price;
    $class_shot = '';
    $pic_map;
    for ($i = 0; $i < $count; $i++) {
        $arr_reply = mysql_fetch_array($reply);
        $pic[$i] = $arr_reply['image'];
        $th_topic = $arr_reply['topic'];
        $en_topic = $arr_reply['topic'];
        $th_type = $arr_reply['name_type'];
        $th_type_id = $arr_reply['id_type'];
        $th_class = $arr_reply['name_class'];
        $th_area = $arr_reply['topic'] . 'เนื้อที่ ' . $arr_reply['rai'] . ' ไร่ ' . $arr_reply['ngan'] . ' งาน ' . $arr_reply['tarang'] . ' ตารางวา <br />' . $arr_reply['detail_detail'];
        $en_area = 'Test 1';
        $price = $arr_reply['price'];
        $class_shot = $arr_reply['class_shot'];
        $pic_map = isset($arr_reply['pic_map']) ? $arr_reply['picmap'] : './img/nomap.png';
        //$th_province = $arr_reply['province_name'];
        //$th_amphur = $arr_reply['amphur_name'];
    }
    //print_r($pic);
    //echo 'count =>' . $count;
    ?>
    <!--
    To change this template, choose Tools | Templates
    and open the template in the editor.
    -->
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <link href="./stlyereport/bg.css" rel="stylesheet" type="text/css">
            <link href="./stlyereport/for_sale.css" rel="stylesheet" type="text/css">
            <link href="./stlyereport/sales.css" rel="stylesheet" type="text/css">
            <link href="./stlyereport/code.css" rel="stylesheet" type="text/css">
            <link href="./stlyereport/gen_id.css" rel="stylesheet" type="text/css">
            <link href="./stlyereport/web.css" rel="stylesheet" type="text/css">
            <link href="./stlyereport/pic.css" rel="stylesheet" type="text/css">
            <link href="./stlyereport/image.css" rel="stylesheet" type="text/css">
            <link href="stlyereport/detail.css" rel="stylesheet" type="text/css">
            <link href="stlyereport/map.css" rel="stylesheet" type="text/css">
            <link href="stlyereport/label_service.css" rel="stylesheet" type="text/css">
            <link href="stlyereport/logo.css" rel="stylesheet" type="text/css">
        </head>
        <body leftmargin="0" topmargin="0">
            <div id="bg" align="center" >
                <div id="image1"><img src="./img/ขายด่วน.png" width="700px" height="150px" style="left: 0px; top: 0px; float:left" /></div>
                <div id="code">CODE&nbsp;:&nbsp;
                    <div id="gen_id"><?php echo $class_shot . $gen_id . $th_type_id; ?></div>
                </div>
                <div id="bg2">
                    <div id="pic"><img src="../postPhoto/<?= $pic[0]; ?>" width="345px" height="308px" style="left: 0px; top: 0px; float:left" /></div>
                    <?php
                    if (isset($pic[1])) {
                        echo '
                            <div id="pic1"><img src="../postPhoto/' . $pic[1] . '" width="210px" height="150px" style="left: 0px; top: 0px; float:left" /></div>
                            ';
                    } if (isset($pic[2])) {
                        echo '
                            <div id="pic2"><img src="../postPhoto/' . $pic[2] . '" width="210px" height="150px" style="left: 0px; top: 0px; float:left" /></div>
                             ';
                    } if (isset($pic[3])) {
                        echo '
                            <div id="pic3"><img src="../postPhoto/' . $pic[3] . '" width="210px" height="150px" style="left: 0px; top: 0px; float:left" /></div>
                             ';
                    } if (isset($pic[4])) {
                        echo '
                            <div id="pic4"><img src="../postPhoto/' . $pic[4] . '" width="210px" height="150px" style="left: 0px; top: 0px; float:left" /></div>
                             ';
                    }
                    ?>
                    <div id="th_detail">&nbsp;รายละเอียด&nbsp;:&nbsp;<div id="th_detail1"><?php echo $amphur . ' ' . $province ?>แม่ริม เชียงใหม่</div>
                        <div id="th_detail2"><?php echo $th_type . ' (' . $class_shot . ') '; ?>&nbsp;</div></div>
                    <div id="th_detail_data1"><font color="#000099" size="6"><?php echo $th_class . '' . $th_topic; ?></font><br /><font color="#003399" size="5"><?php echo $th_area; ?></font></div>
                    <div id="th_detail_price">ราคา&nbsp;:&nbsp;<?php echo $price ?>&nbsp;บาท</div>
                    <div id="en_detail">&nbsp;Detail&nbsp;:&nbsp;<div id="th_detail1"><?php echo $amphur . ' ' . $province ?>แม่ริม เชียงใหม่ </div><div id="th_detail2"><?php echo $th_type . ' (' . $class_shot . ') '; ?>&nbsp;</div></div><div id="en_detail_data"><font color="#000099" size="6"><?php echo $en_class . '' . $en_topic; ?></font><br /><font color="#003399" size="5"><?php echo $en_area; ?>eng</font></div>
                    <div id="en_detail_price">Cost&nbsp;:&nbsp;<?php echo $price ?>&nbsp;baht.</div>
                    <div id="map">แผนที่&nbsp;/&nbsp;MAP</div>
                    <div id="map1"><img src="<?= $pic_map; ?>" /></div>
                </div>
                <div id="label_service">บริการรับฝาก ซื้อ ขาย เช่า แลกเปลี่ยนอสังหาริมทรัพย์ทุกประเภท</div>
                <div id="logo_"><img src="./img/logo1.png" width="820" height="200" />
                    <!--<div id="logo_img1">Content for  id "logo_img1" Goes Here</div>
                    <div id="logo_img2">Content for  id "logo_img2" Goes Here</div> -->
                </div>
                <div id="web">w w w . p r o p e r t y l a n n a . c o m</div>
            </div>
        </body>
    </html>
    <?php
}
?>
