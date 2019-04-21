<?php
@$_GET['params'] = str_replace(".php", "", $_GET['params']);
$params = explode("/", $_GET['params']);
$params = array_reverse($params);

//If the cookie has not been set then it means that the user has not yet logged into the system and therefore the SIGN page will be loaded otherwise the HOME will be loaded

if(!$params[0]){
    if(!isset($_COOKIE['u'])){
        $params[0] = 'sign'; 
    }else{
        $params[0] = 'home'; 
    }
}

if(!file_exists("modules/".$params[0].".php")){
    header("HTTP/1.0 404 Not Found");
    $params[0] = '404';
}

?>



