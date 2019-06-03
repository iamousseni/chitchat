<?php
    include  '../../Admin/include/config.php';
    $username = $_GET['u'];
    $limit = $_GET['limit'];
    $slideChat = $mysqli->query("SELECT * FROM utente WHERE username != '$username' LIMIT $limit"); 


    for($chats = []; $row = $slideChat->fetch_assoc();){
        $chats[] = $row;
    }


    header('Content-Type: application/json');
    echo json_encode($chats);
?>
