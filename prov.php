<?php
 require_once "config.php";
                        $sql = "select * from province ORDER BY  PROVINCE_NAME ASC ";
                        $result = mysql_query($sql);
                        $num = mysql_num_rows($result);
							while ($r = mysql_fetch_array($result)) {
                                $id_pro = $r['PROVINCE_ID'];
                                $name_pro = $r['PROVINCE_NAME'];
                                echo "<option value='$id_pro'>$name_pro</option>";
                        }
?>