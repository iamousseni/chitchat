function sendMessage(text){
    var content = htmlspecialchars(encodeURIComponent(text));
    var idChat = sessionStorage.getItem('chatOpen');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != undefined) {
                input.value = '';
                input.style.color = '#000';
            }
        }
    };
    xhttp.open("POST", "elaborator/sendMessage", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("&idChat="+idChat+"&m="+content);
}


var input = document.getElementById('input').children[0];
var attach = document.getElementById('attach');
var send = document.getElementById('send');
var image = document.getElementById('image');

input.addEventListener('keypress', function(e){
    if(e.keyCode === 13){
       sendMessage(this.value);
       this.value = '';
    }
});

attach.addEventListener('click', function(){
    simulateClick('image');
});


image.addEventListener('change', function(){
    if(image.value != ''){
        var data = new FormData(document.getElementById('formImg'));
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'elaborator/sendImage.php');
        xhttp.send(data);
    }
});

function simulateClick(id) {
    var event = new MouseEvent('click', {
        view: window,
        bubbles: true,
        cancelable: true
    });

    var element = document.getElementById(id); 
    var cancelled = !element.dispatchEvent(event);
    if (!cancelled) {
        console.log('clicked')
    } else {
        console.log('error')
   }
}
