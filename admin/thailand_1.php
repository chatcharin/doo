<?php

include '../config.php';
$amphur_id = $_POST['amphur'];
$name1 = $_POST['name1'];
if ($name1 == 'a') {
      $query = "select * from district where AMPHUR_ID='$amphur_id'";
      $result = mysql_query($query);
      while ($rc = mysql_fetch_array($result)) {
            $tambon_name = $rc['DISTRICT_NAME'];
            echo $tambon_name;
      }
}
if ($name1== 'a_id') {
      $query = "select * from district where AMPHUR_ID='$amphur_id'";
      $result = mysql_query($query);
      while ($rc = mysql_fetch_array($result)) {
            $tambon_id = $rc['DISTRICT_ID'];
            echo $tambon_id . " ";
      }
}
mysql_close();
?>
