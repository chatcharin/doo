<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<?
$id_edit=$_GET['id_edit'];
include "../config.php";
$sql="select * from tb_news where id_news='$id_edit' ";
$result=mysql_query($sql);
$rs=mysql_fetch_array($result);

$name=$rs['name'];
$detail=$rs['detail'];
$photo=$rs['photo'];
?>
<table width="80%" border="0" align="center"><br />
  <form id="edit_new2" method="post" ENCTYPE="multipart/form-data" action="edit_news2.php">
  <tr>
    <td width="20%">&nbsp;</td>
    <td>
     <h1> แก้ไขบทความข่าว</h1></td>
  </tr>
  <tr>
    <td width="20%" ><div align="right">หัวข้อบทความ :</div></td>
    <td><input name="name" type="text" id="name" size="35" VALUE="<?=$name?>"/></td>
  </tr>
  <tr>
    <td width="20%" valign="top"><div align="right">รายละเอียด :</div></td>
    <td><textarea id="detail" name="detail" rows="15" cols="80" style="width: 80%"><?php echo htmlentities($detail, ENT_QUOTES, "UTF-8");?></textarea>
	<!--<textarea name="detail" cols="50" rows="10" id="detail"></textarea> --></td>
  </tr>
  <tr>
    <td width="20%" valign="top"><div align="right">รูปประกอบ :</div></td>
    <td valign="top">
     <?
		if ($photo<>"") {
				echo "<a href='photo/$photo'><img src='photo/$photo' width='50' height='50' alt='' border='0' /><a/>";
				echo "<INPUT TYPE='file' NAME='fileupload' >";
				echo "<INPUT TYPE='hidden' name='MAX_FILE_SIZE' value='100000'>";		 
		} else {
				echo "<INPUT TYPE='file' NAME='fileupload' >";
				echo "<INPUT TYPE='hidden' name='MAX_FILE_SIZE' value='100000'>";
		}
	  ?>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="ตกลง" />
     	<INPUT NAME="id_edit" TYPE="hidden"  VALUE="<?=$id_edit?>">
        <INPUT NAME="photo" TYPE="hidden"  VALUE="<?=$photo?>">
    </td>
  </tr>
  </form>
</table>
</div>
</body>
</html>
