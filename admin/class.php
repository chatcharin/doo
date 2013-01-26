<?php
 require_once "../config.php";
                        $sql = "select * from tb_type";
                        $result = mysql_query($sql);
                        $num = mysql_num_rows($result);
							while ($r = mysql_fetch_array($result)) {
                                $id_pro = $r['id_type'];
                                $name_pro = $r['name_type'];
                                echo "<option value='$id_pro'>$name_pro</option>";
                        }
?>