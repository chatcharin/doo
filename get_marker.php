<?php

include 'config.php';
$id_gen = $_POST['id'];
$sql = "select * from tb_location where id_gen='$id_gen'";
$result = mysql_query($sql);
while ($rc = mysql_fetch_array($result)) {
    $lat = $rc['lat'];
    $lng = $rc['lng'];
}
echo $lat . "," . $lng;
?>
