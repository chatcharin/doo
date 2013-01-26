<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<!-- TinyMCE -->
<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
     <link rel="stylesheet" type="text/css" href="css/css.css"  />
</head>
<body>
	<?php include('header.php');?>
	<div id="dashboard">
	   		<?php  include('menu.php');?>
<table width="80%" border="0" align="center"><br />
  <form id="add_new" method="post" ENCTYPE="multipart/form-data" action="add_news2.php">
  <tr>
    <td width="20%"></td>
    <td>
    เพิ่มบทความข่าว</td>
  </tr>
  <tr>
    <td width="20%" ><div align="right">หัวข้อบทความ :</div></td>
    <td><input name="name" type="text" id="name" size="35" /></td>
  </tr>
  <tr>
    <td width="20%" valign="top"><div align="right">รายละเอียด :</div></td>
    <td><textarea id="detail" name="detail" rows="15" cols="80" style="width: 80%"><?php //echo htmlentities($detail, ENT_QUOTES, "UTF-8");?></textarea>
	<!--<textarea name="detail" cols="50" rows="10" id="detail"></textarea> --></td>
  </tr>
  <tr>
    <td width="20%"><div align="right">รูปประกอบ :</div></td>
    <td><INPUT  TYPE="file" NAME="fileupload">		
	    <INPUT TYPE="hidden" NAME="MAX_FILE_SIZE" VALUE="1000000">
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="ตกลง" /></td>
  </tr>
  </form>
</table>
<hr />
<h1 align="center">บทความข่าวทั้งหมด</h1>
<?  require_once('../config.php');
$sql="select * from tb_news order by id_news desc";
$result=mysql_query($sql);
$number=mysql_num_rows($result);
$no=1; 
 
	if ($number<>0) {
?>
	<table width='80%' align='center' cellpadding='1' cellspacing='1' >
		<tr bgcolor='#81DFE4'>
			<td height='20' bgcolor='#CCCCCC' width='10%'><div align='center'>รูปประกอบ</div></td>
	  			<td bgcolor='#CCCCCC' width='20%'><div align='center'>หัวข้อบทความ</div></td>
	  		    <td bgcolor='#CCCCCC'><div align='center'>รายละเอียด</div></td>
	  		    <td bgcolor='#CCCCCC' width='10%'><div align='center'>แก้ไขล่าสุด</div></td>
	  		    <td bgcolor='#CCCCCC' width='5%'><div align='center'>แก้ไข</div></td>
				<td bgcolor='#CCCCCC' width='5%'><div align='center'>ลบ</div></td>
	  		  </tr> 
<?
	while($rs=mysql_fetch_array($result)) {
		$id_news=$rs['id_news'];
		$name=$rs['name'];
		$detail=$rs['detail'];
		$photo=$rs['photo'];
		$date=$rs['date'];
		if(strlen($detail)>200) {
			 mb_internal_encoding("UTF-8");
			$detail= mb_substr($detail,0,200)."...";
		}
?>
			<tr>
	  			<td><div align='center'><a href="photo/<?=$photo;?>"/><img src='photo/<?=$photo;?>' width='50' height='50' alt='' border='0' ></div></td>	  			
	  			<td><div align='center'><?=$name;?></div></td>
	  		    <td><div align='center'><?=$detail;?></div></td>
	  		    <td><div align='center'><?=$date;?></div></td>
	  		    <td><div align='center'><a href="edit_news.php?id_edit=<?=$id_news;?>"/><img src='photo/edit.png' width='20' height='20' alt='' border='0'/></a></div></td>
				<TD><div align='center'><a href="delete_news.php?id_del=<?=$id_news;?>&photo_del=<?=$photo;?>" 
				onclick="return confirm('ยืนยันการลบสินค้า <?=$name;?> ออกจากระบบ');" ><img src='photo/delete.png' width='20' height='20' alt='' border='0'/></a></div></TD>
	  		  </tr>
      
<?	$no++;  }  ?>
	
</TABLE>
<? 	mysql_close();  }  ?>
</div>
</body>
</html>