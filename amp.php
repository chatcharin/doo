
<?php
echo "<option value=''>ทุกอำเภอ</option>";
 require_once "config.php";
$prov_id = isset($_REQUEST['pro_id']) ? $_REQUEST['pro_id'] : 0;
                        $sql = "select * from amphur where PROVINCE_ID=".$prov_id." and AMPHUR_ID not  in (592,593,594) ORDER BY  AMPHUR_NAME ASC ;";
                        $result = mysql_query($sql);
                        $num = mysql_num_rows($result);
							while ($r = mysql_fetch_array($result)) {
                                $id_pro = $r['AMPHUR_ID'];
                                $name_pro = $r['AMPHUR_NAME'];
                                echo "<option value='$id_pro'>$name_pro</option>";
                        }
?>