<?php
include  'Admin/include/config.php';
$username = addslashes($_POST['username']);
$password = addslashes($_POST['password']);

//check if that user exist
$usercheck = $mysqli->query("SELECT * FROM utente WHERE username = '$username' AND password = '$password' AND active = '1';");

if($usercheck->num_rows == 1){
    if(isset($_POST['remember'])){
        // Set deadline (31 days) if remember
        setcookie('u', $username, time() + 3600 * 24 * 31, $_SERVER['BASE']);
    }else{
        // Deleted when browser closes
        setcookie('u', $username, 0,  $_SERVER['BASE']);
    }

    // Check that the cookie has been set up successfully
    // 'cause two is megl che one
    if(isset($_COOKIE['u'])){
        header('location: home');
    }else{
        $_SESSION['message'] = 'Errore cookie! non è stato possibile effettaure l\'accesso al sistema, si prega di riprovare';
        header('location: ../');
    }

}else{
    $_SESSION['message'] = 'Errore! Controllare i dati inseriti e verificare di aver già attivato l\'account';
    header('location: ../');
}
