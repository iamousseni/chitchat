<?php
    define('HOST','localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'chitchat');
    
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    if($mysqli->connect_error){
        die('Connect error ( ' . $mysqli->connect_errno . ' ) ' . $mysqli->connect_error);
<<<<<<< HEAD
    }else{
=======
    } else {
>>>>>>> a6ae92c1356df1eccb97958453b198af7548a27a
        $mysqli->set_charset('utf8');
    }
    