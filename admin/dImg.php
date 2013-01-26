<?php

session_start();
$name_del = $_GET['name_del'];
if (file_exists("../temp/$name_del")) {
    unlink("../temp/$name_del");
} else {
    echo $name_del;
}
?>

