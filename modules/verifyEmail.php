<?php
    if(isset($_GET['e']) && $_GET['e'] != ''){
        $email = str_replace('%40','@',$_GET['e']);
        $host = ucfirst(substr($email, strpos($email,'@') +1, strpos($email,'.') - strpos($email,'@') - 1 ));
    }else{
        $email = '';
        $host = '';
    }
?>
<div class="bk-cc left h100">
    <div class="verEmail">
        <img src="images/verify.png">
        <div class="verContent">
            <h1>Confirm Your Registration!</h1>
            <h2>
                To continue using Chitchat, you will need to confirm your e-mail address. You have signed up with <?php echo $email; ?>, so you can confirm it by turning on your <?php echo $host; ?> inbox.
            </h2>
        </div>
    </div>
    <footer>
        <small>
            Chitchat helps you communicate and stay in touch with all your friends.
        </small>
    </footer>
</div>