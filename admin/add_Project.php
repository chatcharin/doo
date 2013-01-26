
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--        <link rel="stylesheet" type="text/css" href="css/css.css"  />-->
        <script type="text/javascript" src="jscripts/jquerys.js"></script>
        <script type="text/javascript" src="jscripts/default.js"></script>
        <style type="text/css">
            <!--
            .style1 {color: #CC0000}
            -->
        </style>
        <script language="javascript">
            function show_pic1(sc){
                if($('#img_area').find('img').length < 14){
                    document.addproject.action='upload_img_pro.php';
                    document.addproject.target='mypre';
                    document.addproject.submit();
                }else{
                    alert('สามารถอัพรูปได้สูงสุด 14 รูปครับ !')
                }
            }
            function show_pic2(sc){
                document.addproject.action='upload_img_1.php';
                document.addproject.target='mypre1';
                document.addproject.submit();
            }
            function delMyImg1(my){
                var name = $(my).prev().attr('alt');
                $.ajax({
                    type:"GET",
                    url:"del_img.php",
                    data:"name_del=" +name,
                    success:function(){

                    }
                });
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

        <table width="70%" border="0" align="center" ><br />
            <form id="addproject" name="addproject" method="post" enctype="multipart/form-data" action="#">
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
                            <input name="name" type="text" id="name" size="35" />
                        </label></td>
                    <td width="20%" valign="top"><div align="right">ดำเนินงานโดย :</div></td>
                    <td width="20%"><input name="manage" type="text" id="manage"  size="35" /></td>
                </tr>
                <tr>
                    <td width="20%" valign="top" ><div align="right">ประเภทโครงการ :</div> </td>
                    <td width="20%"><label>
                            <select name="type" id="type">
                                <option value="">เลือก</option>
                                <option value="คอนโดมิเนียม">คอนโดมิเนียม</option>
                                <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                                <option value="ทาวน์โฮม">ทาวน์โฮม</option>
                            </select>
                        </label></td>
                    <td width="20%" valign="top"><div align="right">เบอร์ติดต่อ :</div></td>
                    <td width="20%"><label>
                            <input name="tel" type="text" id="tel" size="35" />
                        </label></td>
                </tr>
                <tr>
                    <td width="20%" rowspan="2" valign="top"><div align="right">ข้อมูลแนะนำ ( title ) :</div></td>
                    <td width="20%" rowspan="2"><label>
                            <textarea name="title" cols="30" rows="3" id="title"></textarea>
                        </label></td>
                    <td width="20%" valign="top"><div align="right">เว็บไซต์ :</div></td>
                    <td width="20%"><input name="web" type="text" id="web" size="35" /></td>
                </tr>
                <tr>
                    <td width="20%" valign="top"><div align="right">อีเมล :</div></td>
                    <td width="20%"><input name="email" type="text" id="email" size="35" /></td>

                </tr>  
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("select[name='e_province']").change(function(){

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
                                                $('#e_amphur').children().remove()
                                                $('#e_amphur').append("<option value='เลือกอำเภอ'>- เลือกอำเภอ -</option>");
                                                for(i=0;i<countName;i++){
                                                    $('#e_amphur').append("<option value='"+id[i]+"'>"+name[i]+"</option>");
                                                }
                                            }
                            
                                        });
                                    }
                                });
                            }else{
                                $('#e_amphur').children().remove();
                                $('#e_amphur').append("<option value='เลือกอำเภอ'>- เลือกอำเภอ -</option>");
                            }

                        }); 
                        
                        
                    });
                </script>
                <tr>
                    <td width="20%" valign="top"><div align="right">ราคา :</div></td>
                    <td width="20%"><input name="price" type="text" id="price" size="35" /></td>
                    <td width="20%" valign="top"><div align="right">จังหวัด :</div></td>
                    <td width="20%">
                        <select id="e_province" name="e_province">
                            <option value="เลือกจังหวัด">- เลือกจังหวัด -</option>
                            <?php
                            include '../config.php';
                            $sql = "select * from province order by PROVINCE_ID asc";
                            $result = mysql_query($sql);
                            while ($rc = mysql_fetch_array($result)) {
                                echo "<option value='" . $rc['PROVINCE_ID'] . "'>" . $rc['PROVINCE_NAME'] . "</option>";
                            }
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%" valign="top">&nbsp;</td>
                    <td width="20%"><p class="style1">ข้อมูลเพิ่มเติม</p></td>
                    <td width="20%" ><div align="right">อำเภอ :</div></td>
                    <td width="20%">
                        <select id="e_amphur">
                            <option value="เลือกอำเภอ">-เลือกอำเภอ-</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%" valign="top"><div align="right">feature :</div></td>
                    <td width="20%"><textarea name="feature" cols="30" rows="5" id="feature"></textarea></td>
                    <td width="20%" valign="top"><div align="right">description :</div></td>
                    <td width="20%"><textarea name="description" cols="30" rows="5" id="description"></textarea></td>
                </tr>
                <tr>
                    <td width="25%"><div align="right" class="style1">รูปโลโก้โครงการ : </div></td>
                    <td colspan="3"><input type="file" name="upload" id="upload" onchange="show_pic2(this.value);"/><INPUT TYPE="hidden" NAME="MAX_FILE_SIZE" VALUE="1000000"></td>
                    <iframe name="mypre1" width="0" height="1" frameborder="0"></iframe>
                </tr>
                <tr>
                    <td width="25%"><div align="right" class="style1">รูปภาพประกอบ : </div></td>
                    <td colspan="3"><input type="file" name="file_my" id="file_my" onchange="show_pic1(this.value);"></input></td>
                    <iframe name="mypre" width="0" height="1" frameborder="0"></iframe>
                </tr>
            </form>

        </table>
        <div id="img_area1" style="margin:0 0 0 50px;background: #eee;width:90%; padding:5px;text-align: center;"></div>
        <div id="img_area" style="margin:0 0 0 50px;background: #eee;width:90%; padding:5px;"></div>
        <div style="text-align:center;"><input type="button" name="submitPro" id="submitPro" value="เพิ่มโครงการใหม่" style="margin:10px; text-align: center;" /></div>
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
                    $type = $rs['type_pro'];
                    $title_pro = $rs['title_pro'];
                    $date = $rs['date'];
                    ?>	
                    <tr>
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><?= $name; ?></div></td>
                        <td valign="top" bgcolor='#FFFFCC'><div align='center'><?= $type; ?></div></td>
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><?= $title_pro; ?></div></td>			
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><?= $date; ?></div></td>
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><a href="edit_Project.php?id_edit=<?= $id_project; ?>"><img src='photo/edit.png' alt='' width='20' height='20' border="0" /></a></div></td>
                        <td height="20" valign="top" bgcolor=#FFFFCC><div align='center'><A href="delete_Project.php?id_del=<?= $id_project; ?>" onclick="return confirm('ยืนยันการลบสินค้า <?= $name; ?> ออกจากระบบ')"><img src='photo/delete.png' alt='' width='20' height='20' border="0" /></a></div></td>
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
     </div>
    </body>
</html>

