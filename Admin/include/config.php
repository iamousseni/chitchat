<?php
    define('HOST','localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'chitchat');
    
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    if($mysqli->connect_error){
        die('Connect error ( ' . $mysqli->connect_errno . ' ) ' . $mysqli->connect_error);
<<<<<<< HEAD
    } else {
=======
    }else{
>>>>>>> 8909bcc530acd2b20c526776ceb234febbc61da7
        $mysqli->set_charset('utf8');
    }
    
