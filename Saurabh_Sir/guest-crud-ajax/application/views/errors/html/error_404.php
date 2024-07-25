<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ci = new CI_Controller();
?><!DOCTYPE html>
<html lang="en">
<head>
<title>404 Page Not Found</title>
<style type="text/css">
.errorbackground
{
		
	background-image: url("<?= base_url()?>assets/images/download404.png");
	background-size:1024px 600px;
	width:100%;
	text-align:center;
}
</style>
</head>
<body>
	<div id="container" class="errorbackground">
		<div>
		<br/>
		<br/>
		<h1 style="color:blue;"><?php echo $heading; ?></h1>
		<br/>
		<h4 style="color:red;"><?php echo $message; ?></h4>
		<br/>
		<a href="<?= site_url('Users/index'); ?>">Back to Dashboard</a>
		<br/><br/><br/>
		</div>
	</div>
</body>
</html>