<?php
    include  '../../Admin/include/config.php';
    $username = $_GET['u'];
    $stato = $_GET['status'];
    $status = $mysqli->query("UPDATE utente SET online = '$stato' WHERE username = '$username';");

    header('Content-Type: application/json');
    echo json_encode($stato);
?>
