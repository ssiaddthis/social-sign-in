<div class="wrapper">
<div class="container">
<form action="<?php echo base_url()?>user/register" method="post" id="register" name="register">
    <input type="hidden" name="signature" id="signature" value=""/>
    <input type="hidden" name="firstname" id="firstname" value=""/>
    <input type="hidden" name="lastname" id="lastname" value=""/>
    <input type="hidden" name="thumb_url" id="thumb_url" value=""/>
    <input type="hidden" name="link" id="link" value=""/>
    <input type="hidden" name="locale" id="locale" value=""/>
    <input type="hidden" name="timezone" id="timezone" value=""/>
    <input type="hidden" name="service" id="service" value=""/>

    <h1>Register</h1>
    <?php if(isset($error_message)):?></br><div class="error"><?php echo $error_message;?></div><?php endif;?>
    <p>
    This form does classic user registration, creating a new entry in the database based on user input. 
    </p>
    <br>
    <div><label>Username</label></div>
    <div><input type="text" name="username" size="55"/></div>
    <div><label>Password</label></div>
    <div><input type="password" name="password" size="55"/></div>
    <div><label>Confirm Password</label></div>
    <div><input type="password" name="confirm_password" size="55"/>
    </div>
    <div><br/><input type="submit" id="sign_in_submit" class="btn-blue" value="Register"> &nbsp;&nbsp;<a href="<?php echo base_url()?>user/index">Login</a></div>
</form>
<div><br/><hr></hr></div>
</div>
</div>
