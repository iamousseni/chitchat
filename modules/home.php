<?php
    $username = $_COOKIE['u'];
    $_SESSION['imageProfile'] = isset($_SESSION['imageProfile']) ? $_SESSION['imageProfile'] : 'https://images.unsplash.com/photo-1480535339474-e083439a320d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60';
?>
<div class="container-fluid container-chitchat">
    <div class="col-2 user-containerSetting">
        <div>
            <div>
                <img src="<?php echo $_SESSION['imageProfile']; ?>" alt="<?php echo $username; ?>">
            </div>
            <div>
                <span><?=$_SESSION["nome"]?> <?=$_SESSION["cognome"]?></span>
            </div>
        
        </div>


        <div>
            <ul>
                <li>
                    <a>
                        <i class="fas fa-home"></i>Home
                    </a>
                </li>
                <li>
                    <a id="chat">
                        <i class="far fa-comments"></i>Chat
                    </a>
                </li>
                <li>
                    <a>
                        <i class="fas fa-gamepad"></i>Game
                    </a>
                </li>
                <li>
                    <a>
                    <div id="modify" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-user-cog"  ></i>Settings
                    </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header" >
                                        <div class="modal-title" id="exampleModalLabel" style="width: 100%">   
                                        <div class="title" >
                                            <div class="user-containerSetting col-md-offset-3" id="test">
                                                <div>
                                                    <div >

                                                        <img onclick='modify()' src="<?php echo $_SESSION['imageProfile']; ?>" alt="<?php echo $username; ?>">
                                                    </div>  
                                                    </div>
                                                    </div> 
                                        </div>
                                        <h4>
                                        <span class="nome"><?=$_SESSION["nome"]?> <?=$_SESSION["cognome"]?></span>
                                        <span aria-hidden="true"></span>
                                        </button>
                                        </h4>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                        <div class="form-group">
                                       <!-- nome,cognome,foto-->
                                            <label for="recipient-name" class="col-form-label">Name:</label>
                                            <input type="text" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Surname:</label>
                                            <textarea class="form-control" id="message-text"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Mail:</label>
                                            <textarea class="form-control" id="message-text"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Password:</label>
                                            <textarea class="form-control" id="message-text"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Genere:</label>
                                            <textarea class="form-control" id="message-text"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Bio:</label>
                                            <textarea class="form-control" id="message-text"></textarea>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Conferma Mofiche</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                       
                <li>
                    <a href="elaborator/logout">
                        <i class="fas fa-door-open"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-4 p-0" id="page">
    <?php 
    include @include 'slideChat.php'; ?>
    </div>
    <div class="col-6 container-chat">
        <?php @include 'chat.php'; ?>
    </div>
    <script class src="js/UserModify.js"></script>
    <script src="js/UserModify.js?c=<?php echo filemtime("js/UserModify.js"); ?>"></script>
</div>

<script>
let chat = document.getElementById('chat');
chat.addEventListener('click', function(){
    console.log('click');
    loadPage('users.php');
});

function loadPage(uri){
    let xhttp = new XMLHttpRequest();
    let form = new FormData();
    xhttp.open('POST', 'home');
    xhttp.onreadyStateChange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText != undefined){
                document.getElementById('page').innerHTML = this.responseText;
            }else{
                console.log('oops');
            }
        }
    };
    form.append('uri', uri);
    xhttp.send(form);
}

</script>
