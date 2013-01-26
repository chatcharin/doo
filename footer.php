	<div id="footer_all">
		<div id="footer"> 
			<ul class="menu_footer">
                        <?
                        $sql = "select * from tb_type";
                        $result = mysql_query($sql);
                        $num = mysql_num_rows($result);
							while ($r = mysql_fetch_array($result)) {
                                    $id_type = $r['id_type'];
                                    $name_type = $r['name_type'];
                                     	echo "<li><a href='post_type.php?id_type=$id_type'><em class=\"home\"></em>$name_type</a></li>";
                        } ?>				
			  </ul>
			  <div id="footer_link">
			  	<a href="contact.php">ติดต่อเรา</a> | <a href="about.php">เกี่ยวกับบริษัท</a> | <a href="advert.php">ลงโฆษณากับเรา</a> | <a href="admin">เข้าสู่ระบบพนักงาน </a><br /><br />
				Copyright © 2012, Property-lanna, All rights reserved.
			  </div>
		</div>
	</div>