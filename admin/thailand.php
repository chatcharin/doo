<?php

include '../config.php';
$province_id = $_POST['province'];
$name = $_POST['name'];
if ($name == 'p') {
      $query = "select * from amphur where PROVINCE_ID='$province_id'";
      $result = mysql_query($query);
      while ($rc = mysql_fetch_array($result)) {
            $amphur_name = $rc['AMPHUR_NAME'];
            echo $amphur_name;
      }
}
if ($name == 'p_id') {
      $query = "select * from amphur where PROVINCE_ID='$province_id'";
      $result = mysql_query($query);
      while ($rc = mysql_fetch_array($result)) {
            $amphur_id = $rc['AMPHUR_ID'];
            echo $amphur_id . " ";
      }
}
mysql_close();
?>
