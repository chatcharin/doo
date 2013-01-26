<?php

include '../../config.php';
$jood = $_POST['jood'];
$my = $_POST['my'];
if ($my == "p") {
      $sql = "select * from province where PROVINCE_ID=$jood";
      $result = mysql_query($sql);
      $num = mysql_num_rows($result);
      while ($rc = mysql_fetch_array($result)) {
            $p_jood = $rc['PROVINCE_NAME'];
      }
      echo $p_jood;
}
if ($my == "a") {
      $sql = "select * from amphur where AMPHUR_ID=$jood";
      $result = mysql_query($sql);
      $num = mysql_num_rows($result);
      while ($rc = mysql_fetch_array($result)) {
            $a_jood = $rc['AMPHUR_NAME'];
      }
      echo $a_jood;
}
if ($my == "t") {
      $sql = "select * from district where DISTRICT_ID=$jood";
      $result = mysql_query($sql);
      $num = mysql_num_rows($result);
      while ($rc = mysql_fetch_array($result)) {
            $t_jood = $rc['DISTRICT_NAME'];
      }
      echo $t_jood;
}
mysql_close();
?>
