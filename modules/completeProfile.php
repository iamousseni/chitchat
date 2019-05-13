<div class="container-fluid bk-cc left completeProfile">
    <div class="col-6 container-complete left">
        <div class="imgProfile">
            <img src="<?php echo $_SESSION['userProfileImage']; ?>" alt="image profile">
        </div>
        <div class="container-edit">
            <?php echo $_SESSION['message']; ?>
            <form action="elaborator/completeProfileElaborator" method="post" enctype="multipart/form-data">
                <input type="file" name="imgProfile" accept="image/gif, image/jpg, image/jpe, image/jpeg, image/png" required>
                <input type="submit" name="edit" id="edit" style="display:none">
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
        <form action="elaborator/completeProfileElaborator" method="post">
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
    inputFile.addEventListener('change', function(e) {
        if (this.value != '') {
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