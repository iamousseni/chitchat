<?php include 'Admin/include/config.php'; ?>
<div>
    <div>
        <h1>Users</h1>
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
<div id="chats">
<?php

    $API_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $json = file_get_contents($API_link.'/API/slideUsersAPI.php?u='.$_COOKIE["u"].'&limit=10');
    $objs = json_decode($json);

    $month = [1 => 'Gennaio', 2 => 'Febbraio', 3 => 'Marzo', 4 => 'Aprile', 5 => 'Maggio', 6 => 'Giugno', 7 => 'Luglio', 8 => 'Agosto', 9 => 'Settembre', 10 => 'Ottobre', 11 => 'Novembre', 12 => 'Dicembre'];

    $result = '';
    foreach($objs as $obj){
        $statusUser = $obj->online== '1' ? 'class="online"' : 'class="offline"';
        $result .= '
        <hr>
        <div class="slide-chat" id="chat'.$obj->codChat.'">
            <div>
                <div '.$statusUser.'>
                    <img src="'.$obj->pathImageProfile.'" alt="'.$obj->username.'" class="'.strtolower($obj->genere).'">
                </div>
            </div>
            <div>
                <div>
                    <strong><span>'.$obj->nome.' '.$obj->cognome.'</span></strong>
                </div>
                <div>
                    <code>@'.$obj->username.'</code>
                    <span class="notify"></span>
                </div>
            </div>
        </div>
    ';
    }
    echo $result;
?>
</div>
<script src="js/slideChatAjax.js?u=<?php echo filemtime('js/slideChatAjax.js'); ?>"></script>
<script src="js/searchChatAjax.js?u=<?php echo filemtime('js/searchChatAjax.js'); ?>"></script>
