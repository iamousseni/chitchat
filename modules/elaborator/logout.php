<?php
    include  'Admin/include/config.php';
    $mysqli->query("UPDATE utente SET online = 0 WHERE username = '".$_COOKIE['u']."';");
    setcookie('u', null, 0, $_SERVER['BASE']);
    if(isset($_COOKIE['u']))
       $_SESSION['message'] = 'Errore! Non è stato possibile eseguire il logout al sistema!';
       
    header('location: ../');
?>