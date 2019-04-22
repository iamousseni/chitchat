<?php
include 'Admin/include/config.php';
if(isset($_GET['u']) && isset($_GET['ds'])){
    $username = addslashes($_GET['u']);
    $dataRichiesta = addslashes($_GET['ds']);
    $dataRichiesta = date("Y-m-d H:i:s", $dataRichiesta);
/*
  -->  eventualità che gli eventi via db non siano possibili decommentare questa parte <--

    $dataRichiesta = new DateTime(date("Y-m-d H:i:s", $dataRichiesta));
    $now = new DateTime(date('Y-m-d H:i:s'));
    $diff = $dataRichiesta->diff($now)->format('%a');

    if($diff > 0){
    */

        $mysqli->query("UPDATE utente SET active = '1' WHERE username = '$username' AND dataOraCreazione = '$dataRichiesta';");
        
        if($mysqli->affected_rows == 0){
            $_SESSION['message'] = 'Errore! Questa richiesta di attivazione è scaduta';
            header('location: ./');
        }else{
            //in modo tale che da ora in poi so quale utente è attivo
            setcookie('u', $username, 0, $_SERVER['BASE']);
            header('location: completeProfile');
        }
   /* }else{
        $_SESSION['message'] = 'Errore! Questa richiesta di attivazione è scaduta';
        header('location: ./');
    } */
}else{
    $_SESSION['message'] = 'Errore! Parametri non passati';
    header('location: ./');
}