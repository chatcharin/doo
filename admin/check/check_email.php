<?php

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "0";
    }
    else {
        echo '1';
    }
}
?>
