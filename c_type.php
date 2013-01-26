<?php
 require_once "config.php";
                        $sql = "select * from tb_class";
                        $result = mysql_query($sql);
                        $num = mysql_num_rows($result);
							while ($r = mysql_fetch_array($result)) {
                                $id_pro = $r['id_class'];
                                $name_pro = $r['name_class'];
                                echo "<option value='$id_pro'>$name_pro</option>";
                        }
?>