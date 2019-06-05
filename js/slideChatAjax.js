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
    isArrivedNewMessage(chat);
    return writeHTMLChat(chat);
}

function countMessageNotReaded(chat) {
    if (!sessionStorage.getItem('unreadChat' + chat['codChat'])) {
        //inizializzo a zero la "variabile" che conta il numero di messaggi non ancora letti della specifica chat
        sessionStorage.setItem('unreadChat' + chat['codChat'], 0);
    }
    //incremento il la variabile
    sessionStorage.setItem('unreadChat' + chat['codChat'], parseInt(sessionStorage.getItem('unreadChat' + chat['codChat'])) + 1);

    if (!sessionStorage.getItem('chatUnread')) {
        sessionStorage.setItem('chatUnread', chat['codChat']);
    } else {
        sessionStorage.setItem('chatUnread', sessionStorage.getItem('chatUnread') + '-' + chat['codChat']);
    }
}

function isArrivedNewMessage(chat) {
    //qui verifico se vi è stato un nuovo messaggio dalla chat che ha codChat chat['codChat']
    if (chat['dataOraInvio'] != sessionStorage.getItem('chat' + chat['codChat'])) {
        sessionStorage.setItem('chat' + chat['codChat'], chat['dataOraInvio']);

        //il nuovo messaggio proviene dall'utente con cui sta chattando
        if (chat['lastUserSender'] != getCookie('u')) {
            //suono per nuovo messaggio
            playSound('audio/notification/message.ogg');
            if (sessionStorage.getItem('chatOpen') != chat['codChat']) {
                countMessageNotReaded(chat);
            }

        }
    }
}

function writeHTMLChat(chat) {
    let date = new Date(chat['dataOraInvio']);
    let now = new Date();
    let interval = now.getDate() - date.getDate();
    const month = {
        1: 'Gennaio',
        2: 'Febbraio',
        3: 'Marzo',
        4: 'Aprile',
        5: 'Maggio',
        6: 'Giugno',
        7: 'Luglio',
        8: 'Agosto',
        9: 'Settembre',
        10: 'Ottobre',
        11: 'Novembre',
        12: 'Dicembre'
    };

    let dataOraInvio = interval > 0 ? date.getDate() + ` ` + month[date.getMonth()] : ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);

    let lastUserSender = chat['lastUserSender'] == getCookie('u') ? 'Tu: ' : chat['nome'] + ': ';

    //if the string consists of more than 40 characters then I show only part of the text
    message = chat['testo'] == null ? "📷 Foto" : htmlspecialchars(chat['testo']);
    message = lastUserSender + message;
    message = message.length > 40 ? message.substring(0, 40) + '...' : message;

    //variabile che serve per far vedere il numero di messaggi non ancora letti
    var unreadStatus = sessionStorage.getItem('unreadChat' + chat['codChat']) ? 'style="display: inline-block"' : '';
    var statusUser = chat['online'] == '1' ? 'class="online"' : 'class="offline"';


    let result = `
        <hr>
        <div class="slide-chat" id="chat` + chat['codChat'] + `">
            <div>
                <div ` + statusUser + `>
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
                    <span class="notify" ` + unreadStatus + `>` + sessionStorage.getItem('unreadChat' + chat['codChat']) + `</span>
                </div>
            </div>
        </div>
    `;
    return result;
}

function updateEventChats(responseText) {

    
    //lo metto qui l'evento perchè così almeno ogni volta che cambia il dom lui sa sempre dove (chi sono) sono gli elementi che voglio selezionare
    let chats = document.getElementsByClassName('slide-chat');
    let chat = JSON.parse(responseText);

    for (let x = 0; x < chat.length; x++) {
        document.getElementById(chats[x].id).addEventListener('click', function () {
            //memorizzo il nome della persona della chat aperta
            sessionStorage.setItem('fullnameChatOpen', chat[x]['nome'] + ' ' + chat[x]['cognome']);
            //elimino il setIntervel della chat presistente altrimenti si rischia l'accumulo e poi il sovraccarico
            clearAllChatSetInterval();

            sessionStorage.removeItem('unreadChat' + chat[x]['codChat']);
            //ripristino la situazione iniziale della notifica
            this.children[1].children[1].children[1].innerHTML = '';
            this.children[1].children[1].children[1].style.display = 'none';

            if (sessionStorage.getItem('chatUnread')) {
                //rimuovo dal sessionStorage l'id della chat che è stata appena cliccata
                var unreaded = sessionStorage.getItem('chatUnread').split('-');
                unreaded = unreaded.filter(function (ele) {
                    return ele != chat[x]['codChat'];
                });
                sessionStorage.setItem('chatUnread', unreaded.join('-'));
            }

            //apri la chat specifica
            openChat(chat[x]['codChat']);
            chats = document.getElementsByClassName('slide-chat');
            for (let chat of chats) {
                chat.classList.remove('active');
            }
            this.classList.add('active');
            checkChat(chat[x]['codChat']);
        });
    }
}


function playSound(pathAudio) {
    var audio = new Audio(pathAudio);
    audio.play();
}

//detect when user close tab or browser and then set his status as offline
window.addEventListener('beforeunload', function () {
    let stato = 0;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != undefined) {
                let stato = JSON.parse(this.responseText);
                if (stato == '0') {
                    console.log('offline');
                }
            }
        }
    }
    xhttp.open("GET", "API/userStatusAPI.php?u=" + getCookie('u') + "&status=" + stato, true);
    xhttp.send();
});

//detect when user acced on the page
window.addEventListener('load', function () {
    let stato = 1;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != undefined) {
                let stato = JSON.parse(this.responseText);
                if (stato == '1') {
                    console.log('online');
                }
            }
        }
    }
    xhttp.open("GET", "API/userStatusAPI.php?u=" + getCookie('u') + "&status=" + stato, true);
    xhttp.send();
    updateEventChats(sessionStorage.getItem('chats'));
});


setInterval(() => {
    let body = '';
    let chats;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != undefined) {
                chats = JSON.parse(this.responseText);
                if (!Object.is(sessionStorage.getItem('chats'), JSON.stringify(chats))) {
                    sessionStorage.setItem('chats', JSON.stringify(chats));
                    for (x = 0; x < chats.length; x++) {
                        body += createChat(chats[x]);
                    }
                    document.getElementById('chats').innerHTML = body;
                    updateEventChats(this.responseText);
                }
            }
        }
    };
    xhttp.open("GET", "API/slideChatAPI.php?u=" + getCookie('u') + '&limit=10', true);
    xhttp.send();
}, 500);

//perchè così quando refresha la pagina al ritorno rivede le chat in cui non ha ancora letto dei messaggi(numero di messaggi non letti)
if (sessionStorage.getItem('chatUnread') && sessionStorage.getItem('chatUnread') != '') {
    var unreaded = sessionStorage.getItem('chatUnread').split('-');
    for (let x = 0; x < unreaded.length; x++) {
        document.getElementById('chat' + unreaded[x]).children[1].children[1].children[1].style.display = 'inline-block';
        document.getElementById('chat' + unreaded[x]).children[1].children[1].children[1].innerHTML = sessionStorage.getItem('unreadChat' + unreaded[x]);
    }
}