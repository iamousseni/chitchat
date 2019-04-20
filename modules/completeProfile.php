<<<<<<< HEAD
<?php include "classes/functions.php"; ?>
<?php if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['edit'])){   
    $uploadStatus = uploadPhotoToFolder('imgProfile','profiles/'.$_SESSION['username'], '');
    
    
}?>
=======
<?php
include 'Admin/include/config.php';
include 'Admin/classes/fileSystem.php';

if(isset($_POST['edit']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $fileSystem = new FileSystem();
    $fileSystem->createDirectory($_COOKIE['u'], 'profiles/' . $_COOKIE['u']);
    $uploadStatus = $fileSystem->uploadFileFromForm('imgProfile', 'profiles/' . $_COOKIE['u'],$_COOKIE['u']);
    if($uploadStatus[0]){
        $_SESSION['userProfileImage'] =  $uploadStatus[1];
        //ricarico per aggiornare l'immagine appena caricata
        header('location: completeProfile');
    }else{
        $_SESSION['message'] = $uploadStatus[1];
    }
}

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $userImageProfile = $_SESSION['userProfileImage'];
    $bio = addslashes($_POST['bio']);
    $username = $_COOKIE['u'];

    $result = $mysqli->query("UPDATE utente SET pathImageProfile = '$userImageProfile', bio = '$bio' WHERE username = '$username';");

    if(!$result){
        $_SESSION['message'] = 'Errore, non è stato possibile aggiornare l\'immagine di profilo o la bio dell\'utente specificato';
    }else{
        header('location: home');
    }
}

?>
>>>>>>> 8909bcc530acd2b20c526776ceb234febbc61da7
<div class="container-fluid bk-cc left completeProfile">
    <div class="col-6 container-complete left">
        <div class="imgProfile">
            <img src="<?php echo $_SESSION['userProfileImage']; ?>" alt="image profile">
        </div>
        <div class="container-edit">
<<<<<<< HEAD
            <form action="./" method="post" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="60000">
                <input type="file" name="imgProfile" value="Edit Profile"><br>
                <input type="submit" name="edit">
=======
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="imgProfile">
                <input type="submit" name="edit" id="edit" style="display:none">
>>>>>>> 8909bcc530acd2b20c526776ceb234febbc61da7
            </form>
        </div>
        <div class="container-edit-info txt-center">
            <p>
                You can edit your profile picture or upload <br>
                a new one (JPG or PNG)
            </p>
        </div>
    </div>
    <div class="col-6 left container-bio">
        <h1>Talk About Yourself!</h1>
        <form action="" method="post">
            <textarea name="bio" maxlength="100000" placeholder="I'm an incredible person..."></textarea>
            <input type="submit" name="submit" value="Continue">
        </form>
    </div>
</div>
<footer>
    <small>
        Chitchat helps you communicate and stay in touch with all your friends.
    </small>
</footer>
<script>
    let inputFile = document.getElementsByName('imgProfile')[0];
    inputFile.addEventListener('focus', function(e){
        if(this.value != ''){
            simulateClick('edit');
        }
    });


    function simulateClick(id) {
        var event = new MouseEvent('click', {
            view: window,
            bubbles: true,
            cancelable: true
        });

        var element = document.getElementById(id); 
        var cancelled = !element.dispatchEvent(event);
        if (!cancelled) {
            console.log('clicked')
        } else {
            console.log('error')
       }
    }
</script>