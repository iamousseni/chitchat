<?php include 'Admin/include/config.php'; ?>
<div>
    <div>
        <h1>Chat</h1>
    </div>
    <div>
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search..." id="search">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
    </div>
</div>

<div id="chats" class="container-fluid">
<?php

    $API_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $json = file_get_contents($API_link.'/API/slideChatAPI.php?u='.$_COOKIE["u"].'&limit=10');
    $objs = json_decode($json);

    $month = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

    $result = '';
    foreach($objs as $obj){
        //if the string consists of more than 30 characters then I show only part of the text
        $message = $obj->testo == null ? "📷 Foto" : $obj->testo;
        $lastUserSender = $obj->lastUserSender == $_COOKIE['u'] ? 'Tu: ' : $obj->nome.': ';
        $message = $lastUserSender.$message;
        $message = strlen($message) > 40 ? substr(htmlspecialchars($message), 0, 40).'...' : $message;

        $interval = date('d') - date('d', strtotime($obj->dataOraInvio));
        $dataOraInvio = $interval > 0 ? date('d', strtotime($obj->dataOraInvio)).' '.$month[date('n', strtotime($obj->dataOraInvio))] : date('H:i', strtotime($obj->dataOraInvio));

        $result .= '
        <hr>
        <div class="slide-chat">
            <div>
                <div>
                    <img src="'.$obj->pathImageProfile.'" alt="'.$obj->codUtente.'">
                </div>
            </div>
            <div>
                <div>
                    <strong><span>'.$obj->nome.'</span></strong>
                    <span>'.$dataOraInvio.'</span>
                </div>
                <div>
                    <span>'.$message.'</span>
                </div>
            </div>
        </div>
    ';
    }

    echo $result;
?>
</div>
<script src="js/searchChatAjax.js?u="<?php echo filemtime('js/searchChatAjax.js'); ?>></script>
<script src="js/slideChatAjax.js?u="<?php echo filemtime('js/slideChatAjax.js'); ?>></script>
