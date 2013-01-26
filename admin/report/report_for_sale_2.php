<?php
session_start();
include('../../config.php');
//require_once '../phpclass/dbConnect.php';
$gen_id = isset($_REQUEST['gen_id']) ? $_REQUEST['gen_id'] : 7;
//$dbcon_ = new dbConnect();
//$conn_ = $dbcon_->connect();
$sql_query = 'SELECT
     tb_image.`name_img` AS image,
		 tb_general.`id_gen` AS gen_id,
     tb_general.`topic` AS th_topic,
		 tb_general.`topicen` AS en_topic,
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

     tb_location.`address` AS th_address,
		 tb_location.`addressen` AS en_address,

     tb_location.`road` AS th_road,
		 tb_location.`roaden` AS en_road,

     tb_location.`soy` AS th_soy,
     tb_location.`soyen` AS en_soy,

     tb_location.`province` AS location_province,
   
     tb_location.`amphur` AS location_amphur,
     tb_location.`tambon` AS location_tambon,

     tb_location.`detail` AS th_location_detail,
     tb_location.`detailen` AS en_location_detail,

     tb_location.`lat` AS location_lat,
     tb_location.`lng` AS location_lng,
     tb_detail.`detail` AS th_detail,
		 tb_detail.`detailen` AS en_detail,
	   tb_type.`id_type` AS id_type,

     tb_type.`name_type` AS th_name_type,
     tb_type.`name_typeen` AS en_name_type,

     tb_class.`id_class` AS id_class,

     tb_class.`name_class` AS th_name_class,
     tb_class.`name_classen` AS en_name_class,

     tb_class.`shot` AS class_shot,
	 tb_gimage.`url_gmap` AS url_gmap,
tb_gimage.`name_gmap` AS name_gmap
     
FROM
     `tb_general` tb_general INNER JOIN `tb_contact` tb_contact ON tb_general.`id_gen` = tb_contact.`id_gen`
     INNER JOIN `tb_image` tb_image ON tb_general.`id_gen` = tb_image.`id_gen`
     INNER JOIN `tb_location` tb_location ON tb_general.`id_gen` = tb_location.`id_gen`
     INNER JOIN `tb_detail` tb_detail ON tb_general.`id_gen` = tb_detail.`id_gen`
     INNER JOIN `tb_class` tb_class ON tb_general.`id_class` = tb_class.`id_class`
     INNER JOIN `tb_type` tb_type ON tb_general.`id_type` = tb_type.`id_type`
	 INNER JOIN tb_gimage ON tb_general.`id_gen` = tb_gimage.`id_gen`
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
    $th_area = '';
    $en_area = '';
    $price;
    $class_shot = '';
    $pic_map;
    $distric_code;
    $amphur_code;
    $province_code;
    $soy;
    $road;
    $address;
	$location_detail;
	$th_detail;
	$gmap;
    for ($i = 0; $i < $count; $i++) {
        $arr_reply = mysql_fetch_array($reply);
        $pic[$i] = $arr_reply['image'];
        $th_topic = $arr_reply['th_topic'];
        $en_topic = $arr_reply['en_topic'];
		
        $th_type = $arr_reply['th_name_type'];
		$en_type = $arr_reply['en_name_type'];
        $type_id = $arr_reply['id_type'];
		
        $th_class = $arr_reply['th_name_class'];
		$en_class = $arr_reply['en_name_class'];
		$class_shot = $arr_reply['class_shot'];
		//$th_detail = $arr_reply['th_detail'];
        $th_area = $arr_reply['th_topic'] . ' เนื้อที่ ' . $arr_reply['rai'] . ' ไร่ ' . $arr_reply['ngan'] . ' งาน ' . $arr_reply['tarang'] . ' ตารางวา <br />' . $arr_reply['th_detail'];
        $en_area = $arr_reply['en_topic'].' area '. $arr_reply['rai'].' Rai '.$arr_reply['ngan'].' Ngan '.$arr_reply['tarang'].' Square yard<br />'.$arr_reply['en_detail'];
		
        $price = $arr_reply['price'];
        
        $pic_map = isset($arr_reply['url_gmap']) ? $arr_reply['url_gmap'] : './img/nomap.png';
		
        $distric_code = isset($arr_reply['location_tambon']) ? $arr_reply['location_tambon'] : '';
        $amphur_code = isset($arr_reply['location_amphur']) ? $arr_reply['location_amphur'] : '';
        $province_code = isset($arr_reply['location_province']) ? $arr_reply['location_province'] : '';
		
        $location_detail = isset($arr_reply['th_location_detail']) ? $arr_reply['th_location_detail'] : 'error!';
		
        $soy = $arr_reply['th_soy'];
		$en_soy = $arr_reply['en_soy'];
        $road = $arr_reply['th_road'];
		$en_road = $arr_reply['en_road'];
        $address = $arr_reply['th_address'];
		$en_address = $arr_reply['en_address'];
    }
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
                    <div id="pic"><img src="../../postPhoto/<?= $pic[0]; ?>" width="345px" height="308px" style="left: 0px; top: 0px; float:left" /></div>
                    <?php
                    if (isset($pic[1])) {
                        echo '
                            <div id="pic1"><img src="../../postPhoto/' . $pic[1] . '" width="210px" height="150px" style="left: 0px; top: 0px; float:left" /></div>
                            ';
                    } if (isset($pic[2])) {
                        echo '
                            <div id="pic2"><img src="../../postPhoto/' . $pic[2] . '" width="210px" height="150px" style="left: 0px; top: 0px; float:left" /></div>
                             ';
                    } if (isset($pic[3])) {
                        echo '
                            <div id="pic3"><img src="../../postPhoto/' . $pic[3] . '" width="210px" height="150px" style="left: 0px; top: 0px; float:left" /></div>
                             ';
                    } if (isset($pic[4])) {
                        echo '
                            <div id="pic4"><img src="../../postPhoto/' . $pic[4] . '" width="210px" height="150px" style="left: 0px; top: 0px; float:left" /></div>
                             ';
                    }
                    
                    $sql_query = 'select amphur_name as amphur from amphur where amphur_id ="' . $amphur_code . '"';
                    //echo $sql_query;
                    $reply = mysql_query($sql_query, $conn_);
                    $arr_reply = isset($reply) ? mysql_fetch_array($reply) : NULL;
                    if ($arr_reply != NULL) {
                        $amphur = $arr_reply['amphur'];
                    } else {
                        echo 'Error!' . mysql_error($conn_);
                        print_r($arr_reply);
                    }
                    $sql_query = 'select province_name as province from province where province_id ="' . $province_code . '"';
                                //echo $sql_query;
                                $reply = mysql_query($sql_query, $conn_);
                                $arr_reply = isset($reply) ? mysql_fetch_array($reply) : NULL;
                                if ($arr_reply != NULL) {
                                    $province = $arr_reply['province'];
                                } else {
                                    echo 'Error!' . mysql_error($conn_);
                                    print_r($arr_reply);
                                }
                    ?>
                    <div id="th_detail">&nbsp;รายละเอียด&nbsp;:&nbsp;<div id="th_detail1"><?php echo $amphur . '&nbsp;' . $province ?></div>
                        <div id="th_detail2"><?php echo $th_type . ' (' . $class_shot . ') '; ?>&nbsp;</div></div>
                    <div id="th_detail_data1"><font color="#000099" size="6"><?php echo $th_class . '' . $th_topic; ?></font><br /><font color="#003399" size="5"><?php echo $th_area; ?></font></div>
                    <div id="th_detail_price">ราคา&nbsp;:&nbsp;<?php echo $price ?>&nbsp;บาท</div>
                    <div id="en_detail">&nbsp;Detail&nbsp;:&nbsp;<div id="th_detail1"><?php echo $amphur . '&nbsp;' . $province ?> </div><div id="th_detail2"><?php echo $en_type . ' (' . $class_shot . ') '; ?>&nbsp;</div></div><div id="en_detail_data"><font color="#000099" size="6"><?php echo $en_class . $en_topic; ?></font><br /><font color="#003399" size="5"><?php echo $en_area; ?></font></div>
                    <div id="en_detail_price">Cost&nbsp;:&nbsp;<?php echo $price ?>&nbsp;baht.</div>
                    <div id="map">แผนที่&nbsp;/&nbsp;MAP</div>
                    <div id="map1"><img src="<?= $pic_map; ?>" width="408" height="309" /></div>
                </div>
                <div id="label_service">บริการรับฝาก ซื้อ ขาย เช่า แลกเปลี่ยนอสังหาริมทรัพย์ทุกประเภท</div>
                <div id="logo_"><!--<img src="./img/logo1.png" width="820" height="200" />-->
                    <div id="logo_img1"><img src="img/logo2.png" width="410" height="200" /></div>
                    <div id="logo_img2">
                        <ul style="list-style-type:none; float:left; left: 0;" >
                            <li style="float:left; left: 10px; text-align: left; position: absolute; top: 10px; width: 390px;">
                                <font color="#003399" size="4">ที่อยู่&nbsp;:&nbsp;</font><font color="#003399" size="3"><?= $address; ?></font><br />
                            </li>
                            <br />
                            <li style="float:left; left: 10px; text-align: left; position: absolute; width: 390px; top: 39px;">
                                <font color="#003399" size="4">ซอย&nbsp;:&nbsp;</font><font color="#003399" size="3"><?= $soy; ?></font><br />
                            </li>
                            <br />
                            <li style="float:left; left: 10px; text-align: left; position: absolute; top: 67px; width: 192px;">
                                <font color="#003399" size="4">&nbsp;ถนน&nbsp;:&nbsp;</font><font color="#003399" size="3"><?= $road; ?></font><br />
                            </li>
                            <li style="float:left; left: 205px; text-align: left; position: absolute; width: 195px; top: 67px;">
                                <font color="#003399" size="4">&nbsp;&nbsp;ตำบล&nbsp;:&nbsp;</font><font color="#003399" size="3"><?php
                                $sql_query = 'select district_name as tambon from district where district_id ="' . $distric_code . '"';
                                //echo $sql_query;
                                $reply = mysql_query($sql_query, $conn_);
                                $arr_reply = isset($reply) ? mysql_fetch_array($reply) : NULL;
                                if ($arr_reply != NULL) {
                                    echo $arr_reply['tambon'];
                                } else {
                                    echo 'Error!' . mysql_error($conn_);
                                    print_r($arr_reply);
                                }
                                ?>
                                </font><br />
                            </li>
                            <br />
                            <li style="float:left; left: 10px; text-align: left; position: absolute; top: 95px; width: 192px;">
                                <font color="#003399" size="4">เขต/อำเภอ&nbsp;:&nbsp;</font><font color="#003399" size="3"><?php
                                echo $amphur;
                                ?>
                                </font><br />
                            </li>
                            <li style="float:left; left: 206px; text-align: left; position: absolute; width: 194px; top: 95px;">
                                <font color="#003399" size="4">&nbsp;จังหวัด&nbsp;:&nbsp;</font><font color="#003399" size="3"><?php
                                echo $province;
                                ?>
                                </font><br />
                            </li>
                            <br />
                            <li style="float:left; left: 10px; text-align: left; position: absolute; top: 123px; width: 390px; height: 67px;">
                                <font color="#003399" size="4">&nbsp;รายละเอียดเพิ่มเติม&nbsp;:&nbsp;</font><font color="#003399" size="3"><?= $location_detail; ?></font><br />
                            </li>
                        </ul>
                    </div> 
                </div>
                <div id="web">w w w . p r o p e r t y l a n n a . c o m</div>
            </div>
        </body>
    </html>
    <?php
}
?>
