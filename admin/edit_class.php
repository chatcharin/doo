<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/css.css"  />
</head>
<body>

<table width="100%" border="0" align="center">
  <tr>
    <td>
     <? 
$id_edit=$_GET['id_edit'];
include "../config.php";
$sql1="select * from tb_class where id_class='$id_edit' ";
$result1=mysql_query($sql1);
$rs=mysql_fetch_array($result1);

$id_class=$rs['id_class'];
$name_class=$rs['name_class'];
$name_classen=$rs['name_classen'];
$shot=$rs['shot'];

	 ?>    
     <FORM ACTION="edit_class2.php" METHOD="post" >
       <table width="100%" border="0">
         <tr>
           
           <td align="right"><div align="center">
                <p>แก้ไขประเภทประกาศ </p>
                <p>th : 
                  <input type="text" name="name" id="name" value="<?=$name_class;?>" /></p>
                <p>en : 
                  <input type="text" name="nameen" id="nameen" value="<?=$name_classen;?>"  /></p>
                <p>ตัวย่อ<input type="text" name="shot" id="shot" value="<?=$shot;?>"/></p>          	
                <p><input type="submit" name="submit" id="submit" value="แก้ไข" />
             	   <INPUT NAME="id_edit" TYPE="hidden"  VALUE="<?=$id_edit?>"/></p>

             </div></td>
              </tr>
         </table>
     </FORM>
     <script language="JavaScript">
	function ClickCheckAll(vol)
	{
	
		var i=1;
		for(i=1;i<=document.frmMain.hdnCount.value;i++)
		{
			if(vol.checked == true)
			{
				eval("document.frmMain.chkDel"+i+".checked=true");
			}
			else
			{
				eval("document.frmMain.chkDel"+i+".checked=false");
			}
		}
	}

	function onDelete()
	{
		if(confirm('Do you want to delete ?')==true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
     </script>     
     <form name="frmMain" action="delete_class.php" method="post" OnSubmit="return onDelete();">
  <? 
include ("../config.php");
$sql="select * from tb_class ";
$result=mysql_query($sql);
?>
       <table width="100%" border="0">
         <tr>
           <td width="5%" bordercolor="#F0F0F0" bgcolor="#FFFFCC"><div align="center">ลำดับ</div></td>
            <td bordercolor="#F0F0F0" bgcolor="#FFFFCC"><div align="center">ประเภท th</div></td>
            <td bordercolor="#F0F0F0" bgcolor="#FFFFCC"><div align="center">ประเภท en</div></td>
            <td bordercolor="#F0F0F0" bgcolor="#FFFFCC"><div align="center">ตัวย่อ</div></td>
            <td width="10%" bordercolor="#F0F0F0" bgcolor="#FFFFCC"><div align="center">แก้ไข</div></td>
            <td width="10%" bordercolor="#F0F0F0" bgcolor="#FFFFCC"><div align="center"><input name="CheckAll" type="checkbox" id="CheckAll" value="Y" onClick="ClickCheckAll(this);">ลบ</div></td>
          </tr>
  <? 
$i = 0;
while($rs=mysql_fetch_array($result)) {
$i++;
?>
         <tr>
           <td width="10" valign="top"><?=$rs['id_class']?></td>
            <td valign="top"><div align="center">
              <?=$rs['name_class']?>
            </div></td>
            <td valign="top"><div align="center">
              <?=$rs['name_classen']?>
            </div></td>
            <td valign="top"><div align="center">
              <?=$rs['shot']?>
            </div></td>
            <td valign="top"><div align="center"><A HREF=edit_class.php?id_edit=<?=$rs['id_class']?>><img src="photo/edit.png" width="20" height="20" border='0'/></A></div></td>
            <td valign="top"><div align="center">
              <input type="checkbox" name="chkDel[]" id="chkDel<?=$i;?>" value="<?=$rs['id_class'];?>">
            <img src="photo/Delete.png" width="20" height="20" border='0'/></div></td>
          </tr><? } ?>
        </table>
       <div align="right">
         <input type="submit" name="btnDelete" value="Delete">
         <input type="hidden" name="hdnCount" value="<?=$i;?>">
        </div>
      </form></td>
  </tr>
</table>

</body>
</html>