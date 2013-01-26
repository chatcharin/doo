<div id="lower">
	<div  id="footer">
                         <?
                        $sql = "select * from tb_type";
                        $result = mysql_query($sql);
                        $num = mysql_num_rows($result);
                        $count_r =0;
                        while ($r = mysql_fetch_array($result)) {
                            $id_type = $r['id_type'];
                            $name_type = $r['name_type'];
                            if($count_r ==0){
                                echo "<div class=\"col1\">";
			        echo "     <h3>ขาย</h3>";
                            }else if($count_r==12){
                                echo "<div class=\"col2\">";
			        echo "     <h3>เช่า</h3>";  
                            }else if($count_r==24){
                                echo "<div class=\"col3\">";
			        echo "     <h3>เช่า</h3>";  
                            }
                            echo "<a class=\"f_ink\" href='post_type.php?id_type=$id_type'>$name_type</a>";
                            
                            if($count_r ==11){
                                echo "</div>";
                            }else if($count_r==23){
                                echo "</div>"; 
                            }else if($count_r==($num-1)){
                                echo "</div>";
                            }
                            $count_r++;
                        }
                        if($count_r<12){
                            echo "<div class=\"col2\">";
			    echo "     <h3>เช่า</h3> </div>";  
                            echo "<div class=\"col3\">";
			    echo "     <h3>เช่า</h3> </div>";  
                        }else if($count_r < 24){
                            echo "<div class=\"col3\">";
			    echo "     <h3>เช่า</h3> </div>";  
                        }
                        ?>
		<div class="col4">
		  สนใจติดต่อสอบถาม-ลงโฆษณา<br />
		<img src="images/4xtreme.png" align="left" style="margin:5px;" /><br />
		<span style="font-size:12px;">บริษัทโฟร์เอ็กซ์ตรีม จำกัด 351/16 หมู่ที่5 ต.ดอนแก้ว อ.แม่ริม จ.เชียงใหม่ 50180</span>
		<p><b>Tel: +66-53-122-764 <br />Mobile: +66-89-432-4600	</b></p>	
	  </div>
  </div>
</div>
