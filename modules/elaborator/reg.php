<?php
    include 'Admin/include/config.php';
    $name = htmlspecialchars(ucfirst(addslashes($_POST['name'])));
    $surname = htmlspecialchars(ucfirst(addslashes($_POST['surname'])));
    $username = htmlspecialchars(addslashes($_POST['username']));
    $email = htmlspecialchars(addslashes($_POST['email']));
    $password = htmlspecialchars(addslashes($_POST['password']));
    $dateBirth = addslashes($_POST['year']).'-'.addslashes($_POST['month']).'-'.addslashes($_POST['day']);
    $gender = htmlspecialchars(addslashes($_POST['gender']));

    //check if user already exist
    $result = $mysqli->query("SELECT usename FROM utente WHERE username = '$username';");
    //allready exist
    if($result !== false){
        $_SESSION['error'] = 'User with that username already exist';
        header('location: :/');
    }

    $result = $mysqli->query("INSERT INTO utente (username, nome, cognome, email, password, dataNascita, genere) VALUES ('$username', '$name', '$surname', '$email', '$password', '$dateBirth', '$gender');");

    if($result){
        $dateHourCreated = $mysqli->query("SELECT dataOraCreazione FROM utente WHERE username = '$username';");
        if($dateHourCreated->num_rows > 0){
            $dateHourCreated = $dateHourCreated->fetch_assoc()['dataOraCreazione'];

            // Intestazioni per l'utente che ha compilato il form
            $intestazione = 'From: registration@chitchat.com' . "\r\n" .
            'Content-type: text/html; charset=UTF-8' . "\r\n" .
            'Reply-To: registration@chitchat.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-Transfer-Encoding: 8bit' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();


            // Messaggio di risposta
            $oggetto = "Confirm Your ChitChat Registration!";

            $messageToSend = file_get_contents('modules/confirm.html');
            
            $messageToSend = str_replace("@NAME", $name, $messageToSend);
            $messageToSend = str_replace("@USERNAME", $username, $messageToSend);
            $messageToSend = str_replace("@DATECREATED", strtotime($dateHourCreated), $messageToSend);
            $invia = mail($email,$oggetto,$messageToSend,$intestazione,'-registration@chitchat.com');
            if($invia){
               header('location: ../verifyEmail&e='.urlencode($email));
            }else{
               $_SESSION['error'] = 'Errore! Email non è stato inviato correttamente, riprovare più tardi';
               header('location: ../');
            }
        }
    }else{
        $_SESSION['error'] = 'Errore! Registrazione utente, riprovare più tardi';
        header('location: ../');
    }


