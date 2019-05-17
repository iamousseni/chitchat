<?php
include 'Admin/include/config.php';
include 'Admin/classes/fileSystem.php';
$fileSystem = new FileSystem();
$uploadStatus = $fileSystem->uploadFileFromForm('image', 'images');
if ($uploadStatus[0]) {
    $idChat = addslashes($_POST['idChat']);
    $pathFileImage = $uploadStatus[1];
    $username = addslashes($_COOKIE['u']);

    $messageQuery = $mysqli->query("INSERT INTO messaggio (codUtente, codChat, pathFile) VALUES ('$username', '$idChat', '$pathFileImage');");
        if($mysqli->affected_rows == 1){
            echo 'sended';
        }else{
            echo 'not sended';
        }
}