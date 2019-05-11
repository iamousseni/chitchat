var htmlspecialchars = function (string) {
    return string.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
};

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
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

function createChat(chat) {
    let date = new Date(chat['dataOraInvio']);
    let now = new Date();
    let interval = now.getDate() - date.getDate();
    const month = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
    let dataOraInvio = interval > 0 ? date.getDate() + ` ` + month[date.getMonth()] : ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);

    let lastUserSender = chat['lastUserSender'] == getCookie('u') ? 'Tu: ' : chat['nome'] + ': ';

    //qui verifico se vi è stato un nuovo messaggio dala chat che ha id chat['id']
    if (chat['dataOraInvio'] != localStorage.getItem('chat' + chat['id'])) {
        localStorage.setItem('updates', chat['id']);
        localStorage.setItem('chat' + chat['id'], chat['dataOraInvio']);
        //suono per nuovo messaggio
        playSound('audio/notification/message.ogg');

        if (!localStorage.getItem('unreadChat' + chat['id'])) {
            //inizializzo a zero la "variabile" che conta il numero di messaggi non ancora letti della specifica chat
            localStorage.setItem('unreadChat' + chat['id'], 0);

            if (!localStorage.getItem('chatUnread')) {
                localStorage.setItem('chatUnread', chat['id']);
            } else {
                localStorage.setItem('chatUnread', localStorage.getItem('chatUnread') + '-' + chat['id']);
            }
        }
        //incremento il la variabile 
        localStorage.setItem('unreadChat' + chat['id'], parseInt(localStorage.getItem('unreadChat' + chat['id'])) + 1);
    }


    document.getElementById('chat' + chat['id']).addEventListener('click', function () {
        localStorage.removeItem('unreadChat' + chat['id']);
        //ripristino la situazione iniziale della notifica
        this.children[1].children[1].children[1].innerHTML = '';
        this.children[1].children[1].children[1].style.display = 'none';

        //rimuovo dal localStorage l'id della chat che è stata appena cliccata
        var unreaded = localStorage.getItem('chatUnread').split('-');
        unreaded = unreaded.filter(function (ele) {
            return ele != chat['id'];
        });
        localStorage.setItem('chatUnread', unreaded.join('-'));
    });


    //if the string consists of more than 40 characters then I show only part of the text
    message = chat['testo'] == null ? "📷 Foto" : chat['testo'];
    message = lastUserSender + htmlspecialchars(message);
    message = message.length > 40 ? message.substring(0, 40) + '...' : message;

    //variabile che serve per far vedere il numero di messaggi non ancora letti
    var unreadStatus = localStorage.getItem('unreadChat' + chat['id']) ? 'style="display: inline-block"' : '';
    var statusUser = chat['online']=='1' ? 'class="online"' : 'class="offline"';
    let result = `
        <hr>
        <div class="slide-chat" id="chat` + chat['id'] + `">
            <div>
                <div `+statusUser+`>
                    <img src="` + chat['pathImageProfile'] + `" alt="` + chat['codUtente'] + `">
                </div>
            </div>
            <div>
                <div>
                    <strong><span>` + chat['nome'] + `</span></strong>
                    <span>` + dataOraInvio + `</span>
                </div>
                <div>
                    <span>` + message + `</span>
                    <span class="notify" ` + unreadStatus + `>` + localStorage.getItem('unreadChat' + chat['id']) + `</span>
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
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != undefined) {
                chats = JSON.parse(this.responseText);

                for (x = 0; x < chats.length; x++) {
                    body += createChat(chats[x]);
                }
            }


            //detect if there is a new chat
            if (chats[chats.length - 1]['id'] != localStorage.getItem('lastChat')) {
                document.getElementById('chats').innerHTML = body;
                localStorage.setItem('lastChat', chats[chats.length - 1]['id']);
            } else if (localStorage.getItem('updates')) {
                //detect if there is new message
                document.getElementById('chats').innerHTML = body;
                localStorage.removeItem('updates');

            }

        }
    };
    xhttp.open("GET", "API/slideChatAPI.php?u=" + getCookie('u') + '&limit=10', true);
    xhttp.send();
}, 1000);

//perchè così quando refresha la pagina al ritorno rivede le chat in cui non ha ancora letto dei messaggi
if (localStorage.getItem('chatUnread')) {
    var unreaded = localStorage.getItem('chatUnread').split('-');
    for (x = 0; x < unreaded.length; x++) {
        document.getElementById('chat' + unreaded[x]).children[1].children[1].children[1].style.display = 'inline-block';
        document.getElementById('chat' + unreaded[x]).children[1].children[1].children[1].innerHTML = localStorage.getItem('unreadChat' + unreaded[x]);
    }
}

function playSound(pathAudio) {
    var audio = new Audio(pathAudio);
    audio.play();
}

//detect when user close tab or browser and then set his status as offline
window.addEventListener('beforeunload', function(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != undefined) {
                let stato = JSON.parse(this.responseText);
                if(stato == '1'){
                    console.log('offline');
                }
            }
        }
    }
    xhttp.open("GET", "API/userStatusAPI.php?u=" + getCookie('u'), true);
    xhttp.send();
});