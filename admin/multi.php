<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/css.css"  />
    </head>
    <body>
        <?php include('header.php'); ?>
        <div id="dashboard">
            <?php include('menu.php'); ?>
            <table width="60%" border="0" align="center"><br />
                <form method="post" ENCTYPE="multipart/form-data" action="multi2.php">
                    <tr>
                        <td width="25%">&nbsp;</td>
                        <td><br />
                            ไฟล์ Multimedia</td>
                    </tr>
                    <tr>
                        <td width="25%" valign="top"><div align="right">เลือกไฟล์ :</div></td>
                        <td><input name="fileupload" type="file" id="fileupload" size="35" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="submit" id="submit" value="ตกลง" /></td>
                    </tr>
                </form>
            </table>
            <?
            require_once('../config.php');
            $sql = "select * from tb_multi order by id_multi desc";
            $result = mysql_query($sql);
            $number = mysql_num_rows($result);
            $no = 1;

            if ($number <> 0) {
                ?>
                <table width='80%' align='center' cellpadding='1' cellspacing='1' >
                    <tr bgcolor='#81DFE4'>
                        <td height='20' bgcolor='#CCCCCC' width='10%'><div align='center'>รูปแบบไฟล์</div></td>
                        <td bgcolor='#CCCCCC' width='20%'><div align='center'>ตำแหน่งไฟล์</div></td>
                        <td bgcolor='#CCCCCC' width='10%'><div align='center'>ขนาดไฟล์</div></td>
                        <td bgcolor='#CCCCCC' width='10%'><div align='center'>วันที่ upload</div></td>
                        <td bgcolor='#CCCCCC' width='5%'><div align='center'>ลบ</div></td>
                    </tr>
                    <?
                    while ($rs = mysql_fetch_array($result)) {
                        $id_multi = $rs['id_multi'];
                        $name = $rs['name'];
                        $path = $rs['path'];
                        $size = $rs['size'];
                        $date = $rs['date'];
                        ?>
                        <tr>
                            <td><div align='center'>
                                    <?php
                                    if ($name) {
                                        $array_last = explode(".", $name);
                                        $c = count($array_last) - 1;
                                        $lastname = strtolower($array_last[$c]);

                                        if ($lastname == "gif" or $lastname == "png" or $lastname == "jpg") {
                                            echo "<a href='upload/$name' target='_blank'><img src='upload/$name' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "doc" or $lastname == "docx") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/doc.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "ppt" or $lastname == "pptx") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/ppt.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "xls" or $lastname == "xlsx") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/xls.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "swf") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/swf.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "pdf") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/pdf.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "mp3") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/mp3.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "avi") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/avi.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "mpeg") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/mpeg.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "txt") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/txt.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "wav") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/wav.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "wma") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/wma.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "wmv") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/wmv.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "rar") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/rar.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                        if ($lastname == "zip") {
                                            echo "<a href='upload/$name' target='_blank'><img src='type_file/zip.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                        }
                                    } else {
                                        echo "<a href='upload/$name' target='_blank'><img src='type_file/type_home.png' width='40px' height='40px' border='0'/><br/>ตัวอย่างไฟล์</a>";
                                    }
                                    ?>
                                </div></td>	  			
                            <td><div align='center'><?= $path; ?></div></td>
                            <td><div align='center'><?= $size; ?></div></td>
                            <td><div align='center'><?= $date; ?></div></td>
                            <TD><div align='center'><a href="delete_multi.php?id_del=<?= $id_multi; ?>&photo_del=<?= $name; ?>" 
                                                       onclick="return confirm('ยืนยันการลบสินค้า <?=$name?> ออกจากระบบ');"><img src='photo/delete.png' width='20' height='20' alt='' border='0'/></a></div></TD>
                        </tr>
        <? $no++;
    } ?>  </TABLE>
    <? mysql_close();
} ?>
        </div>
    </body>
</html>

