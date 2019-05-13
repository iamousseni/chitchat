<?php include 'Admin/include/config.php'; ?>
<div class="chat-header">
    <span>No chat selected</span>
</div>
<div id="display-messages">
</div>

<div class="container-message">
    <div>
        <button id="emoji"><span>😌</span></button>
    </div>
    <div id="input">
        <textarea placeholder="Type a message..."></textarea>
    </div>
    <div>
        <button class="attach"><i class="fas fa-paperclip"></i></button>
        <button type="submit"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>
<script src="js/chatAjax.js"></script>
<<<<<<< HEAD
<script>
document.getElementById('input').children[0].addEventListener('keypress', function(e){
    var content = this.innerHTML;
    var idChat = localStorage.getItem('chatOpen');
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




</script>
<script src="js/Gallery.js"></script>
=======
<script src="js/sendMessage.js"></script>
>>>>>>> acfd32a978a74e3a6a1722eb09dd2da4fcb87784
