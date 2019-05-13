<?php
include 'Admin/include/config.php';
$idChat = addslashes($_GET['idChat']);
$message = urldecode(addslashes($_GET['m']));
$username = addslashes($_COOKIE['u']);
if($message != ''){
    $messageQuery = $mysqli->query("INSERT INTO messaggio (codUtente, codChat, testo) VALUES ('$username', '$idChat', '$message');");

        if($mysqli->affected_rows == 1){
            echo 'sended';
        }else{
            echo 'not sended';
        }
}

?>