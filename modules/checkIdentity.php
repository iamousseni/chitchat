<?php
include 'Admin/include/config.php';
if(isset($_GET['u']) && isset($_GET['ds'])){
    $username = addslashes($_GET['u']);
    $dataRichiesta = addslashes($_GET['ds']);
/*
  -->  eventualità che gli eventi non siano possibili decommentare questa parte <--

    $dataRichiesta = new DateTime(date("Y-m-d H:i:s", $dataRichiesta));
    $now = new DateTime(date('Y-m-d H:i:s'));
    $diff = $dataRichiesta->diff($now)->format('%a');

    if($diff > 0){
    */
        $result = $mysqli->query("UPDATE utente SET active = 1 WHERE username = '$username' AND dataOraCreazione = '$dataRichiesta';");
        if(!$result){
            $_SESSION['message'] = 'Errore! Questa richiesta di attivazione è scaduta';
            header('location: ./');
        }else{
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