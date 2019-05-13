<?php
    include  '../../Admin/include/config.php';
    $username = $_GET['u'];
    //$limit = $_GET['limit'];
    //$idChat = $_GET['idChat'];
    $slideChat = $mysqli->query("SELECT username as U FROM utente where username='".$username."';");
    for($chats = []; $row = $slideChat->fetch_assoc();){
        $chats[] = $row;
    }
 //buio un del bambino ha comprendere quando ma paura possiamo 

    header('Content-Type: application/json');
    echo json_encode($chats);
    
?>
