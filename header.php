<div id="header">
			<div id="logo_home">
				<a id="logo" href="/" title="Property Lanna (ศูนย์บริการซื้อขายคอนโด บ้าน บ้านมือสอง ขายบ้าน ทั่วไทย)">คอนโด บ้านมือสอง ขายบ้าน</a>			
			</div>
			
				<div id="menu_language">
					<ul class="language">
						<li><a href="#" title="ไทย"><em class="th"></em><strong>ไทย</strong></a></li>
						<li><a href="#" title="English"><em class="en"></em><strong>English</strong></a></li>
					</ul>
				</div>
				<div id="menu_nav1">
					<ul class="menu1">
						<li><a href="index.php" title="หน้าแรก">หน้าแรก</a></li>
						<li><a href="view_projectall.php" title="บ้านในโครงการ">บ้านในโครงการ</a></li>
						<li><a href="service.php" title="บริการลงประกาศ">บริการลงประกาศ</a></li>
						<li><a href="about.php" title="เกี่ยวกับบริษัท">เกี่ยวกับบริษัท</a></li>
						<li><a href="job.php" title="สมัครงาน">สมัครงาน</a></li>
						<li><a href="advert.php" title="ข้อมูลโฆษณา">ข้อมูลโฆษณา</a></li>
						<li><a href="contact.php" title="ติดต่อเรา">ติดต่อเรา</a></li>
					</ul> 
				</div>
			
			<div id="menu_nav2">
				<ul class="menu2">
					<?php
                        include "config.php";
                        $sql = "select * from tb_type";
                        $result = mysql_query($sql);
                        $num = mysql_num_rows($result);
							while ($r = mysql_fetch_array($result)) {
                                    $id_type = $r['id_type'];
                                    $name_type = $r['name_type'];
                                     	echo "<li><a href='post_type.php?id_type=$id_type'><em class=\"home\"></em><b>$name_type</b></a></li>";
                        } ?>
			  </ul>
			</div>
			<div id="clear"></div>
		</div><!--end header -->