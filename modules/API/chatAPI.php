<?php
    include  '../../Admin/include/config.php';
    $username = $_GET['u'];
    $limit = $_GET['limit'];
    $idChat = $_GET['idChat'];
    $slideChat = $mysqli->query("SELECT (@cnt:= @cnt +1) AS id, userHeader.nome, userHeader.cognome, userHeader.pathImageProfile, user2.codUtente, user1.codChat, h.codUtente AS lastUserSender, h.testo, h.pathFile, h.maggiore AS dataOraInvio FROM appartenere AS user1 CROSS JOIN(SELECT @cnt:=0) AS idCounter INNER JOIN appartenere AS user2 ON user1.codChat = user2.codChat INNER JOIN utente AS userHeader ON userHeader.username = user2.codUtente INNER JOIN (SELECT * FROM messaggio INNER JOIN 
    (SELECT MAX(dataOraInvio) AS maggiore FROM `messaggio` WHERE codChat='$idChat' GROUP BY codChat ORDER BY maggiore DESC) as header ON messaggio.dataOraInvio = header.maggiore GROUP BY messaggio.codChat) AS h ON user1.codChat = h.codChat WHERE user1.codUtente = '$username' GROUP BY user1.codChat LIMIT $limit;");

    for($chats = []; $row = $slideChat->fetch_assoc();){
        $chats[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($chats);
?>
