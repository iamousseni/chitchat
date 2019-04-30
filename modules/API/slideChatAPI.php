<?php
    include  '../../Admin/include/config.php';
    $username = $_COOKIE['u'];
    $slideChat = $mysqli->query("SELECT u1.codUtente AS mittente, ne2.codUtente AS destinatario, u1.testo, u2.maggiore FROM messaggio AS u1 INNER JOIN (SELECT MAX(dataOraInvio) AS maggiore FROM `messaggio` GROUP BY codChat HAVING MAX(messaggio.dataOraInvio) ORDER BY maggiore DESC) AS u2 ON u1.dataOraInvio = u2.maggiore INNER JOIN messaggio AS ne2 ON u1.codChat = ne2.codChat GROUP BY u2.maggiore HAVING u1.codUtente IN ('$username')  OR ne2.codUtente IN ('$username');");

    for($chats = []; $row = $slideChat->fetch_assoc();){
        $chats[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($chats);
    

?>
