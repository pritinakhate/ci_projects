<!DOCTYPE html>
<html>
<head>
	<title>Toaster</title>
	    <meta name="charset" content="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="assets/css/jquery-ui.css" rel="stylesheet"/>
		<link href="assets/css/select2.min.css" rel="stylesheet"/>
		<link href="assets/css/toastr.min.css" rel="stylesheet"/>
		<link href="assets/css/style.css" rel="stylesheet"/>
</head>
<body>
   <div class="container">
		<br/>
		<br/>
		<br/>
		<form method="post">
		<h2>Toaster Example</h2>
		<hr/>
		<button type="submit" class="btn btn-success" name="success">SUCCESS</button>
		<button type="submit" class="btn btn-danger" name="error">ERROR</button>
		<button type="submit" class="btn btn-warning"name="warning">WARNING</button>
		<button type="submit" class="btn btn-info" name="info">INFO</button>
		
		</form>
	</div>
	    <script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/toastr.min.js"></script>
		
		<?php 
		if(isset($_POST['success']))
		{
			echo "<script>toastr.success('Massage Successfully Displayed');</script>";
		}
		if(isset($_POST['error']))
		{
			echo "<script>toastr.error('Error Massage Successfully Displayed');</script>";
		}
		if(isset($_POST['warning']))
		{
			echo "<script>toastr.warning('Warning Massage Successfully Displayed');</script>";
		}
		if(isset($_POST['info']))
		{
			echo "<script>toastr.info('Info Massage Successfully Displayed');</script>";
		}
		?>
</body>
</html>