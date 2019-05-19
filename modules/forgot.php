<div class="container-fluid containerForgot bk-cc">
    <div class="col-6">
        <div>
            <img src="images/forgot.gif">
        </div>
    </div>
    <div class="col-6">
        <div>
            <?php 
                echo isset($_SESSION['success']) ? '<span style="color:green">'.@$_SESSION['success'].'</span>' : '<span style="color:red">'.@$_SESSION['error'].'</span>';  unset($_SESSION['success']);
                 unset($_SESSION['error']);   
            ?>

            <h1>Forgot <br> Password?</h1>
            <h2>Enter the username associated with your account.</h2>
        </div>
        <div>
            <form action="elaborator/resetPassword" method="post">
                <input type="text" name="username" id="username" placeholder="Enter Your Username">
                <input type="submit" name="forgot" value="Confirm">
            </form>
        </div>
    </div>
</div>