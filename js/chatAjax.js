//deposito di interval
var intervalsIds = [];
function openChat(idChat){
var messages;
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText != undefined) {
            messages = JSON.parse(this.responseText);
            localStorage.setItem('numMesChat'+idChat, messages.length);
            document.getElementById('display-messages').innerHTML = outputMessages(messages);
            scrollToBottom(document.getElementById('display-messages'));
        }
    }
};
xhttp.open("GET", "API/messagesAPI.php?idChat="+idChat, true);
xhttp.send();
}

function checkChat(codeChat){
intervalsIds = 
setInterval(() => {
    var messages;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != undefined) {
                messages = JSON.parse(this.responseText);
                if(messages.length != localStorage.getItem('numMesChat'+codeChat)){
                    localStorage.setItem('numMesChat'+codeChat, messages.length);
                    document.getElementById('display-messages').innerHTML = outputMessages(messages);
                    scrollToBottom(document.getElementById('display-messages'));
                } 
            }
        }
    };
    xhttp.open("GET", "API/messagesAPI.php?idChat="+codeChat, true);
    xhttp.send();
}, 1000);
}

function outputMessages(messages){
var outMessage = '';
for(let x=0; x < messages.length; x++){
    var message = messages[x].testo == null ? '<img src="'+messages[x].pathFile+'">' : '<span>'+messages[x]['testo']+'</span>';

    //messaggio proveniente dall'utente loggato?
    if(messages[x].codUtente != getCookie('u')){
        outMessage+=`
        <div class="left chitchat-messages" >
            <div>
                <img src="`+messages[x].pathImageProfile+`" alt="`+messages[x].codUtente+`">
            </div>`;
    }else{
        outMessage+=`<div class="right chitchat-messages" >`;
    }

    outMessage += `
            <div>
            `+message+`
            </div>
        </div>
        `;
}
return outMessage;
}


var slideChat = document.getElementsByClassName('slide-chat');
for(let x=0; x<slideChat.length; x++){
    slideChat[x].addEventListener('click', function(){
        //elimino il setIntervel della chat presistente altrimenti si rischia l'accumulo e poi il sovraccarico
        clearAllChatSetInterval();
        //ottengo codice dell'id dell'elemento così so che chay devo aprire
        let codChat = this.id.substring(4);
        localStorage.removeItem('unreadChat' + codChat);
        //ripristino la situazione iniziale della notifica
        this.children[1].children[1].children[1].innerHTML = '';
        this.children[1].children[1].children[1].style.display = 'none';

        //rimuovo dal localStorage l'id della chat che è stata appena cliccata
        var unreaded = localStorage.getItem('chatUnread').split('-');
        unreaded = unreaded.filter(function (ele) {
            return ele != codChat;
        });
        localStorage.setItem('chatUnread', unreaded.join('-'));

        //apri la chat specifica
        openChat(codChat);
        checkChat(codChat);
    });
}

function clearAllChatSetInterval(){
    window.clearInterval(intervalsIds);
}

function scrollToBottom(element){
    element.scrollTo(0, element.scrollHeight);
}
