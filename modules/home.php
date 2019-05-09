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
                        <a>
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
                          <i class="fas fa-user-cog"></i>Settings
                        </a>
                    </li>
                    <li>
                        <a href="elaborator/logout">
                          <i class="fas fa-door-open"></i> Logout
                        </a>
                    </li>
            </ul>
        </div>
    </div>
    <div class="col-4">
        <?php @include 'slideChat.php'; ?>
    </div>
    <div class="col-6">
        <?php @include 'chat.php'; ?>
    </div>
</div>
