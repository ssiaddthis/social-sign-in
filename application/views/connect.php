<div class="wrapper">
<div class="container">
<form action="<?php echo base_url()?>user/connect" method="post" id="connect" name="connect">
<h1>Add Network </h1>
<br/>
<?php if(isset($error_message)):?><br/><div class="error" style="margin-bottom:0px;"><?php echo $error_message;?></div><?php endif;?>
<?php if(isset($success_message)):?><br/><div class="success" style="margin-bottom:0px;"><?php echo $success_message;?></div><?php endif;?>
<?php if($this->session->flashdata('message')):?><br/><div class="success" style="margin-bottom:0px;"><?php echo $this->session->flashdata('message');?></div><?php endif;?>
<br/>
<?php 
if(count($connect_data) < 3){
    if(count($connect_data) == 0){
        echo "<p>You haven't added any social networks! Try one out:</p>";
    } else {
        echo '<p>You can still add another network:</p>';
    }
?>
<div class="addthis_toolbox">
<?php
    $services = array('google'=>0,'twitter'=>0, 'facebook'=>0);
    foreach ($connect_data as $row) {
        $services[$row->service] = 1;
    }
    foreach ($services as $s=>$on) {
        if (!$on) {
            echo '<a class="addthis_login_'.$s.'"></a>';
        }
    }
    echo '</div>';
} else {
?>
    <p>You've connected all three accounts. To add another, you'll need to disconnect one.</p>
<?php
}
?> 
<br/>
<br/>
<br/>
<?php 
if(count($connect_data) > 0) {
    echo '<label>Connected Accounts:</label>';
    foreach ($connect_data as $row) {
        switch($row->service){		
            case 'google':?>
            <div style="height:40px"><img src="<?php echo base_url()?>skin/images/gmail.png" style="vertical-align:middle"/>&nbsp;&nbsp;
            
        <?php 
            break;
            case 'twitter':?>
            <div style="height:40px"><img src="<?php echo base_url()?>skin/images/twitter.png" style="vertical-align:middle"/>&nbsp;&nbsp;
           
        <?php 
            break;
            case 'facebook' :?>
            <div style="height:40px"><img src="<?php echo base_url()?>skin/images/facebook.png" style="vertical-align:middle"/>&nbsp;&nbsp;
           
        <?php break;			
        }?>
        <a href="<?php echo $row->profileUrl?>" target="_blank"><?php echo $row->profileUrl?></a>
            &nbsp;&nbsp;
            <?php if(count($connect_data)>1):?><a href="javascript:remove_access(<?php echo $row->social_id?>)"><img src="<?php echo base_url()?>skin/images/delete.png" border="0"/></a><?php endif;?>
        </div>
      <?php   
    } 
}
?>

 <br/><br/>
    <input type="hidden" name="signature" id="signature" value=""/>
    <input type="hidden" name="firstname" id="firstname" value=""/>
    <input type="hidden" name="lastname" id="lastname" value=""/>
    <input type="hidden" name="thumb_url" id="thumb_url" value=""/>
    <input type="hidden" name="link" id="link" value=""/>
    <input type="hidden" name="locale" id="locale" value=""/>
    <input type="hidden" name="timezone" id="timezone" value=""/>
    <input type="hidden" name="service" id="service" value=""/>
 </form>
 <script>
var addthis_config = {login : {services :{
    facebook:{appId:'161499153968957'} , 
    google:{clientId:'780989514794.apps.googleusercontent.com'}, 
    twitter:{appKey:'zJBQiyqKl76HCqn2bmwNw'}
	}, callback:function(user) {
	
	var signature = document.getElementById('signature');
	signature.value = user.addthis_signature;
    document.getElementById('firstname').value = user.firstName;
    document.getElementById('lastname').value = user.lastName;
    document.getElementById('thumb_url').value = user.thumbnailURL;
    document.getElementById('link').value = user.profileURL;
    document.getElementById('locale').value = user.locale;
    document.getElementById('timezone').value = user.timezone;
    document.getElementById('service').value = user.service;	
	document.connect.submit();		
	}
  }
}; 

//addthis.login.connect({twitter: {id: 12345},facebook: {id: 333,scope:'email,fff'}, callback:function (user){
//	
//	var signature = document.getElementById('signature');
//	signature.value = user.addthis_signature;
//	document.getElementById('firstname').value = user.firstName;
//	document.getElementById('lastname').value = user.lastName;
//	document.getElementById('thumb_url').value = user.thumbnailURL;
//	document.getElementById('link').value = user.profileURL;
//	document.getElementById('locale').value = user.locale;
//	document.getElementById('timezone').value = user.timezone;
//	document.getElementById('service').value = user.service;
//	document.login.submit();	
//	}
//});
 
</script>
<script>
function remove_access(social_id)
{
	var con = confirm("Are you sure?");
	if(con) 
	{
		document.location.href = "<?php echo base_url()?>/user/remove_access/"+social_id;
	} else 
	{
		document.location.href ="#";
	}	
} 
</script>

<br/>
<br/>
<br/>
<br/>
<br/>
<a class="btn-blue" href="<?php echo base_url()?>user/dashboard">Dashboard</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn-blue" href="<?php echo base_url()?>user/logout">Logout</a>
</div>
</div>
