<? $id_edit = $_GET['id_edit']; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/googlemap.css"/>
        <script type="text/javascript" src="jscripts/jquerys.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAUf3LAxep-Yce9tOPTWsjintjII3dyxIQ&sensor=true"></script>
        <script type="text/javascript" src="js/default1.js"></script>
        <script type="text/javascript" src="js/check_form.js"></script>
        <script type="text/javascript">
            //update
            $(document).ready(function(){

                $('#s_ePost').click(function(){
                    var topic = $('#topic').val();
                    var topicen = $('#topicen').val();
                    var classs = $('#classs').val();
                    var typee = $('#typee').val();
                    var province = $('#province').val();
                    var amphur =$('#amphur').val();
                    var tambon =$('#tambon').val();
                    var lat = $('#marker_lat').val();
                    var lng =$('#marker_lng').val();
                    var ri =$('#ri').val();
                    var ngan =$('#ngan').val();
                    var tarang =$('#tarang').val();
                    var price =$('#price').val();
                    var des = $('#des').val();
                    var desen = $('#desen').val();
                    var name =$('#name').val();
                    var nameen =$('#nameen').val();
                    var tel = $('#tel').val();
                    var email =$('#email').val();
                    var idG = $('#idG').val();
                    var addr = $('#addr').val();
                    var addren = $('#addren').val();
                    var road = $('#road').val();
                    var roaden = $('#roaden').val();
                    var soi =$('#soi').val();
                    var soien =$('#soien').val();
                    var locData =$('#locData').val();
                    var locDataen =$('#locDataen').val();
                    var unit =$('#unit').val();
                    //img
                    var i;
                    var num = $('#img_area').find('img').length;
                    var img= new Array();
                    var myData='';
                    
                    for(i=0;i<num;i++){
                        img[i]= $('#img_area').find('img').eq(i).attr('alt');
                        if(img[i] == undefined){
                            img[i] ='';
                        }else{
                            myData +="&img"+i.toString()+"=" +img[i] ;
                        }
                    }
                    
                    $.ajax({
                        type:"POST",
                        url:"e_post.php",
                        data:"topic=" + topic + "&classs=" + classs + "&typee=" + typee  + "&province=" + province + "&amphur=" + amphur + "&tambon=" + tambon
                            +"&lat=" + lat + "&lng=" + lng+ "&ri=" + ri + "&ngan=" +ngan + "&tarang=" +tarang + "&price=" + price + "&des=" + des + "&name=" +name + "&tel=" +tel
                            +"&email=" + email + "&num=" +num+"&mydata=" + myData +"&idG=" +idG +"&addr=" + addr + "&road=" + road + "&soi=" +soi + "&topicen=" + topicen 
                            + "&desen=" + desen + "&nameen=" + nameen + "&addren=" + addren + "&roaden=" + roaden + "&soien=" + soien + "&locData=" + locData 
                            + "&locDataen=" + locDataen + "&unit=" + unit ,
                        success: function(response){
                            alert(response);
                            window.location="edit_post2.php?id_edit=<?= $id_edit ?>";
                        }
                    });
                });
                
                
                //Province
                $("select[name='province']").change(function(){

                    if($(this).val() != "เลือกจังหวัด"){
                        codeAddress($(this).val(),"p");
                        var my = $(this).val();
                        jQuery.ajax({
                            type:"POST",
                            url:"thailand.php",
                            data:"province=" + my+"&name=p",
                            success:function(response){
                                var name = response.split('  ');
                                var countName = name.length;
                                var i;
                                jQuery.ajax({
                                    type:"POST",
                                    url:"thailand.php",
                                    data:"province=" +my+"&name=p_id",
                                    success:function(response1){
                                        var id= response1.split(' ');
                                        $('#amphur').children().remove()
                                        $('#amphur').append("<option value='เลือกอำเภอ'>- เลือกอำเภอ -</option>");
                                        $('#tambon').children().remove();
                                        $('#tambon').append("<option value='เลือกตำบล'>- เลือกตำบล -</option>");
                                        for(i=0;i<countName;i++){
                                            $('#amphur').append("<option value='"+id[i]+"'>"+name[i]+"</option>");
                                        }
                                    }
                            
                                });
                            }
                        });
                    }else{
                        $('#amphur').children().remove();
                        $('#amphur').append("<option value='เลือกอำเภอ'>- เลือกอำเภอ -</option>");
                        $('#tambon').children().remove();
                        $('#tambon').append("<option value='เลือกตำบล'>- เลือกตำบล -</option>");
                    }

                }); 
                
                $("select[name='amphur']").change(function(){

                    if($(this).val() != "เลือกอำเภอ"){
                        codeAddress($(this).val(),"a");
                        var my = $(this).val();
                        jQuery.ajax({
                            type:"POST",
                            url:"thailand_1.php",
                            data:"amphur=" + my+"&name1=a",
                            success:function(response){
                                var name = response.split('  ');
                                var countName = name.length;
                                var i;
                                jQuery.ajax({
                                    type:"POST",
                                    url:"thailand_1.php",
                                    data:"amphur=" +my+"&name1=a_id",
                                    success:function(response1){
                                        var id= response1.split(' ');
                                        $('#tambon').children().remove();
                                        $('#tambon').append("<option value='เลือกตำบล'>- เลือกตำบล -</option>");
                                        for(i=0;i<countName;i++){
                                            $('#tambon').append("<option value='"+id[i]+"'>"+name[i]+"</option>");
                                        }
                                    }
                            
                                });
                            }
                        });
                    }else{
                        $('#tambon').children().remove();
                        $('#tambon').append("<option value='เลือกตำบล'>- เลือกตำบล -</option>");
                    }

                }); 
                $("select[name='tambon']").change(function(){
                    codeAddress($(this).val(),"t");
                });
            });
            
          
        </script>
        <link rel="stylesheet" type="text/css" href="css/css.css"  />
</head>
<body>
	<?php include('header.php');?>
	<div id="dashboard">
	   		<?php  include('menu.php');?>

        <form action="#" method="post" name="e_post" id="e_post" enctype="multipart/form-data" >
            <?php
            include '../config.php';

            $result = mysql_query("select * from tb_general where id_gen='$id_edit'");
            if ($result) {
                while ($rc = mysql_fetch_array($result)) {
                    $my_id = $rc['id_gen'];
                    $my_topic = $rc['topic'];
                    $my_topicen = $rc['topicen'];
                    $my_id_unit = $rc['id_unit'];
                    $my_class = $rc['id_class'];
                    $my_type = $rc['id_type'];
                    $my_price = $rc['price'];
                    $my_ri = $rc['rai'];
                    $my_ngan = $rc['ngan'];
                    $my_tarang = $rc['tarang'];
                    $my_date = $rc['date'];
                }
            }

            $result = mysql_query("select * from tb_detail where id_gen='$my_id'");
            if ($result) {
                while ($rc = mysql_fetch_array($result)) {
                    $my_detail = $rc['detail'];
                    $my_detailen = $rc['detailen'];
                }
            }
            $result = mysql_query("select * from tb_contact where id_gen='$my_id'");
            if ($result) {
                while ($rc = mysql_fetch_array($result)) {
                    $my_nameen = $rc['nameen'];
                    $my_name = $rc['name'];
                    $my_email = $rc['email'];
                    $my_tel = $rc['tel'];
                }
            }
            $result = mysql_query("select * from tb_class where id_class='$my_class'");
            if ($result) {
                while ($rc = mysql_fetch_array($result)) {
                    $my_classed = $rc['name_class'];
                }
            }
            $result = mysql_query("select * from tb_type where id_type='$my_type'");
            if ($result) {
                while ($rc = mysql_fetch_array($result)) {
                    $my_typed = $rc['name_type'];
                }
            }
            ?>
            <input type="hidden" id="idG" value="<?= $my_id ?>"></input>
            <h3>1.ข้อมูลประกาศ</h3>
            <p>หัวข้อประกาศ : </p>
            <p>th :<input type="text" name="topic" id="topic" value="<?= $my_topic ?>"></input></p>
            <p>en :<input type="text" name="topicen" id="topicen" value="<?= $my_topicen ?>"></input></p>
            <p>ประเภทประกาศ : 
                <select name="classs" id="classs">
                    <option value="<?= $my_class ?>"><?= $my_classed ?></option>
                    <?
                    $result = mysql_query("select * from tb_class");
                    if ($result) {
                        while ($rc = mysql_fetch_array($result)) {
                            if ($my_class != $rc['id_class'])
                                echo "<option value='" . $rc['id_class'] . "'>" . $rc['name_class'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </p>

            <p>ประเภทสินทรัพย์  : 

                <select name="typee" id="typee">
                    <option value="<?= $my_type ?>"><?= $my_typed ?></option>
                    <?
                    $result = mysql_query("select * from tb_type");
                    if ($result) {
                        while ($rc = mysql_fetch_array($result)) {
                            if ($my_type != $rc['id_type'])
                                echo "<option value='" . $rc['id_type'] . "'>" . $rc['name_type'] . "</option>";
                        }
                    }
                    ?>
                </select>

            </p>
            <p>ราคาขาย :<input type="text" name="price" id="price" value="<?= $my_price ?>"></input>                
                <select name="unit" id="unit" >
                    <option value="<?= $my_id_unit; ?>"><?= $my_id_unit; ?></option>
                    <option value="บาท">บาท</option>
                    <option value="บาทต่อเดือน">บาทต่อเดือน</option>
                    <option value="บาทต่อปี">บาทต่อปี</option>
                    <option value="บาทต่อตารางวา">บาทต่อตารางวา</option>
                    <option value="บาทต่อตารางเมตร">บาทต่อตารางเมตร</option>
                </select></p>
            <p>ขนาดที่ดิน : <br/>
                <span> ไร่ : </span><input type="text" name="ri" id="ri" value="<?= $my_ri ?>"></input>
                <span> งาน : </span><input type="text" name="ngan" id="ngan" value="<?= $my_ngan ?>"></input>
                <span> ตารางวา : </span><input type="text" name="tarang" id="tarang" value="<?= $my_tarang ?>"></input>
            </p>
            <?php
            $sql = "select * from tb_location where id_gen ='$my_id'";
            $result = mysql_query($sql);
            while ($rc = mysql_fetch_array($result)) {
                $my_address = $rc['address'];
                $my_addressen = $rc['addressen'];
                $my_road = $rc['road'];
                $my_roaden = $rc['roaden'];
                $my_soy = $rc['soy'];
                $my_soyen = $rc['soyen'];
                $id_province = $rc['province'];
                $id_amphur = $rc['amphur'];
                $id_tambon = $rc['tambon'];
                $my_detailm = $rc['detail'];
                $my_detailmen = $rc['detailen'];
                $my_lat = $rc['lat'];
                $my_lng = $rc['lng'];
            }
            $result = mysql_query("select * from province where PROVINCE_ID='$id_province'");
            if ($result) {
                while ($rc = mysql_fetch_array($result)) {
                    $my_province = $rc['PROVINCE_NAME'];
                }
            }
            $result = mysql_query("select * from amphur where AMPHUR_ID='$id_amphur'");
            if ($result) {
                while ($rc = mysql_fetch_array($result)) {
                    $my_amphur = $rc['AMPHUR_NAME'];
                }
            }
            $result = mysql_query("select * from district where DISTRICT_ID='$id_tambon'");
            if ($result) {
                while ($rc = mysql_fetch_array($result)) {
                    $my_tambon = $rc['DISTRICT_NAME'];
                }
            }
            ?>
            <h3>2.ข้อมูลที่ตั้ง</h3>
            <p>
                th ที่อยู่ : 
                <input type="text" name="addr" id="addr" value="<?= $my_address ?>"></input>
                ถนน : <input type="text" name="road" id="road" value="<?= $my_road ?>"></input>
                ซอย : <input tyep="text" name="soi" id="soi" value="<?= $my_soy ?>"></input>
            </p>
            <p>en ที่อยู่ : <input type="text" name="addren" id="addren" value="<?= $my_addressen ?>"/>
                ถนน : <input type="text" name="roaden" id="roaden" value="<?= $my_roaden ?>"/>
                ซอย : <input type="text" name="soien" id="soien" value="<?= $my_soyen ?>"/>
            </p>
            <p>
                จังหวัด : 
                <select id="province" name="province">

                    <?php
                    echo"<option value='$id_province'>$my_province</option>";
                    $sql = "select * from province order by PROVINCE_ID asc";
                    $result = mysql_query($sql);
                    while ($rc = mysql_fetch_array($result)) {
                        if ($id_province != $rc['PROVINCE_ID'])
                            echo "<option value='" . $rc['PROVINCE_ID'] . "'>" . $rc['PROVINCE_NAME'] . "</option>";
                    }
                    ?>
                </select>


                อำเภอ : 
                <select id="amphur" name="amphur">
                    <?php
                    echo"<option value='$id_amphur'>$my_amphur</option>";
                    $sql = "select * from amphur where PROVINCE_ID='$id_province'";
                    $result = mysql_query($sql);
                    while ($rc = mysql_fetch_array($result)) {
                        if ($id_amphur != $rc['AMPHUR_ID'])
                            echo "<option value='" . $rc['AMPHUR_ID'] . "'>" . $rc['AMPHUR_NAME'] . "</option>";
                    }
                    ?>
                </select>

                ตำบล : 
                <select id="tambon" name="tambon">
                    <?php
                    echo"<option value='$id_tambon'>$my_tambon</option>";
                    $sql = "select * from district where AMPHUR_ID='$id_amphur'";
                    $result = mysql_query($sql);
                    while ($rc = mysql_fetch_array($result)) {
                        if ($id_tambon != $rc['DISTRICT_ID'])
                            echo "<option value='" . $rc['DISTRICT_ID'] . "'>" . $rc['DISTRICT_NAME'] . "</option>";
                    }
                    ?>
                </select>
            </p>



            <div id="map_goo">
                <div id="map_canvas"></div>
                <div id="bg_sidebar"></div>
                <div id="sidebar_map">
                    <a id="zoomInDiv" class="sidebar_button" title="ซูมเข้าเพื่อดูแผนที่ให้ละเอียดขึ้น" style="background-position: 0px -31px;">-</a>
                    <a id="zoomOutDiv" class="sidebar_button" title="ซูมออกเพื่อดูแผนที่ในมุมกว้าง" style="background-position: 0px -62px;">-</a>
                    <a id="markerDiv" class="sidebar_button" title="ระบุตำแหน่งอสังหาฯในแผนที่" style="background-position: 0px -93px;">-</a>
                </div>
            </div>
            <input type="hidden" id="marker_lat" value="<?= $my_lat ?>"></input>
            <input type="hidden" id="marker_lng" value="<?= $my_lng ?>"></input>
            <p><span>รายละเอียดสถานที่ตั้งและการเดินทาง</span><br/>
                th : 
                <textarea name="locData" cols="50" rows="4" id="locData"><?= $my_detailm ?></textarea>
                en : 
                <textarea name="locDataen" cols="50" rows="4" id="locDataen"><?= $my_detailmen ?></textarea>
            </p>          
            <h3>รูปภาพประกอบ</h3>

            <script type="text/javascript">
                function show_pic(sc){
                    if($('#img_area').find('img').length <= 4){
                        document.e_post.action='uImg.php';
                        document.e_post.target='mypre';
                        document.e_post.submit();
                    }else{
                        alert('สามารถอัพรูปได้สูงสุด 5 รูปครับ !');
                    }
                }
                function delMyImg1(my){
                    var name = $(my).prev().attr('alt');
                    $.ajax({
                        type:"GET",
                        url:"dImg.php",
                        data:"name_del=" +name,
                        success:function(){
                            
                        }
                    })
                    $(my).prev().remove();
                    $(my).remove();
                }
                function delMyImg2(my){
                    var name = $(my).prev().attr('alt');
                    $.ajax({
                        type:"GET",
                        url:"dImg_1.php",
                        data:"name_del=" +name,
                        success:function(){
                            
                        }
                    })
                    $(my).prev().remove();
                    $(my).remove();
                }
            </script>

            <div id="myImage">
                <div id="img_area">
                    <?php
                    $result = mysql_query("select * from tb_image where id_gen ='$my_id'");
                    if ($result) {
                        while ($rc = mysql_fetch_array($result)) {
                            $mage = $rc['name_img'];
                            echo "<img src='../postphoto/$mage' alt='$mage' title='$mage' width='120' height='130'/><span style='cursor:pointer;' onclick='delMyImg2(this);''>ลบ</span>";
                        }
                    }
                    ?>
                </div>
                <input type="file" name="file" onchange="show_pic(this.value);" />
                <iframe name="mypre" width="0" height="1" frameborder="0"></iframe>
            </div>
            <br/>
            <h3>รายละเอียดเพิ่มเติม</h3>
            th : <textarea name="des" cols="50" rows="6" id="des"><?= $my_detail ?></textarea>
            en : <textarea name="desen" cols="50" rows="6" id="desen"><?= $my_detailen ?></textarea>
            <h3>ข้อมูลผู้ประกาศ</h3>
            <p>ชื่อผู้ประกาศ :</p>
            <p>th : <input type="text" name="name" id="name" value="<?= $my_name ?>"></input><span class='warning'> </p>
            <p>en : <input type="text" name="nameen" id="nameen"value="<?= $my_nameen ?>"></input></p>

            <p>เบอร์โทรศัพท์ติดต่อ :<input type="text" name ="tel" id="tel" value="<?= $my_tel ?>"></input></p>
            <p>อีเมล :<input type="text" name="email" id="email" value="<?= $my_email ?>"></input><span class='warning'></p>
            <p>แก้ไขล่าสุด : <?= $my_date ?></p>
            <input type="button" name="s_ePost" id="s_ePost" value="แก้ไขประกาศ"></input>
        </form>
        <?
        mysql_close();
        ?>
		</div>
    </body>
</html>