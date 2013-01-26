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
<div id="search-box">
					<div id="head_search">ค้นหาประกาศ - Search</div>
						<form method="" id="search_form" action="post_search.php">
						<div id="col_search">
							<b>ประเภทอสังหาฯ :</b> <br />
								<select name="type_id">
									<option value="">ทุกประเภท</option>
									<?php  require_once 'class.php'; ?>
							    </select>
							<br /><br />
							<b>ประเภทอสังหาฯ : </b><br />
								<select name="class_id">
									<option value="">ทุกประกาศ</option>
									<?php  require_once 'c_type.php'; ?>
								</select>	
						</div>
						<div id="col_search">
							<b>จังหวัด : </b><br />
								<select onchange="searchamp(this.value);"  name="province" >
									<option value="">ทุกจังหวัด</option>
									<?php  require_once 'prov.php'; ?>
							    </select>
							<br /><br />
							<b>อำเภอ :</b> <br />
								<select id="district" name="district" >
									<?php  require_once 'amp.php'; ?>
								</select>	
						</div>
						<div id="col_search">
							<b>ช่วงราคา : </b><br />
								<input class="text" onclick="this.value='';" onblur="if(this.value==''){this.value='ราคาต่ำสุด'};" name="lowcost" type="text" value="ราคาต่ำสุด" />
							<br /><br />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ถึง <br />
								<input class="text" onclick="this.value='';" onblur="if(this.value==''){this.value='ราคาสุงสุด'};" name="hicost" type="text" value="ราคาสูงสุด" />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="button" id="submit" value="เริ่มค้นหา" type="submit">		
						</div> 	
        			</form>
					<div id="clear"></div>
				</div>