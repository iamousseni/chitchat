<?php
include 'Admin/include/config.php';
$idChat = addslashes($_POST['idChat']);
$message = addslashes($_POST['m']);
$username = addslashes($_COOKIE['u']);
if($message != ''){
    $messageQuery = $mysqli->query("INSERT INTO messaggio (codUtente, codChat, testo) VALUES ('$username', '$idChat', '$message');");

        if($mysqli->affected_rows == 1){
            $result['message'] = 'sended';
        }else{
            $result['message'] = 'not sended';
        }

    header('Content-Type: application/json');
    echo json_encode($result);
}
?>