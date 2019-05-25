function createChatSearch(chat) {
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

    let lastUserSender = chat['lastUserSender'] == getCookie('u') ? 'Tu: ' : chat['senderNome'] + ': ';

    //if the string consists of more than 40 characters then I show only part of the text
    message = chat['testo'] == null ? "📷 Foto" : chat['testo'];
    message = lastUserSender + htmlspecialchars(message);
    message = message.length > 40 ? message.substring(0, 40) + '...' : message;
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
                </div>
            </div>
        </div>
    `;

    return result;
}

document.getElementById('search').addEventListener('keyup', function () {
    if (this.value == '')
        localStorage.setItem('updates', '1');

    let body = '';
    let chats;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != undefined) {
                if (this.responseText == '') {
                    localStorage.setItem('updates', 1);
                } else {
                    chats = JSON.parse(this.responseText);
                    for (x = 0; x < chats.length; x++) {
                        body += createChatSearch(chats[x]);
                    }
                    document.getElementById('chats').innerHTML = body;
                }

            }

        }
    };
    xhttp.open("GET", "API/searchChatAPI.php?u=" + getCookie('u') + '&search=' + this.value, true);
    xhttp.send();
});