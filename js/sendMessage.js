document.getElementById('input').children[0].addEventListener('keypress', function(e){
    var content = htmlspecialchars(encodeURIComponent(this.innerHTML));
    var idChat = localStorage.getItem('chatOpen');
    console.log('before: '+content);
    if(e.keyCode === 13){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != undefined) {
                    console.log(this.responseText);
                    document.getElementById('input').children[0].innerHTML = '';
                    document.getElementById('input').children[0].style.color = '#000';
                }
            }
        };
        xhttp.open("GET", "elaborator/sendMessage&idChat="+idChat+"&m="+content, true);
        xhttp.send();
    }
});
