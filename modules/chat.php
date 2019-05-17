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
        <input type="text" placeholder="Type a message..."> 
    </div>
    <div>
        <button id="attach"><i class="fas fa-paperclip"></i></button>
        <form method="post" enctype="multipart/form-data" id="formImg">
            <input type="file" name="image" id="image" accept="image/gif, image/jpg, image/jpe, image/jpeg, image/png">
            <input type="hidden" name="idChat" id="idChat">
            <input type="submit" id="submit" name="imageAttach">
        </form>
        <button type="submit" id="send"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>
<script src="js/chatAjax.js?c=<?php echo filemtime("js/chatAjax.js"); ?>"></script>
<script src="js/sendMessage.js?c=<?php echo filemtime("js/sendMessage.js"); ?>"></script>
<script src="js/viewImage.js?c=<?php echo filemtime("js/viewImage.js"); ?>"></script>