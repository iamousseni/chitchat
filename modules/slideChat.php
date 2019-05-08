<?php include 'Admin/include/config.php'; ?>
<div>
    <div>
        <h1>Chat</h1>
    </div>
    <div>
        <form action="" method="post">
            <button type="submit"><i class="fas fa-search"></i></button>
            <input type="search" name="search" id="search" placeholder="Search">
        </form>
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
        $message = $obj->testo == null ? "📷 Foto" : $obj->testo;
        //if the string consists of more than 30 characters then I show only part of the text
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
                    <strong><span>'.$obj->nome.' '.$obj->cognome.'</span></strong>
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

<script>

var htmlspecialchars = function(string) {
    return string.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
};

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return false;
}
    
function createChat(chat){
    let date = new Date(chat['dataOraInvio']);
    let now = new Date();
    let interval = now.getDate() - date.getDate();
    let dataOraInvio = interval > 0 ? date.getDate()+` `+month[date.getMonth()] : ('0'+date.getHours()).slice(-2)+':'+('0'+date.getMinutes()).slice(-2);

    const month = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre']; 
    let lastUserSender = chat['lastUserSender'] == getCookie('u') ? 'Tu: ' : chat['nome']+': ';
    if(chat['dataOraInvio'] != localStorage.getItem('chat'+chat['id'])){
        localStorage.setItem('updates','1');
        localStorage.setItem('chat'+chat['id'],chat['dataOraInvio']);
    }

    //if the string consists of more than 40 characters then I show only part of the text
    message = chat['testo'] == null ? "📷 Foto" : chat['testo'];
    message = lastUserSender+htmlspecialchars(message);
    message = message.length > 40 ? message.substring(0, 40)+'...' : message;   
    
    let result = `
        <hr>
        <div class="slide-chat">
            <div>
                <div>
                    <img src="`+chat['pathImageProfile']+`" alt="`+chat['codUtente']+`">
                </div>
            </div>
            <div>
                <div>
                    <strong><span>`+chat['nome']+` `+chat['cognome']+`</span></strong>
                    <span>`+dataOraInvio+`</span>
                </div>
                <div>
                    <span>`+message+`</span>
                </div>
            </div>
        </div>
    `;

    return result;
}


setInterval(() => {
    let body = '';
    let chats;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText!= undefined){
                     chats = JSON.parse(this.responseText);
                    
                    for(x=0; x < chats.length; x++){
                        body += createChat(chats[x]);
                    }
                }

                //detect if there is a new chat
                if(chats[chats.length - 1]['id'] != localStorage.getItem('lastChat')){
                    document.getElementById('chats').innerHTML = body;
                    localStorage.setItem('lastChat', chats[chats.length -1]['id']);
                }else if(localStorage.getItem('updates') == '1'){
                    localStorage.setItem('updates','0');
                    document.getElementById('chats').innerHTML = body;
                }
                
            }
        };
        xhttp.open("GET", "API/slideChatAPI.php?u="+getCookie('u')+'&limit=10', true);
        xhttp.send();
}, 1000);

</script> 
