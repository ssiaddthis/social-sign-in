<div class="wrapper">
<div class="container">
<h1>Select an account to connect.</h1>
<table width="800px">
<tr><td >
<?php if(!isset($event) || $event==""):?>
<form action="<?php echo base_url()?>user/index" method="post" id="login" name="login">
<div><h2>Sign in to your account.</h2></div>
<?php if(isset($error_message)):?><br/><div class="error"><?php echo $error_message;?></div><?php endif;?>
<div><label>Username</label></div>
<div><input type="text" name="username" size="30"/></div>
<div><label>Password</label></div>
<div><input type="password" name="password" size="30"/>
<input type="hidden" name="link_login" id="link_login" value="connect"/>
</div>
<div><br/><input type="submit" id="sign_in_submit" class="btn-blue" value="Link"></div>
</form>
<?php endif;?>
</td>
<td valign="top" align="left">
<form action="<?php echo base_url()?>user/create_social_account" method="post" id="login" name="login">
<div><h2>Create a new account.</h2></div>
<?php if(isset($social_error_message)):?><br/><div class="error"><?php echo $social_error_message;?></div><?php endif;?>
<div><label>Username</label></div>
<div><input type="text" name="social_username" size="30"/></div>
</div>
<div><br/><input type="submit" id="sign_in_submit" class="btn-blue" value="Create"></div>
</form>
</td>
</table>
</div>
</div>
