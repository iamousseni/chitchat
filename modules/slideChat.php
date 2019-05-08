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

<div id="chats container-fluid">
<?php
    $API_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $json = file_get_contents($API_link.'/API/slideChatAPI.php?u='.$_COOKIE["u"].'&limit=10');
    $objs = json_decode($json);
    
    $month = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
    $result = '';
    
    foreach($objs as $obj){
        
        $message = $obj->testo == null ? "<img src='".$obj->pathFile."'>" : $obj->testo;
        $result .= '
        <hr>
        <div class="slide-chat row">
            <div class="col-md-3">
                <img src="'.$obj->pathImageProfile.'" alt="'.$obj->codUtente.'">
            </div>
            <div class="col-md-9">
                <div>
                    <strong><span>'.$obj->nome.' '.$obj->cognome.'</span></strong>
                </div>
                <div>
                    <span>'.$message.'</span>
                    <span class="date">'.date('d', strtotime($obj->dataOraInvio)).' '.$month[date('n', strtotime($obj->dataOraInvio))].'</span>
                </div>
            </div>
        </div>'
    ;
    }

    echo $result;
?>
</div>
<script>

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
    const month = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
    let message = chat['testo'] == null ? "<img src='"+chat['pathFile']+"'>" : chat['testo']; 

    setInterval(() => {
    let chats;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText!= undefined){
                     chats = JSON.parse(this.responseText);
                     
                     if(chats[0]['dataOraInvio'] != localStorage.getItem('chat'+chat['id'])){
                        localStorage.setItem('updates','1');
                        
                        message = chats[0]['testo'] == null ? "<img src='"+chats[0]['pathFile']+"'>" : chats[0]['testo']; 
                    }else{
                        localStorage.setItem('updates','0');
                    }
                }
            }
        };
        xhttp.open("GET", "API/chatAPI.php?u="+getCookie('u')+'&idChat='+chat['codChat']+'&limit=10', true);
        xhttp.send();
    }, 1000);

    let result = `
        <div>
            <div>
                <img src="`+chat['pathImageProfile']+`" alt="`+chat['codUtente']+`">
            </div>
            <div>
                <div>
                    <strong><span>`+chat['nome']+` `+chat['cognome']+`</span></strong>
                    <span>`+date.getDate()+` `+month[date.getMonth()]+`</span>
                </div>
                <div>
                    <span>`+message+`</span>
                </div>
            </div>
        </div>`
    ;

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