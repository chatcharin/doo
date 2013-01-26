
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/css.css"  />
        <script type="text/javascript" src="jscripts/jquerys.js"></script>
        <style type="text/css">
            <!--
            .style1 {color: #CC0000}
            -->
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
                $("select[name='e_province1']").change(function(){

                    if($(this).val() != "เลือกจังหวัด"){

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
                                        $('#e_amphur1').children().remove()
                                        $('#e_amphur1').append("<option value='เลือกอำเภอ'>- เลือกอำเภอ -</option>");
                                        for(i=0;i<countName;i++){
                                            $('#e_amphur1').append("<option value='"+id[i]+"'>"+name[i]+"</option>");
                                        }
                                    }
                            
                                });
                            }
                        });
                    }else{
                        $('#e_amphur1').children().remove();
                        $('#e_amphur1').append("<option value='เลือกอำเภอ'>- เลือกอำเภอ -</option>");
                    }

                }); 
                        
                        
            });
        </script>
</head>
<body>
	<?php include('header.php');?>
	<div id="dashboard">
	   		<?php  include('menu.php');?>
        <?
        $id_edit = $_GET['id_edit'];
        include "../config.php";
        $sql = "select * from tb_project where id_project='$id_edit' ";
        $result = mysql_query($sql);
        $rs = mysql_fetch_array($result);
        $id_project = $rs['id_project'];
        $name_pro = $rs['name_pro'];
        $type_pro = $rs['type_pro'];
        $title_pro = $rs['title_pro'];
        $date = $rs['date'];
        $price = $rs['price'];
        $manage = $rs['manage'];
        $tel = $rs['tel'];
        $web = $rs['web'];
        $feature = $rs['feature'];
        $descrip = $rs['descrip'];
        $email = $rs['email'];

        $img_pro = $rs['img_pro'];
        ?>

        <table width="70%" border="0" align="center"><br />
            <form id="add_Project" method="post" ENCTYPE="multipart/form-data" action="edit_Project2.php">
                <tr>
                    <td width="20%" valign="top">&nbsp;</td>
                    <td width="20%">
                        <p class="style1">ข้อมูลทั่วไป</p></td>
                    <td width="20%" valign="top">&nbsp;</td>
                    <td width="20%" class="style1">ข้อมูลติดต่อ</td>
                </tr>
                <tr>
                    <td width="20%" valign="top"><div align="right">ชื่อโครงการ :</div></td>
                    <td width="20%"><label>
                            <input name="name" type="text" id="name" size="35" value="<?= $name_pro; ?>"/>
                        </label></td>
                    <td width="20%" valign="top"><div align="right">ดำเนินงานโดย :</div></td>
                    <td width="20%"><input name="manage" type="text" id="manage"  size="35" value="<?= $manage; ?>"/></td>
                </tr>
                <tr>
                    <td width="20%" valign="top" ><div align="right">ประเภทโครงการ :</div> </td>
                    <td width="20%"><label>
                            <select name="type" id="type"><?= $type_pro; ?>
                                <option value="<?= $type_pro; ?>" selected="selected"><?= $type_pro; ?></option>
                                <option value="คอนโดมิเนียม">คอนโดมิเนียม</option>
                                <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                                <option value="ทาวน์โฮม">ทาวน์โฮม</option>
                            </select>
                        </label></td>
                    <td width="20%" valign="top"><div align="right">เบอร์ติดต่อ :</div></td>
                    <td width="20%"><label>
                            <input name="tel" type="text" id="tel" size="35" value="<?= $tel; ?>"/>
                        </label></td>
                </tr>
                <tr>
                    <td width="20%" rowspan="2" valign="top"><div align="right">ข้อมูลแนะนำ ( title ) :</div></td>
                    <td width="20%" rowspan="2"><label>
                            <textarea name="title" cols="30" rows="3" id="title"><?= $title_pro; ?></textarea>
                        </label></td>
                    <td width="20%" valign="top"><div align="right">เว็บไซต์ :</div></td>
                    <td width="20%"><input name="web" type="text" id="web" size="35" value="<?= $web; ?>" /></td>
                </tr>
                <tr>
                    <td width="20%" valign="top"><div align="right">อีเมล :</div></td>
                    <td width="20%"><input name="email" type="text" id="email" size="35" value="<?= $email; ?>" /></td>
                </tr>  
                <tr>
                    <td width="20%" valign="top"><div align="right">ราคา :</div></td>
                    <td width="20%"><input name="price" type="text" id="price" size="35" value="<?= $price; ?>" /></td>
                    <td width="20%" valign="top"><div align="right">จังหวัด : </div></td>
                    <td width="20%">
                        <select id="e_province1" name="e_province1">
                            <?php
                            include '../config.php';
                            $result = mysql_query("select * from tb_project where id_project='$id_edit'");
                            while ($rc = mysql_fetch_array($result)) {
                                $p_prov = $rc['prov'];
                                $p_amp = $rc['amp'];
                            }
                            $sql = "select * from province where PROVINCE_ID ='$p_prov'";
                            $result = mysql_query($sql);
                            $rc = mysql_fetch_array($result);
                            $p_prov_name = $rc['PROVINCE_NAME'];
                            ?>
                            <option value="<?= $p_prov ?>"><?= $p_prov_name ?></option>
                            <?php
                            $sql = "select * from province order by PROVINCE_ID asc";
                            $result = mysql_query($sql);
                            while ($rc = mysql_fetch_array($result)) {
                                if ($p_prov != $rc['PROVINCE_ID'])
                                    echo "<option value='" . $rc['PROVINCE_ID'] . "'>" . $rc['PROVINCE_NAME'] . "</option>";
                            }
                            ?>
                        </select>                    </td>
                </tr>
                <tr>
                    <td width="20%" valign="top">&nbsp;</td>
                    <td width="20%"><p class="style1">ข้อมูลเพิ่มเติม</p></td>
                    <td width="20%" valign="top"><div align="right">อำเภอ : </div></td>
                    <td width="20%">
                        <select id="e_amphur1" name="e_amphur1">
                            <?
                            $result = mysql_query("select * from amphur where AMPHUR_ID = '$p_amp'");
                            while ($rc = mysql_fetch_array($result)) {
                                $p_amp_name = $rc['AMPHUR_NAME'];
                            }
                            ?>
                            <option value="<?= $p_amp ?>"><?= $p_amp_name ?></option>
                        </select>                    </td>
                </tr>
                <tr>
                    <td width="20%" valign="top"><div align="right">feature :</div></td>
                    <td width="20%"><textarea name="feature" cols="30" rows="5" id="feature"><?= $feature; ?></textarea></td>
                    <td width="20%" valign="top"><div align="right">description :</div></td>
                    <td width="20%"><textarea name="description" cols="30" rows="5" id="description"><?= $descrip; ?></textarea></td>
                </tr>
                <tr>
                    <td width="20%" valign="top">&nbsp;</td>
                    <td colspan="3"><input type="submit" name="submit" id="submit" value="แก้ไขโครงการ" />
                        <INPUT NAME="id_edit" TYPE="hidden"  VALUE="<?= $id_project ?>"></td>
                </tr>
            </form>
        </table>

<!-- edit -->

        <form action="#" method="post" enctype="multipart/form-data" id="e_img" name="e_img">
            <script type="text/javascript">
                function show_picE(sc){
                    if($('#img_area').find('img').length < 14){
                        document.e_img.action='upload_imgE.php';
                        document.e_img.target='mye1';
                        document.e_img.submit();
                    }else{
                        alert('สามารถอัพรูปได้สูงสุด 14 รูปครับ !')
                    }
                }
                        
                function show_picEl(sc){
                    document.e_img.action='upload_imgEl.php';
                    document.e_img.target='mye';
                    document.e_img.submit();
                }
                function delMyImg1(my){
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
                function delMyImg2(my){
                    var name = $(my).prev().attr('alt');

                    $.ajax({
                        type:"GET",
                        url:"del_imgEl.php",
                        data:"name_del=" +name,
                        success:function(){
                                    
                        }
                    });
                    $(my).prev().remove();
                    $(my).remove();
                }
                function delMyImg3(my){
                    var name = $(my).prev().attr('alt');
                    $.ajax({
                        type:"GET",
                        url:"del_imgE.php",
                        data:"name_del=" +name,
                        success:function(){
                                    
                        }
                    });
                    $(my).prev().remove();
                    $(my).remove();
                }
                $(document).ready(function(){
                    $('#e_d_p').click(function(){
                        //1
                        var imgT = $('#img_area1').find('img').eq(0).attr('alt');
                        //2
                        var num = $('#img_area').find('img').length;
                        var i;
                        var mydata ="";
                        var img = new Array();
                        for(i =0;i<num;i++){
                            img[i] = $('#img_area').find('img').eq(i).attr('alt');
                            if(img[i] == undefined){
                                img[i] ='';
                            } else    
                                mydata +="&img"+i.toString()+"=" +img[i] ;
                        }

                        $.ajax({
                            type:"POST",
                            url:"edit_img.php",
                            data:"imgT=" + imgT +"&num=" + num + mydata+"&id=" +<?= $id_project ?>,
                            success: function(response){

                                window.location="edit_Project.php?id_edit=<?= $id_project ?>";
                                        
                            }
                        });
                    })
                })
            </script>

            <div id="img_area1" style="margin:0 0 0 50px;background: #eee;width:90%; padding:5px;text-align: center;">
                <img src='photo/<?= $img_pro; ?>' alt='<?= $img_pro ?>' width='120' height='130' border="0" ></img>
                <span style="cursor:pointer;" onclick="delMyImg2(this);">ลบ</span>
            </div>
            <div id="img_area" style="margin:0 0 0 50px;background: #eee;width:90%; padding:5px;">
                <?php
                $sql = "select * from img_pro where id_project = '$id_project'";
                $result = mysql_query($sql);
                while ($rc = mysql_fetch_array($result)) {
                    $imgs_pro = $rc['name_img'];
                    echo"<img src='project/$imgs_pro' alt='$imgs_pro' title='รูปภาพประกอบ' width='120' height='130'/>
                            <span style='cursor:pointer;' onclick='delMyImg3(this)'>ลบ</span>";
                }
                ?>
            </div>

            <div style="background: #ccc;text-align: center;padding:5px;width:90%;margin:0 0 0 50px;">
                <p>รูปโลโก้โครงการ :<input type="file" name="myfile" id="myfile" onchange="show_picEl(this.value);"></input></p>
                <p>รูปภาพประกอบ&nbsp; :<input type="file" name="myfile1" id="myfile1" onchange="show_picE(this.value);"></input></p>
                <p><input type="button" name="e_d_p" id="e_d_p" value="แก้ไขรูปภาพ"></input></p>
            </div>

            <iframe name="mye" width="0" height="1" frameborder="0"></iframe>
            <iframe name="mye1" width="0" height="1" frameborder="0"></iframe>
        </form>

        <?
        require_once('../config.php');
        $sql = "select * from tb_project order by id_project desc";
        $result = mysql_query($sql);
        $number = mysql_num_rows($result);
        $no = 1;

        if ($number <> 0) {
            ?>
            <table width='80%' border='1' align='center' cellpadding='1' cellspacing='1' bordercolor='#FFFFFF'>
                <tr bgcolor='#81DFE4'>
                    <td height='20' bgcolor='#CCCCCC' width='5%'><div align='center'>ชื่อ</div></td>
                    <td bgcolor='#CCCCCC' width='10%' ><div align='center'>ประเภท</div></td>
                    <td bgcolor='#CCCCCC' width='10%'><div align='center'>title</div></td>
                    <td bgcolor='#CCCCCC' width='10%'><div align='center'>แก้ไขล่าสุด</div></td>
                    <td bgcolor='#CCCCCC' width='5%'><div align='center'>แก้ไข</div></td>
                    <td bgcolor='#CCCCCC' width='5%'><div align='center'>ลบ</div></td>
                </tr>
                <?
                while ($rs = mysql_fetch_array($result)) {
                    $id_project = $rs['id_project'];
                    $name = $rs['name_pro'];
                    $type_pro = $rs['type_pro'];
                    $title_pro = $rs['title_pro'];
                    $date = $rs['date'];
                    ?>
                    <tr>
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><?= $name; ?></div></td>
                        <td valign="top" bgcolor='#FFFFCC'><div align='center'><?= $type_pro; ?></div></td>
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><?= $title_pro; ?></div></td>			
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><?= $date; ?></div></td>
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><a href="edit_Project.php?id_edit=<?= $id_project; ?>"><img src='photo/edit.png' alt='' width='20' height='20' border="0" /></a></div></td>
                        <TD height="20" valign="top" BGCOLOR=#FFFFCC><div align='center'><A href="delete_Project.php?id_del=<?= $id_project; ?>" 
                                                                                            onclick="return confirm('ยืนยันการลบสินค้า<?= $name ?>ออกจากระบบ')"><img src='photo/delete.png' alt='' width='20' height='20' border="0" /></a></div></TD>
                    </tr>
                    <?
                    $no++;
                }
                ?> 

            </table>
            <?
            mysql_close();
        }
        ?>

    </body>
</html>

