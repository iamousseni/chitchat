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

<div id="demo"></div>
<script>

function createChat(chat){
    
    let date = new Date(chat['dataOraInvio']);
    const month = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
    let message = chat['testo'] == null ? "<img src='"+chat['pathFile']+"'>" : chat['testo']; 
    let result = `
        <div>
            <div>
                <img src="" alt="`+chat['codUtente']+`">
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
    var chatsData;
    let body = '';
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText!= undefined){
                    let chats = JSON.parse(this.responseText);
                    
                    for(x=0; x < chats.length; x++){
                        body += createChat(chats[x]);
                    }
                }
                document.getElementById('demo').innerHTML = body;
            }
        };
        xhttp.open("GET", "API/slideChatAPI.php?u="+document.cookie.u+'&limit=10', true);
        xhttp.send();
}, 10000);
</script>