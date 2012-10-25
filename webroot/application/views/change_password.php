<div class="wrapper">
	<div class="container">
<?php if(isset($error_message)) {?>
    <br/><div class="error"><?php echo $error_message;?></div>
<?php } ?>
<?php if(isset($success_message)) {?>
    <h3><?php echo $success_message;?></h3>
    <a class="btn-blue" href="<?php echo base_url()?>user/dashboard">Dashboard</a>
<?php } else{?>
	<form action="<?php echo base_url()?>user/change_password" method="post" id="login" name="login">
	
	    <h1>Change Password</h1>
	    <div><label>New Password</label></div>
	    <div><input type="password" name="new_password" size="55"/></div>
	    <div><label>Confirm Password</label></div>
	    <div><input type="password" name="confirm_password" size="55"/></div>
	    <div>
	        <br/>
	        <input type="submit" id="change_pwd_btn" class="btn-blue" value="Submit">
	    </div>
	</form>
<?php }?>	
	</div>
</div>

