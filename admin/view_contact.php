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

<table width="100%" border="0" align="center">
  <tr>
    <td><script language="JavaScript">
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
      <form name="frmMain" action="delete_contact.php" method="post" OnSubmit="return onDelete();">
  <? 
include ("../config.php");
$sql="select * from tb_problem order by id_prob DESC ";
$result=mysql_query($sql);
?>
		<h4>แจ้งปัญหาการใช้งาน</h4>
        <table width="100%" border="0">
          <tr>
            <td width="5%" bordercolor="#F0F0F0" bgcolor="#999999"><div align="center">ลำดับ</div></td>
            <td bordercolor="#F0F0F0" width="15%" bgcolor="#999999"><div align="center">ชื่อ</div></td>
            <td bordercolor="#F0F0F0" width="15%" bgcolor="#999999"><div align="center">อีเมล</div></td>
            <td width="15%" bordercolor="#F0F0F0" bgcolor="#999999"><div align="center">เบอร์ติดต่อ</div></td>
            <td  bordercolor="#F0F0F0" bgcolor="#999999"><div align="center">รายละเอียด</div></td>
            <td width="10%" bordercolor="#F0F0F0" bgcolor="#999999"><div align="center">วัน</div></td>
            <td width="10%" bordercolor="#F0F0F0" bgcolor="#999999"><div align="center">เวลา</div></td>
            <td width="7%" bordercolor="#F0F0F0" bgcolor="#999999"><div align="center"><input name="CheckAll" type="checkbox" id="CheckAll" value="Y" onClick="ClickCheckAll(this);">ลบ</div></td>
          </tr>
  <? 
$i = 0;
while($rs=mysql_fetch_array($result)) {
$i++;
?>
          <tr>
            <td width="10" valign="top"><div align="center"><?=$rs['id_prob']?></div></td>
            <td valign="top"><?=$rs['name']?></td>
            <td valign="top"><?=$rs['email']?></td>
            <td width="30" valign="top"><?=$rs['tel']?></td>
            <td valign="top"><?=$rs['detail']?></td>
            <td valign="top"><div align="center"><span class="style2">
              <?=$rs['date']?>
            </span></div></td>
            <td valign="top"><div align="center"><span class="style2">
              <?=$rs['time']?>
            </span></div></td>
            <td valign="top"><div align="center">
              <input type="checkbox" name="chkDel[]" id="chkDel<?=$i;?>" value="<?=$rs['id_prob'];?>">
            </div></td>
          </tr><? } ?>
        </table>
       <div align="right">
         <input type="submit" name="btnDelete" value="Delete">
         <input type="hidden" name="hdnCount" value="<?=$i;?>">
        </div>
      </form></td>
  </tr>
</table>
</div>
</body>
</html>