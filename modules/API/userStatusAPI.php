<?php
    include  '../../Admin/include/config.php';
    $username = $_GET['u'];
    $status = $mysqli->query("UPDATE utente SET online = 0 WHERE username = '$username';"); 

    if($mysqli->affected_rows == 1){
        $stato = 1;
    }else{
        $stato = 0;
    }

    header('Content-Type: application/json');
    echo json_encode($stato);
?>
