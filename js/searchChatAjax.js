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
    let dataOraInvio = interval > 0 ? date.getDate() + ` ` + month[date.getMonth()] : ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);

    const month = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

    //if the string consists of more than 40 characters then I show only part of the text
    message = chat['testo'] == null ? "📷 Foto" : chat['testo'];
    message = htmlspecialchars(message);
    message = message.length > 40 ? message.substring(0, 40) + '...' : message;
    let result = `
        <hr>
        <div class="slide-chat">
            <div>
                <div>
                    <img src="` + chat['pathImageProfile'] + `" alt="` + chat['codUtente'] + `">
                </div>
            </div>
            <div>
                <div>
                    <strong><span>` + chat['nome'] + ` ` + chat['cognome'] + `</span></strong>
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
                        body += createChat(chats[x]);
                    }
                    document.getElementById('chats').innerHTML = body;
                }

            }

        }
    };
    xhttp.open("GET", "API/searchChatAPI.php?u=" + getCookie('u') + '&search=' + this.value, true);
    xhttp.send();
});