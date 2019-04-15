<?php
@$_GET['params'] = str_replace(".html", "", $_GET['params']);
$params = explode("/", $_GET['params']);
$params = array_reverse($params);

//if no parameter was setted then by the default the page that will load is sign
if(!$params[0]){
    $params[0] = 'sign'; 
}

//if the page don't exist
if(!file_exists("modules/".$params[0].".php")){
    header("HTTP/1.0 404 Not Found");
    $params[0] = '404';
}

?>



