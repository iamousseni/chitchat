<?php
@$_GET['params'] = str_replace(".php", "", $_GET['params']);
$params = explode("/", $_GET['params']);
//If the cookie has not been set then it means that the user has not yet logged into the system and therefore the SIGN page will be loaded otherwise the HOME will be loaded
$uri = implode('/', $params);
if($uri == ''){
    if(!isset($_COOKIE['u'])){
        $uri = 'sign'; 
    }else{
        $uri = 'home'; 
    }
}else if(!isset($_COOKIE['u']) && explode('/', $uri)[0]!= 'elaborator'){
        $uri = 'sign'; 
}


if(!file_exists("modules/".$uri.".php")){
    header("HTTP/1.0 404 Not Found");
    $uri = '404';
}

?>



