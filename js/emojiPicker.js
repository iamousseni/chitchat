var emojiPicker = document.getElementById('emoji-picker');
var emojiDisplay = document.getElementsByClassName('intercom-composer-popover intercom-composer-emoji-popover')[0];
var emoji = document.getElementsByClassName('intercom-emoji-picker-emoji');
var messageField = document.getElementById('messageField');

emojiPicker.addEventListener('click', function() {
    document.getElementsByClassName('intercom-composer-emoji-popover')[0].classList.toggle('active');
});

document.getElementById('display-messages').addEventListener('click', function(){
    document.getElementsByClassName('intercom-composer-emoji-popover')[0].classList.remove('active');
});

for(let x=0; x < emoji.length; x++){
    emoji[x].addEventListener('click', function(){
        //dove c'è il cursore inserisco l'emoji selezionato
        let caretPosition = messageField.selectionStart
        let beforeCaret = messageField.value.substring(0, caretPosition);
        let afterCaret = messageField.value.substring(caretPosition);
        messageField.value = beforeCaret + this.innerHTML + afterCaret; 
        messageField.focus();
        //riposiziono il cursore
        messageField.setSelectionRange(messageField.value.substring(0, (beforeCaret + this.innerHTML ).length).length, messageField.value.substring(0, (beforeCaret + this.innerHTML ).length).length);
    });
}


