<?php
    include  '../../Admin/include/config.php';
    $idChat = $_GET['idChat'];
    $messageOBJ = $mysqli->query("SELECT m.codUtente, m.codChat, m.dataOraInvio, m.pathFile, m.testo, u.nome, u.cognome, u.pathImageProfile, u.online FROM messaggio AS m INNER JOIN utente AS u ON m.codUtente = u.username WHERE m.codChat = '$idChat' ORDER BY m.dataOraInvio;");

    for($messages = []; $row = $messageOBJ->fetch_assoc();){
        $messages[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($messages);
?>
