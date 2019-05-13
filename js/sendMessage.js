document.getElementById('input').children[0].addEventListener('keypress', function(e){
    var content = htmlspecialchars(this.innerHTML);
    var idChat = localStorage.getItem('chatOpen');
    if(e.keyCode === 13){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != undefined) {
                    document.getElementById('input').children[0].innerHTML = '';
                    document.getElementById('input').children[0].style.color = '#000';
                }
            }
        };
        xhttp.open("GET", "elaborator/sendMessage&idChat="+idChat+"&m="+content, true);
        xhttp.send();
    }
});
