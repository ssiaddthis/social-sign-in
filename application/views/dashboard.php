<div class="wrapper">
<div class="container">
<form action="<?php echo base_url()?>user/index" method="post" id="login">
<h1>User Dashboard </h1>
<?php if(isset($error_message)) {?>
    <br/><div class="error"><?php echo $error_message;?></div><?php } else { ?>
    <p>Congratulations! You've logged in. That was easy, wasn't it? If you've connected a social network, you'll be able to see some of the data we pulled on login or registration below.</p>
    <p>You can also add a social network for signing in with, or logout. Note that all networks provide different kinds of data on authenticating users; our API abstracts them all into a single object, so code you write for one will work for all.</p>
<?php } ?>
<br/>
<br/><div><span style="margin-right:20px"><label>Username : </label></span><label><b><?php echo $username;?></b></label></div>
<?php if($service):?><br/><div><span style="margin-right:20px"><label>Service : </label></span><label><?php echo $service;?></label></div><?php endif;?>
<?php if($thumb_url):?><img src="<?php echo $thumb_url;?>" width="50" height="50"/><?php endif;?>
<?php if($firstname):?><br/><div><span style="margin-right:20px"><label>Name : </label></span><label><b><?php echo $firstname;?>&nbsp;<?php echo $lastname;?></b></label></div><?php endif;?>
<?php if($link):?><br/><div><span style="margin-right:20px"><label>Profile URL : </label></span><label><?php echo $link;?></label></div><?php endif;?>
<?php if($locale):?><br/><div><span style="margin-right:20px"><label>Locale : </label></span><label><?php echo $locale;?></label></div><?php endif;?>
<?php if($timezone):?><br/><div><span style="margin-right:20px"><label>Timezone : </label></span><label><?php echo $timezone;?></label></div><?php endif;?>

</form>

<br/>
<br/>
<a class="btn-blue" href="<?php echo base_url()?>user/connect">Add network</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a class="btn-blue" href="<?php echo base_url()?>user/change_password">Change Password</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a class="btn-blue" href="<?php echo base_url()?>user/logout">Logout</a></b>
<br/>

</div>
</div>
