<script type="text/javascript">
     function searchamp(v){
	       $.ajax({
                type:"POST",
                url:"amp.php",
                data:"pro_id="+v,
                success:function(marker){
                    $('#district').html(marker);
                }
            });
	 }
</script>
<div class="search">
	<div id="content_search">
             <form method="" id="search_form" action="post_search.php">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		   <td align="right">ประเภทอสังหาฯ : </td>
		   <td align="left">
                       <select name="type_id">
                           <option value="">ทุกประเภท</option>
                            <?php require_once 'class.php'; ?>
                      </select>
                   </td>
			<td align="right">ประเภทประกาศ : </td>
			<td align="left">
                            <select name="class_id">
                                <option value="">ทุกประกาศ</option>
                                <?php require_once 'c_type.php'; ?>
                            </select>
                        </td>
			</tr>
		  <tr>
		  <td align="right">จังหวัด : </td>
			<td align="left">
                            <select onchange="searchamp(this.value);"  name="province" >
                                <option value="">ทุกจังหวัด</option>
                                <?php require_once 'prov.php'; ?>
                             </select>
                        </td>
			<td align="right">อำเภอ :</td>
			<td align="left">
                           <select id="district" name="district" >
                             <?php require_once 'amp.php'; ?>
                            </select>
                        </td>
		  </tr>
		  <tr>
			<td align="right">ช่วงราคาต่ำสุด : </td>
			<td align="left">
                            <input class="text" onclick="this.value='';" onblur="if(this.value==''){this.value='ราคาต่ำสุด'};" name="lowcost" type="text" value="ราคาต่ำสุด" />
                        </td>
			<td align="right">ถึงราคาสูงสุด : </td>
			<td align="left">
                            <input class="text" onclick="this.value='';" onblur="if(this.value==''){this.value='ราคาสุงสุด'};" name="hicost" type="text" value="ราคาสูงสุด" />
                        </td>
			</tr>
		  <tr>
			<td align="right">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="left">
		     
		        <input type="submit"  value="ค้นหา" />
	         <div align="right"><a href="#" class="search_hide"><img src="images/topIcon.png" width="19" height="19"  border="0"/></a></div></td>
			</tr>
		</table>
             </form>
</div>    
</div>
