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
$sql="select * from tb_type where id_type='$id_edit' ";
$result=mysql_query($sql);
$rs=mysql_fetch_array($result);

$id_type=$rs['id_type'];
$name_type=$rs['name_type'];
$name_typeen=$rs['name_typeen'];
	 ?>    
     <FORM ACTION="edit_type2.php" METHOD="post" >
       <table width="100%" border="0">
         <tr>
           
           <td align="right"><div align="center">แก้ไขประเภทสินทรัพย์&nbsp; :&nbsp;
             <p>th :
               <input type="text" name="name" id="name" value="<?=$name_type;?>" /></p>
             <p>en :
               <input type="text" name="nameen" id="nameen" value="<?=$name_typeen;?>" /></p>
             <input type="submit" name="submit" id="submit" value="แก้ไข" />
             <INPUT NAME="id_edit" TYPE="hidden"  VALUE="<?=$id_edit?>">
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
     <form name="frmMain" action="delete_type.php" method="post" OnSubmit="return onDelete();">
  <? 
include ("../config.php");
$sql="select * from tb_type ";
$result=mysql_query($sql);
?>
        <table width="100%" border="0">
         <tr>
           <td width="5%" bordercolor="#F0F0F0" bgcolor="#FFFFCC"><div align="center">ลำดับ</div></td>
            <td bordercolor="#F0F0F0" bgcolor="#FFFFCC"><div align="center">ประเภท th</div></td>
            <td bordercolor="#F0F0F0" bgcolor="#FFFFCC"><div align="center">ประเภท en</div></td>
            <td width="10%" bordercolor="#F0F0F0" bgcolor="#FFFFCC"><div align="center">แก้ไข</div></td>
            <td width="10%" bordercolor="#F0F0F0" bgcolor="#FFFFCC"><div align="center"><input name="CheckAll" type="checkbox" id="CheckAll" value="Y" onClick="ClickCheckAll(this);">ลบ</div></td>
          </tr>
  <? 
$i = 0;
while($rs=mysql_fetch_array($result)) {
$i++;
?>
         <tr>
           <td width="10" valign="top"><?=$rs['id_type']?></td>
            <td valign="top"><?=$rs['name_type']?></td>
            <td valign="top"><?=$rs['name_typeen']?></td>
            <td valign="top"><div align="center"><A HREF=edit_type.php?id_edit=<?=$rs['id_type']?>><img src="photo/edit.png" width="20" height="20" border='0' /></A></div></td>
            <td valign="top"><div align="center">
              <input type="checkbox" name="chkDel[]" id="chkDel<?=$i;?>" value="<?=$rs['id_type'];?>">
            <img src="photo/Delete.png" width="20" height="20" border='0' /></div></td>
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