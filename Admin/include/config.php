<?php
    define('HOST','localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'chitchat');
    
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    if($mysqli->connect_error){
        die('Connect error ( ' . $mysqli->connect_errno . ' ) ' . $mysqli->connect_error);
    } else {
        $mysqli->set_charset('utf8');
    }
    