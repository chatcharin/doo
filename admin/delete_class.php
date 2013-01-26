<?
include "../config.php";

	
	for($i=0;$i<count($_POST["chkDel"]);$i++)
	{
		if($_POST["chkDel"][$i] != "")
		{
		    echo "".$_POST["chkDel"][$i]."";
			
			$sql="delete from tb_class where id_class='".$_POST["chkDel"][$i]."' ";
			$result=mysql_query($sql);
			
		}
	}

if ($result) {
	echo("<meta http-equiv='refresh' content='0;URL=add_class.php'>");
} else {
    
	echo "<H3>ERROR : ไม่สามารถลบสินค้าได้</H3>";
}
mysql_close();
?>
