<?
include "../config.php";
	
	for($i=0;$i<count($_POST["chkDel"]);$i++)
	{
		if($_POST["chkDel"][$i] != "")
		{
			$sql="delete from tb_comment where id_com='".$_POST["chkDel"][$i]."' ";
			$result=mysql_query($sql);

		}
	}
	
if ($result) {
	echo("<meta http-equiv='refresh' content='0;URL=view_comment.php'>");
} else {
 	
	echo "<H3>ERROR : ไม่สามารถลบสินค้าได้</H3>";
}
mysql_close();
?>
