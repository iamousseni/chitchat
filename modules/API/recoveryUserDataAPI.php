<?php
    //sposto i dati della sessione in cookie
    if(isset($_SESSION['nome']) && isset($_SESSION['cognome']) && isset($_SESSION['imageProfile'])){
        setcookie('recData', $_SESSION['nome'].'&'.$_SESSION['cognome'].'&'.$_SESSION['imageProfile'], time() + 3600 * 24 * 31, $_SERVER['BASE']);
    }else{
        //return value
        $recData = explode('&', $_COOKIE['recData']);
        $_SESSION['nome'] = $recData[0];
        $_SESSION['cognome'] = $recData[1];
        $_SESSION['imageProfile'] = $recData[2];

        //delete cookie
        setcookie('recData', null, 0, $_SERVER['BASE']);
    }

?>