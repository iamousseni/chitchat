<?php
    include  '../../Admin/include/config.php';
    $username = $_GET['u'];
    $search = $_GET['search'];

    if($search == ''){
      $query = "SELECT (@cnt:= @cnt +1) AS id, userHeader.nome, userHeader.cognome, userHeader.pathImageProfile, userHeader.online, user2.codUtente, user1.codChat, h.codUtente AS lastUserSender, h.testo, h.pathFile, h.maggiore AS dataOraInvio FROM appartenere AS user1 CROSS JOIN(SELECT @cnt:=0) AS idCounter INNER JOIN appartenere AS user2 ON user1.codChat = user2.codChat INNER JOIN utente AS userHeader ON userHeader.username = user2.codUtente INNER JOIN (SELECT * FROM messaggio INNER JOIN 
      (SELECT MAX(dataOraInvio) AS maggiore FROM `messaggio` GROUP BY codChat ORDER BY maggiore DESC) as header ON messaggio.dataOraInvio = header.maggiore GROUP BY messaggio.codChat) AS h ON user1.codChat = h.codChat WHERE user1.codUtente = '$username' AND user2.codUtente != '$username' GROUP BY user1.codChat ORDER BY dataOraInvio DESC LIMIT 10;";
    }else {
      $query = "SELECT *
      FROM (
        SELECT (@cnt:= @cnt +1) AS id, us2.nome, us2.cognome, us2.pathImageProfile, user2.codUtente, user2.codChat, us2.online,
          h.nome AS senderNome, h.cognome AS senderCognome, h.codUtente AS lastUserSender, h.testo, h.pathFile, h.dataOraInvio
        FROM appartenere AS user1
          CROSS JOIN (SELECT @cnt:=0) AS idCounter
          INNER JOIN appartenere AS user2 ON user1.codChat = user2.codChat
          INNER JOIN utente AS us2 ON us2.username = user2.codUtente
          INNER JOIN (
            SELECT *
            FROM messaggio INNER JOIN utente ON messaggio.codUtente = utente.username
          ) AS h ON user1.codChat = h.codChat
        WHERE user1.codUtente = '$username' AND user2.codUtente != '$username'
        ORDER BY dataOraInvio DESC
      ) AS messaggi
      WHERE LOWER(messaggi.nome) LIKE LOWER('%$search%') OR
            LOWER(messaggi.cognome) LIKE LOWER('%$search%') OR
            LOWER(messaggi.codUtente) LIKE LOWER('%$search%') OR
            LOWER(messaggi.testo) LIKE LOWER('%$search%') LIMIT 3;";
    }
      
    


    $searchQuery = $mysqli->query($query);

    for($resultSearch = []; $row = $searchQuery->fetch_assoc();){
        $resultSearch[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($resultSearch);
?>
