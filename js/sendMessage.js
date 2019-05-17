var input = document.getElementById('input').children[0];
input.addEventListener('keypress', function(e){
    var content = htmlspecialchars(encodeURIComponent(this.value));
    var idChat = localStorage.getItem('chatOpen');
    if(e.keyCode === 13){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != undefined) {
                    input.value = '';
                    input.style.color = '#000';
                }
            }
        };
        xhttp.open("GET", "elaborator/sendMessage&idChat="+idChat+"&m="+content, true);
        xhttp.send();
    }
});
