<?php
include 'Admin/include/config.php';
$username = addslashes($_POST['username']);
$result = $mysqli->query("SELECT email, password FROM utente WHERE username = '$username';");

if($result->num_rows == 1){
    for($userCredential = []; $row = $result->fetch_assoc();){
        $userCredential = $row;
    }

    //send email
    $intestazione = 'From: reset-password@chitchat.com' . "\r\n" .
    'Content-type: text/html; charset=UTF-8' . "\r\n" .
    'Reply-To: reset-password@chitchat.com' . "\r\n" .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-Transfer-Encoding: 8bit' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


    // Messaggio di risposta
    $oggetto = "Login Credentials of The @$username Account";
    $messageToSend = "Your Credentials of access are: <br> <strong>Username: </strong> $username <br> <strong>Password: </strong> ".$userCredential['password'];
    $invia = mail($userCredential['email'],$oggetto,$messageToSend,$intestazione,'-reset-password@chitchat.com');
    if($invia){
        $_SESSION['message'] = 'E-mail inviata con successo all\' account collegato';
    }else{
       $_SESSION['message'] = 'Errore! Email non è stato inviato correttamente, riprovare più tardi';
    }
}else{
    $_SESSION['message'] = 'Errore! L\'utente indicato non esiste';
}
header('location: forgot');