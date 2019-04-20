<?php
include 'Admin/include/config.php';
if(isset($_GET['u']) && isset($_GET['ds'])){
    $username = addslashes($_GET['u']);
    $dataRichiesta = addslashes($_GET['ds']);
    $dataRichiesta = date("Y-m-d H:i:s",$dataRichiesta);

    $result = $mysqli->query("UPDATE utente SET active = 1 WHERE username = '$username' AND dataOraCreazione = '$dataRichiesta';");
    if(!$result){
        $_SESSION['message'] = 'Errore! Questa richiesta di attivazione è scaduta';
        header('location: ./');
    }else{
        

        header('location: completeProfile');
    }
}