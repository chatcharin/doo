<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/default.css"/>
        <link rel="stylesheet" type="text/css" href="css/googlemap.css"/>
        <script type="text/javascript" src="js/jquerys.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAUf3LAxep-Yce9tOPTWsjintjII3dyxIQ&sensor=true"></script>

        <script type="text/javascript" src="js/default.js"></script>
<!--        <script type="text/javascript" src="js/check_form.js"></script>-->

        <script language="javascript">
            function show_pic(sc){
                if($('#img_area').find('img').length <= 4){
                    document.form_post.action='upload_img.php';
                    document.form_post.target='mypre';
                    document.form_post.submit();
                }else{
                    alert('สามารถอัพรูปได้สูงสุด 5 รูปครับ !');
                }
            }
            function delMyImg(my){
                var name = $(my).prev().attr('alt');
                $.ajax({
                    type:"GET",
                    url:"del_img.php",
                    data:"name_del=" +name,
                    success:function(){

                    }
                })
                $(my).prev().remove();
                $(my).remove();
            }
        </script>
     <link rel="stylesheet" type="text/css" href="css/css.css"  />
</head>
<body>
	<?php include('header.php');?>
	<div id="dashboard">
	   		<?php  include('menu.php');?>

        <form action="#" method="post" name="form_post" id="form_post" enctype="multipart/form-data">
            <h3><span>1.</span>ข้อมูลประกาศ</h3>

            <p>หัวข้อประกาศ :<em>*</em></span><br/>
                <p>th :<input type="text" name="topic" id="topic" ><span class="warning"></p>
                            <p>en :<input type="text" name="topicen" id="topicen" ></input></p>
                            <p>ประเภทประกาศ :<br/>
                                <select name="data_class" id="data_class" >
                                    <option value="เลือกประเภทประกาศ">เลือกประเภทประกาศ</option>
                                    <?
                                    include "../config.php";
                                    $sql = "select * from tb_class";
                                    $result = mysql_query($sql);
                                    while ($rs = mysql_fetch_array($result)) {
                                        $id_class = $rs['id_class'];
                                        $name_class = $rs['name_class'];
                                        echo "<option value='$id_class'>$name_class</option>";
                                    }
                                    ?>
                                </select><span class="warning"><em>*</em></span></p>
                            <p>ประเภทสินทรัพย์ :<br/>
                                <select name="data_type" id="data_type" >
                                    <option value="เลือกประเภทสินทรัพย์">เลือกประเภทสินทรัพย์</option>
                                    <?
                                    include "../config.php";
                                    $sql = "select * from tb_type";
                                    $result = mysql_query($sql);
                                    while ($rs = mysql_fetch_array($result)) {
                                        $id_type = $rs['id_type'];
                                        $name_type = $rs['name_type'];
                                        echo "<option value='$id_type'>$name_type</option>";
                                    }
                                    ?>
                                </select><span class="warning"><em>*</em></span></p>


                            ราคา :<br/>
                            <input type="text" name="postPrice" id="postPrice" maxlength="20"></input>
                            <select name="unit" id="unit" >
                                <option value="บาท">บาท</option>
                                <option value="บาทต่อเดือน">บาทต่อเดือน</option>
                                <option value="บาทต่อปี">บาทต่อปี</option>
                                <option value="บาทต่อตารางวา">บาทต่อตารางวา</option>
                                <option value="บาทต่อตารางเมตร">บาทต่อตารางเมตร</option>
                            </select><span class="warning"><em>*</em></span>
                            <br/><br/>
                            <p>ขนาดที่ดิน<br/>
                                <input name="rai" id="rai" type="text" size="5" />ไร่ 
                                <input name="ngan" id="ngan" type="text"  size="5" />งาน
                                <input name="tarang" id="tarang" type="text" size="5" />ตารางวา</p>

                            <h3><span>2.</span>ข้อมูลที่ตั้ง</h3>
                            <div id="postLocation">
                                <p>
                                    th ที่อยู่ : 
                                    <input type="text" name="postAddress" id="postAddress"/> 
                                    ถนน : <input type="text" name="postRoad" id="postRoad"/> 
                                    ซอย : <input type="text" name="postSoy" id="postSoy"/>
                                </p>
                                <p>en ที่อยู่ : 
                                    <input type="text" name="postAddressen" id="postAddressen"/>
                                    ถนน : 
                                    <input type="text" name="postRoaden" id="postRoaden"/>
                                    ซอย : 
                                    <input type="text" name="postSoyen" id="postSoyen"/>
                                </p>
                                <br/>
                                <?php

                                function province($name, $id, $value, $num) {
                                    echo "$name : <select id='$id' name='province'>";
                                    if ($value == '')
                                        echo "<option value='เลือกจังหวัด'>- เลือกจังหวัด -</option>";
                                    else
                                        echo "<option value='$num'>$value</option>";
                                    include 'config.php';
                                    $sql = "select * from province order by PROVINCE_ID asc";
                                    $result = mysql_query($sql);
                                    while ($rc = mysql_fetch_array($result)) {
                                        if ($rc['PROVINCE_NAME'] != $value)
                                            echo "<option value='" . $rc['PROVINCE_ID'] . "'>" . $rc['PROVINCE_NAME'] . "</option>";
                                    }
                                    mysql_close();
                                    echo "</select><span class='warning'><em>*</em></span>";
                                }

                                function amphur($name, $id, $value, $num) {
                                    echo "$name : <select id='$id'  name='amphur' >";
                                    if ($value == '')
                                        echo "<option value='เลือกอำเภอ'>- เลือกอำเภอ -</option>";
                                    else
                                        echo "<option value='$num'>$value</option>";
                                    echo "</select><span class='warning'><em>*</em></span>";
                                }

                                function tambon($name, $id, $value, $num) {
                                    echo "$name : <select id='$id'  name='tambon'>";
                                    if ($value == '')
                                        echo "<option value='เลือกตำบล'>- เลือกตำบล -</option>";
                                    else
                                        echo "<option value='$num'>$value</option>";
                                    echo "</select><span class='warning'><em>*</em></span>";
                                }

                                province('จังหวัด', 'postProvince', '', '');
                                amphur('อำเภอ', 'postAmphur', '', '');
                                tambon('ตำบล', 'postTambon', '', '');
                                ?>
                                <br/>
                                <br/>
                                <span>ระบุตำแหน่งในแผนที่</span><em> * </em><a id="helpMap">ดูวิธีระบุตำแหน่งบนแผนที่</a> <span id='war_map'><em></em></span>                  </p>
                                <div id="map_goo">
                                    <div id="map_canvas"></div>
                                    <div id="bg_sidebar"></div>
                                    <div id="sidebar_map">
                                        <a id="zoomInDiv" class="sidebar_button" title="ซูมเข้าเพื่อดูแผนที่ให้ละเอียดขึ้น" style="background-position: 0px -31px;">-</a>
                                        <a id="zoomOutDiv" class="sidebar_button" title="ซูมออกเพื่อดูแผนที่ในมุมกว้าง" style="background-position: 0px -62px;">-</a>
                                        <a id="markerDiv" class="sidebar_button" title="ระบุตำแหน่งอสังหาฯในแผนที่" style="background-position: 0px -93px;">-</a>
                                    </div>
                                </div>
                                <br/>
                                <div>
                                    <input name="marker_lat" id="marker_lat" type="hidden" value="" />
                                    <input name="marker_lng" id="marker_lng" type="hidden" value="" />
                                    <span>รายละเอียดสถานที่ตั้งและการเดินทาง</span><br/>
                                    th : 
                                    <textarea name="locationData" cols="50" rows="4" id="locationData"></textarea>
                                    en : 
                                    <textarea name="locationDataen" cols="50" rows="4" id="locationDataen"></textarea>
                                </div>
                            </div>
                            <h3><span>3.</span>ใส่รูปภาพ</h3>
                            <div id="postImage">
                                <div id="img_area"></div>
                                <input type="file" name="file" onchange="show_pic(this.value);" />
                                <iframe name="mypre" width="0" height="1" frameborder="0"></iframe>
                            </div>

                            <h3><span>4.</span>รายละเอียดเพิ่มเติม</h3>
                            <div id="postDetail">
                                th : <textarea name="detailArea" cols="50" rows="6" id="detailArea"></textarea>
                                en : <textarea name="detailAreaen" cols="50" rows="6" id="detailAreaen"></textarea>
                            </div>
                            <h3><span>5.</span>ข้อมูลติดต่อ<span class='warning'><em>*</em></span></h3>
                            <div id="postContact">
                                <p>ชื่อผู้ประกาศ :</p>
                                <p>th : <input type="text" name="postName" id="postName"></input><span class='warning'> </p>
                                <p>en : <input type="text" name="postNameen" id="postNameen"></input></p>

                                <p>อีเมล์ : <br/>
                                    <input type="text" name="postEmail" id="postEmail"><span class='warning'>
                                            </p>
                                            <p>เบอร์โทรติดต่อ : <br/><input type="text" name="postTel" maxlength="10" id="postTel"></input><span class='warning'>
                                            </p>
                                            </div>
                                            <h3>6.ยอมรับข้อตกลง</h3>
                                            <div id="postRaw">
                                                กรุณาอ่าน <a id="getRaw">ข้อตกลงในการลงประกาศ</a> และ เลือกหัวข้อข้างล่างทั้ง 3 ข้อ เพื่อยอมรับข้อตกลงดังกล่าว ก่อนลงประกาศกับ ddhome.com ครับ
                                                <br/><p>***** ถ้ามีการตรวจพบว่าประกาศของคุณ ผิดข้อตกลงในการลงประกาศ เช่นลงประกาศซ้ำๆกัน หรือลงโฆษณาบริการต่างๆ ทางทีมงานขอสงวนสิทธิ์ในการลบประกาศของคุณหรือระงับการใช้งาน user ของคุณโดยไม่ได้ต้องแจ้งให้ทราบล่วงหน้า</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="raw1"> คุณยืนยันว่า ได้อ่าน ข้อตกลงในการลงประกาศแล้ว และยอมรับข้อตกลงดังกล่าว</input><br/>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="raw2"> คุณยืนยันว่า ประกาศที่คุณกำลังจะลงไม่ซ้ำกับ ประกาศอื่นๆที่คุณเคยลงและมีการแสดงอยู่ขณะนี้</input><br/>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="raw3"> คุณยืนยันว่า การระบุตำแหน่งสถานที่บนแผนที่ เป็นตำแหน่งอสังหาฯ ของคุณจริง</input><br/>

                                            </div><br/>
                                            <input type="button" id="submitPost" value="ลงประกาศ"/>
                                            <input type="hidden" name="user_ID" id="user_id" value="<?= $sess_id_user; ?>"/>
                                            </form>
</div>
                                            </body>
                                            </html>
