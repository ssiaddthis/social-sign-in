<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="<?php echo base_url()?>skin/images/logo100100.png" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>skin/css/style.css"/>
	<meta charset="utf-8"/>
	<title>AddThis Social Login::DEMO</title>
</head>
<body>
<div id="header">
    <?php if(!$this->session->userdata('id')){?>
    <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>skin/images/bg-header-logo.gif" border="0"/></a>
    <?php } else {?>
    <a href="<?php echo base_url()?>user/dashboard"><img src="<?php echo base_url()?>skin/images/bg-header-logo.gif" border="0"/></a>
    <?php }?>
</div>

<br/><br/>

<div style="float:right;margin-right:15px;width:300px">
    <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
        <a class="addthis_button_preferred_1"></a>
        <a class="addthis_button_preferred_2"></a>
        <a class="addthis_button_preferred_3"></a>
        <a class="addthis_button_preferred_4"></a>
        <a class="addthis_button_compact"></a>
        <a class="addthis_counter addthis_bubble_style"></a>
    </div>
<!-- AddThis Button END -->
</div>
