<?php
    require 'config.php';
    // ========== Register ==========
    // if (isset($_POST['first_name'])) {

    // }
     if(!empty($_POST['id'])){
    
    $check_email = $db->query('SELECT * FROM users WHERE email = "'.$_POST['id'].'"');

    if ($check_email->num_rows > 0) {
        echo 'Email Already Exists';
    }else{
        echo '0';

    }
}
// echo $_POST['id'];
?>