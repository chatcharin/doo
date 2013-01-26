
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <link rel="stylesheet" type="text/css" href="css/css.css"  />
</head>
<body>
	<?php include('header.php');?>
	<div id="dashboard">
	   		<?php  include('menu.php');?>

        <div style="widht:90%;min-height: 100px;background: #eee;padding:10px;">
            <table width='90%' border='1' align='center' cellpadding='1' cellspacing='1' bordercolor='#fff'>
                <tr bgcolor='#eee'>
                    <td height='20' bgcolor='#CCCCCC' width='5%'><div align='center'>ชื่อ</div></td>
                    <td bgcolor='#ccc' width='10%' ><div align='center'>ประเภท</div></td>
                    <td bgcolor='#ccc' width='10%'><div align='center'>แก้ไขล่าสุด</div></td>
                    <td bgcolor='#ccc' width='5%'><div align='center'>แก้ไข</div></td>
                    <td bgcolor='#ccc' width='5%'><div align='center'>ลบ</div></td>
                </tr> 
                <?
                include '../config.php';
                $result = mysql_query("select * from tb_general");
                while ($rs = mysql_fetch_array($result)) {
                    $my_id = $rs['id_gen'];
                    $my_topic = $rs['topic'];
                    $my_type = $rs['id_type'];
                    $result2 = mysql_query("select * from tb_type where id_type='$my_type'");
                    while ($rc = mysql_fetch_array($result2)) {
                        $my_type1 = $rc['name_type'];
                    }
                    $my_date = $rs['date'];
                    ?>
                    <tr>
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><?= $my_topic; ?></div></td>
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><?= $my_type1; ?></div></td>			
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><?= $my_date; ?></div></td>
                        <td height="20" valign="top" bgcolor='#FFFFCC'><div align='center'><a href="edit_post2.php?id_edit=<?= $my_id; ?>"><img src='photo/edit.png' alt='' width='20' height='20' border="0" /></a></div></td>
                        <td height="20" valign="top" bgcolor=#FFFFCC><div align='center'><A href="del_post.php?id_del=<?= $my_id; ?>" onclick="return confirm('ยืนยันการลบสินค้า <?= $name; ?> ออกจากระบบ')"><img src='photo/delete.png' alt='' width='20' height='20' border="0" /></a></div></td>
                    </tr>
                    <?
                }
                mysql_close();
                ?> 
            </table>
        </div>
		</div>
    </body>
</html>