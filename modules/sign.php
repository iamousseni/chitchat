<div class="container-fluid bk-cc">
    <nav class="col-lg-12 header">
        <div class="col-md-4 cc">
            <img src="images/logo.png" alt="chitchat">
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </nav>
    <div class="col-lg-12 body-container">
        <div class="col-lg-6 motto left">
            <h1 class="w80">Chitchat the First Social <br> Messaging for All Students</h1>
            <h2 class="w80">We are the best and biggest social messaging for students with 5 billion active users all around the world. Share your ideas, your notes, your goals, show your favourite diet aliment and much more!</h2>
            <label class="btnreg" id="regNow" for="name">Register Now!</label>
        </div>
        <div class="col-lg-6 frm-sign left">
            <?php echo isset($_SESSION['message']) ? "<p id='message'>".$_SESSION['message']."</p>" : ''; ?>
            <div class="sign-up">
                <h1>Sign Up</h1>
                <form action="elaborator/reg" method="post">
                    <div class="col-12 left mb-3">
                        <div class="col-6 left">
                            <label class="block" for="name">First Name</label>
                            <input type="text" name="name" id="name" placeholder="Name..." title="Insert Your Name" required>
                        </div>
                        <div class="col-6 left">
                            <label class="block" for="surname">Last Name</label>
                            <input type="text" name="surname" id="surname" placeholder="Last Name..." title="Insert Your Surname" required>
                        </div>
                    </div>
                    <div class="col-12 left mb-3">
                        <label class="block" for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Username..." title="Insert Your Username" required>
                    </div>
                    <div class="col-12 left mb-3">
                        <label class="block" for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email address..." title="Insert Your Email Address" required>
                    </div>
                    <div class="col-12 left mb-3">
                        <label class="block" for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="*************" title="Insert Your Password" required>
                    </div>
                    <div class="col-12 left mb-3">
                        <label class="block" for="dateBirthday">Date Birthday</label>
                        <div>
                            <select name="day" class="w33" id="day" required>
                                <option value="Giorno" disabled>Day</option>
								<?php
									for($x=0;$x<31;$x++)
									{
										echo "<option value=".date("j",mktime(0,0,0,0,($x+1),1977)).">".date("j",mktime(0,0,0,0,($x+1),1977))."</option>";
									}
								?>
                            </select>
                            <select name="month" class="w33" required>
								<option value="Mese" disabled>Month</option>
								<?php
									for($x=0;$x<12;$x++)
									{
										echo "<option value=".date("m",mktime(0,0,0,($x+1),0,1977)).">".date("F",mktime(0,0,0,($x+1),0,1977))."</option>";
									}
								?>
							</select>
							<select name="year" class="w32" required>
								<option value="Anno" disabled>Year</option>
								<?php
									for($x=0;$x<48;$x++)
									{
										echo "<option value=".date("Y",mktime(0,0,0,1,1,(date("Y")-$x))).">".date("Y",mktime(0,0,0,1,1,(date("Y")-$x)))."</option>";
									}
								?>
							</select>
                        </div>
                    </div>
                    <div class="col-12 left mb-3">
                        <label class="block" for="gender">Gender</label>
                        <select name="gender" class="w100" required>
                            <option value='M'>Male</option>
                            <option value='F'>Female</option>
                        </select>
                    </div>
                    <div class="col-12 left mb-3">
                        <label><input type="checkbox" name="term" title="You have to agree to continue" required> I agree to the <a href="">Terms of User</a></label>
                    </div>
                    <input type="submit" name="reg" style="display:none" id="reg">
                </form>
            </div>
            <div class="sign-in" style="display:none">
                <h1>Sign In</h1>
                <form action="elaborator/login" method="post">
                    <div class="col-12 left mb-3">
                        <label class="block" for="username">Username</label>
                        <input type="text" name="username" placeholder="Username..." title="Insert Your Username" required>
                    </div>
                    <div class="col-12 left mb-3">
                        <label class="block" for="password">Password</label>
                        <input type="password" name="password" placeholder="*************" title="Insert Your Password" required>
                    </div>
                    <div class="col-12 left mb-3">
                        <div class="col-6 left">
                            <label><input type="checkbox" name="remember" title="Remain Connect"> Remember me</label>
                        </div>
                        <div class="col-6 left">
                            <a href="forgot"><span>Did you forget your password?</span></a>
                        </div>
                    </div>
                    <input type="submit" name="log" style="display:none" id="log">
                </form>
            </div>
            <div class="container-form-btn col-12 left">
                <div class="col-6 left">
                    <button id="btn-sign" class="w90 active">Sign Up <i class="arr" style="display:none"></i></button>
                </div>
                <div class="col-6 left">
                    <button id="btn-log" class="w100">Sign In <i class="arr"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //TO DO 06/04/2019
    //check with ajax if username that he wrote allready exist
    //check if password are secure
    //check data if is set with right format (ex: february has at most 29 days if year are bissextile)

    let btnSign = document.getElementById('btn-sign');
    let btnLog = document.getElementById('btn-log');
    let btnReg = document.getElementById('regNow');

    btnSign.addEventListener('click', function(){
        if(!this.classList.contains('active')){
            this.classList.add('active');
            btnLog.classList.remove('active');
            document.getElementsByClassName('sign-up')[0].style.display = 'block';
            document.getElementsByClassName('sign-in')[0].style.display = 'none';
            document.getElementsByClassName('arr')[1].style.display = 'inline';
            document.getElementsByClassName('arr')[0].style.display = 'none';
        }else{
            simulateClick('reg');
        }
    });

    btnLog.addEventListener('click', function(){
        if(!this.classList.contains('active')){
            this.classList.add('active');
            btnSign.classList.remove('active');
            document.getElementsByClassName('sign-in')[0].style.display = 'block';
            document.getElementsByClassName('sign-up')[0].style.display = 'none';
            document.getElementsByClassName('arr')[1].style.display = 'none';
            document.getElementsByClassName('arr')[0].style.display = 'inline';
        }else{
            simulateClick('log');
        }
    });

    btnReg.addEventListener('click', function(){
        btnSign.classList.add('active');
        btnLog.classList.remove('active');
        document.getElementsByClassName('sign-up')[0].style.display = 'block';
        document.getElementsByClassName('sign-in')[0].style.display = 'none';
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