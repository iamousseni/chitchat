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
        <span contenteditable="true" placeholder="Type a message..."></span>
    </div>
    <div>
        <button class="attach"><i class="fas fa-paperclip"></i></button>
        <button type="submit"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>
<script src="js/chatAjax.js"></script>
<script src="js/sendMessage.js"></script>
<script src="js/viewImage.js"></script>