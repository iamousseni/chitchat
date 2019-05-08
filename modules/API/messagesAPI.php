<?php
    include  '../../Admin/include/config.php';
    $idChat = $_GET['idChat'];
    $messageOBJ = $mysqli->query("SELECT * FROM messaggio WHERE codChat = '$idChat';");

    for($messages = []; $row = $messageOBJ->fetch_assoc();){
        $messages[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($messages);
?>
