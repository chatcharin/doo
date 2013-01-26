<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

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
      <form name="frmMain" action="delete_comment.php" method="post" OnSubmit="return onDelete();">
  <? 
include ("../config.php");
$sql="select * from tb_question order by id_ques DESC ";
$result=mysql_query($sql);
?>
		<h4>ติดต่อข้อมูล โครงการ </h4>
        <table width="100%" border="0">
          <tr>
            <td width="10%" bordercolor="#F0F0F0" bgcolor="#999999"><div align="center">วัน/เวลา</div></td>
            <td bordercolor="#F0F0F0" width="15%" bgcolor="#999999"><div align="center">ติดต่อ</div></td>
            <td bordercolor="#F0F0F0" width="15%" bgcolor="#999999"><div align="center">โครงการ</div></td>
            <td width="15%" bordercolor="#F0F0F0" bgcolor="#999999"><div align="center">ชื่อ</div></td>
            <td bordercolor="#F0F0F0" bgcolor="#999999"><div align="center">อีเมล</div></td>
            <td bordercolor="#F0F0F0" bgcolor="#999999"><div align="center">ข้อความเพิ่มเติม</div></td>
            <td width="7%" bordercolor="#F0F0F0" bgcolor="#999999"><div align="center"><input name="CheckAll" type="checkbox" id="CheckAll" value="Y" onClick="ClickCheckAll(this);">ลบ</div></td>
          </tr>
  <? 
$i = 0;
while($rs=mysql_fetch_array($result)) {
$id_ques=$rs['id_ques'];
$id_project=$rs['id_project'];
$request=$rs['request'];
$name=$rs['name'];
$email=$rs['email'];
$question=$rs['question'];
$date=$rs['date'];
$time=$rs['time'];
 
 	$sql2 = "select * from tb_project where id_project='$id_project' ";
    $result2 = mysql_query($sql2);
    $rs2 = mysql_fetch_array($result2);
    	$id_project = $rs2['id_project'];
        $name_pro = $rs2['name_pro'];
$i++;
?>
          <tr>
            <td width="10" valign="top">วัน : <?=$date;?><br/>เวลา : <?=$time;?></td>
            <td valign="top"><?=$request;?></td>
            <td valign="top"><a href="../detail_project.php?id_pro=<?=$id_project;?>" target="_blank" class="view"><?=$name_pro;?></a></td>
            <td width="30" valign="top"><?=$name;?></td>
            <td valign="top"><?=$email;?></td>
            <td valign="top"><div align="center"><span class="style2">
              <?=$question;?>
            </span></div></td>
            <td valign="top"><div align="center">
              <input type="checkbox" name="chkDel[]" id="chkDel<?=$i;?>" value="<?=$id_pro;?>">
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
</body>
</html>