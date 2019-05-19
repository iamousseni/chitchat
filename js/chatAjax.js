//deposito di interval
var intervalsIds = [];

function openChat(idChat) {
    //visualizzo il nome della persona con cui sto chattando
    document.getElementsByClassName('chat-header')[0].children[0].innerHTML = sessionStorage.getItem('fullnameChatOpen');

    sessionStorage.setItem('chatOpen', idChat);
    document.getElementById('idChat').value = sessionStorage.getItem('chatOpen');
    var messages;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != undefined) {
                messages = JSON.parse(this.responseText);
                sessionStorage.setItem('numMesChat' + idChat, messages.length);
                document.getElementById('display-messages').innerHTML = outputMessages(messages);
                scrollToBottom(document.getElementById('display-messages'));
            }
        }
    };
    xhttp.open("GET", "API/messagesAPI.php?idChat=" + idChat, true);
    xhttp.send();
}

function checkChat(codeChat) {
    intervalsIds =
        setInterval(() => {
            var messages;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText != undefined) {
                        messages = JSON.parse(this.responseText);
                        if (messages.length != sessionStorage.getItem('numMesChat' + codeChat)) {
                            sessionStorage.setItem('numMesChat' + codeChat, messages.length);
                            document.getElementById('display-messages').innerHTML = outputMessages(messages);
                            scrollToBottom(document.getElementById('display-messages'));
                        }
                    }
                }
            };
            xhttp.open("GET", "API/messagesAPI.php?idChat=" + codeChat, true);
            xhttp.send();
        }, 500);
}

function outputMessages(messages) {
    var outMessage = '';
    for (let x = 0; x < messages.length; x++) {
        var message = messages[x].testo == null ? '<div><img src="' + messages[x].pathFile + '" class="image" onclick="viewImage(this)"></div>' : '<div><span>' + htmlspecialchars(messages[x]['testo']) + '</span></div>';

        //messaggio proveniente dall'utente loggato?
        if (messages[x].codUtente != getCookie('u')) {
            outMessage += `
        <div class="left chitchat-messages" >
            <div>
                <img src="` + messages[x].pathImageProfile + `" alt="` + messages[x].codUtente + `">
            </div>`;
        } else {
            outMessage += `<div class="right chitchat-messages" >`;
        }

        outMessage += `
            ` + message + `
        </div>
        `;
    }
    return outMessage;
}


function clearAllChatSetInterval() {
    window.clearInterval(intervalsIds);
}

function scrollToBottom(element) {
    element.scrollTo(0, element.scrollHeight);
}

window.addEventListener('load', function () {
    simulateClick('chat'+sessionStorage.getItem('chatOpen'));
});