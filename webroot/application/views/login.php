<div class="wrapper">
<div class="container">
<?php if(isset($error_message)):?><br/><div class="error"><?php echo $error_message;?></div><?php endif;?>
<?php if($this->session->flashdata('message')):?><br/><div class="success"><?php echo $this->session->flashdata('message');?></div><?php endif;?>
<?php 
$welcome = !array_key_exists('nowelcome', $_GET) && !($this->session->flashdata('message'));
?>

<form action="<?php echo base_url()?>user/index" method="post" id="login" name="login">
    <input type="hidden" name="signature" id="signature" value=""/>
    <input type="hidden" name="firstname" id="firstname" value=""/>
    <input type="hidden" name="lastname" id="lastname" value=""/>
    <input type="hidden" name="thumb_url" id="thumb_url" value=""/>
    <input type="hidden" name="link" id="link" value=""/>
    <input type="hidden" name="locale" id="locale" value=""/>
    <input type="hidden" name="timezone" id="timezone" value=""/>
    <input type="hidden" name="service" id="service" value=""/>

    <?php if ($welcome) { ?>
    <h1>Welcome!</h1>
    <p>
        This site demonstrates <a href="http://www.addthis.com/labs/social-sign-in">AddThis Social Sign In</a>, a simple way to add social authentication and data to your existing
        user system. It's all based on an open source CodeIgniter project for PHP and MySQL, so you can also downoad the source and use it to add simple user registration to your site.
    </p>
    <p>
        If you've never been here before, you can create a sample account by authenticating with one of the social networks below. When you return to this site, you can login again just by
        clicking the same button you used create your account. 
    </p>
    <br/>
    <hr/>
    <?php } ?>
    <h1>Sign In</h1>
    <div><label>Username</label></div>
    <div><input type="text" name="username" size="55"/></div>
    <div><label>Password</label></div>
    <div><input type="password" name="password" size="55"/></div>
    <div>
        <br/>
        <input type="submit" id="sign_in_submit" class="btn-blue" value="Sign In">  &nbsp;&nbsp;<a href="<?php echo base_url()?>user/register">Register</a>
    </div>
</form>
<?php if(isset($_GET['admin'])):?>
<form action="<?php echo base_url()?>user/unlink" method="post" onsubmit="return unlink()">
    <div>
        <br/>
        <input type="submit" id="unlinkbtn" name="unlinkbtn" class="btn-blue" value="Disconnect All">
    </div>
</form>
<?php endif;?>

<div>
    <br/>
    <br/>
</div>

<div>Or sign in using:</div>
<div class="addthis_toolbox">
    <a class="addthis_login_google"></a>
    <a class="addthis_login_twitter"></a>
    <a class="addthis_login_facebook"></a>
</div>
<script type="text/javascript">
var addthis_config = {
    login : {
        services :{
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
               setTimeout(function() {document.login.submit();}, 1000);
        }
    }
}; 

function unlink(){
    return (confirm("Are you sure?"));
} 
</script>

<br/>
<br/>
<br/>
<br/>
<br/>

<div>
    <br/><hr></hr>
</div>

<h2>Curious about the source?</h2>
<p>You can always <a target="_blank" href="https://github.com/ssoaddthis/social-sign-in">download it here</a> straight from github.</p>
<p>Once you provide API keys via JavaScript, actually putting buttons in your page is straightforward:
<pre class="prettyprint">
&lt;div class="addthis_toolbox"&gt;
    &lt;a class="addthis_login_google"&gt;&lt;/a&gt;
    &lt;a class="addthis_login_twitter"&gt;&lt;/a&gt;
    &lt;a class="addthis_login_facebook"&gt;&lt;/a&gt;
&lt;/div&gt;
</pre>
<p>We provide standard buttons by default, but you're totally welcome to design your own.</p>
</div>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
