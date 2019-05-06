<?php
    $username = $_COOKIE['u'];
?>
<div class="container-fluid container-chitchat">
    <div class="col-2 user-containerSetting">
        <div>
            <div>
                <img src="https://images.unsplash.com/photo-1480535339474-e083439a320d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=751&q=80" alt="<?php echo $username; ?>">
            </div>
            <div>
                <span><?=$_SESSION["nome"]?> <?=$_SESSION["cognome"]?></span>
            </div>
        </div>

        <div>
            <ul>
                <li>
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </li>
                <li>
                    <i class="far fa-comments"></i>
                    <span>Chat</span>
                </li>
                <li>
                    <i class="fas fa-gamepad"></i>
                    <span>Game</span>
                </li>
                <li>
                <i class="fas fa-user-cog"></i>
                    <span>Settings</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-4 p-0">
        <?php @include 'slideChat.php'; ?>
    </div>
    <div class="col-6">
        <?php @include 'chat.php'; ?>
    </div>
</div>