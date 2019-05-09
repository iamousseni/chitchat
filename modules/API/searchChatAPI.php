<?php
    include  '../../Admin/include/config.php';
    $username = $_GET['u'];
    $search = $_GET['search'];
   
    $searchQuery = $mysqli->query("SELECT * FROM (SELECT (@cnt:= @cnt +1) AS id, us2.nome, us2.cognome, us2.pathImageProfile, user2.codUtente, user2.codChat, h.testo, h.pathFile FROM appartenere AS user1 CROSS JOIN(SELECT @cnt:=0) AS idCounter INNER JOIN appartenere AS user2 ON user1.codChat = user2.codChat INNER JOIN utente AS us2 ON us2.username = user2.codUtente  INNER JOIN (SELECT * FROM messaggio ) AS h ON user1.codChat = h.codChat WHERE user1.codUtente = '$username' AND user2.codUtente != '$username' ORDER BY dataOraInvio DESC) AS messaggi WHERE messaggi.nome LIKE '$search%' OR messaggi.cognome LIKE '$search%' OR messaggi.codUtente LIKE '$search%' OR messaggi.testo LIKE '$search%' LIMIT 1;");

    for($resultSearch = []; $row = $searchQuery->fetch_assoc();){
        $resultSearch[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($resultSearch);
?>
