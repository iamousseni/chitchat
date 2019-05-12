<?php include 'Admin/include/config.php'; ?>
<div class="chat-header">
    <span>Assane Bara</span>
</div>
<div id="display-messages">
<?php
    $API_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $jsonMessage = file_get_contents($API_link.'/API/messagesAPI.php?idChat=1');
    $objsMessage = json_decode($jsonMessage);
    $outMessage = '';
    foreach($objsMessage as $obj){
        $message = $obj->testo == null ? '<img src="'.$obj->pathFile.'">' : '<span>'.$obj->testo.'</span>';
        //messaggio proveniente dall'utente loggato?
        if($obj->codUtente != $_COOKIE['u']){
            $outMessage.='
            <div class="left chitchat-messages" >
                <div>
                    <img src="'.$obj->pathImageProfile.'" alt="'.$obj->codUtente.'">
                </div>';
        }else{
            $outMessage.='<div class="right chitchat-messages" >';
        }

        $outMessage .= '
                <div>
                    '.$message.'
                </div>
            </div>
        ';
    }
    echo $outMessage;

?>
</div>

<div class="container-message">
    <div>
        <button id="emoji"><span>😌</span></button>
    </div>
    <div id="input">
        <span contenteditable>Type a message...</span>
    </div>
    <div>
        <button class="attach"><i class="fas fa-paperclip"></i></button>
        <button type="submit"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>
<script src="js/chatAjax.js"></script>