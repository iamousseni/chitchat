<?php
include 'Admin/include/config.php';
include 'Admin/classes/fileSystem.php';
if (isset($_POST['edit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $fileSystem = new FileSystem();
    $fileSystem->createDirectory($_COOKIE['u'], 'profiles/' . $_COOKIE['u']);
    $uploadStatus = $fileSystem->uploadFileFromForm('imgProfile', 'profiles/' . $_COOKIE['u']);
    if ($uploadStatus[0]) {
        $_SESSION['userProfileImage'] =  $uploadStatus[1];
        $_SESSION['message'] = 'Immagine caricata con successo!';
    } else {
        $_SESSION['message'] = $uploadStatus[1];
    }
    header('location: ../completeProfile');
}
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $userImageProfile = $_SESSION['userProfileImage'];
    $bio = addslashes($_POST['bio']);
    $username = $_COOKIE['u'];
    $resultStatus = $mysqli->query("UPDATE utente SET pathImageProfile = '$userImageProfile', bio = '$bio' WHERE username = '$username';");
    if ($mysqli->affected_rows == 0) {
        $_SESSION['message'] = 'Errore, non è stato possibile aggiornare l\'immagine di profilo o la bio dell\'utente specificato';
    } else {
        header('location: ../home');
    }
}
?>