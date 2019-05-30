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
        var message = messages[x].testo == null ?
            `<div>
                <div>
                    <img src="` + messages[x].pathFile + `" class="image" onclick="viewImage(this)">
                </div>
                <div>
                    <span class="date">`+messages[x].dataOraInvio+`</span>
                </div>
             </div>` :
            `<div>
                <div>
                    <span class="bubble">` + markdownToHTML(htmlspecialchars(messages[x]['testo'])) + `</span>
                </div>
                <div>
                    <span class="date">`+messages[x].dataOraInvio+`</span>
                </div>
             </div>`;

        if (messages[x].codUtente != getCookie('u')) {
            // Se messaggio dall'altro utente: sx e foto profilo
            outMessage += `
        <div class="left chitchat-messages" >
            <div>
                <img src="` + messages[x].pathImageProfile + `" alt="` + messages[x].codUtente + `">
            </div>`;
        } else {
            // Se messaggio da noi: dx
            outMessage += `<div class="right chitchat-messages" >`;
        }

        outMessage += `
            ` + message + `
        </div>
        `;
    }
    return outMessage;
}

// Convert markdown to HTML (returns a str)
function markdownToHTML(markdown) {
    markdown = markdownReplacer(markdown, /\*\*\*/, '<strong><em>', '</em></strong>');
    markdown = markdownReplacer(markdown, /\_\_\_/, '<strong><em>', '</em></strong>');
    markdown = markdownReplacer(markdown, /\*\*/, '<strong>', '</strong>');
    markdown = markdownReplacer(markdown, /\_\_/, '<strong>', '</strong>');
    markdown = markdownReplacer(markdown, /\*/, '<em>', '</em>');
    markdown = markdownReplacer(markdown, /\_/, '<em>', '</em>');
    markdown = markdownReplacer(markdown, /~~/, '<del>', '</del>');
    markdown = markdownReplacer(markdown, /--/, '<del>', '</del>');
    return markdown;
}

// Replace the delimiter with the start and end tags
function markdownReplacer(markdown, delimiter, startHTML, endHTML) {
    g = 0; // Counter
    // Finché c'è un delimitatore...
    while (markdown.search(delimiter) != -1) {
        // Sostituisci il delimitatore alternativamente...
        if (g % 2 === 0)
            // ...Con il tag d'inizio
            markdown = markdown.replace(delimiter, startHTML);
        else
            // ...Con il tag finale
            markdown = markdown.replace(delimiter, endHTML);
        g++;
    }
    return markdown;
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
