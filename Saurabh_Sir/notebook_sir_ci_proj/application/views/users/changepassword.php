<!DOCTYPE html>
<html>
	<head>
      <title><?= $page_title; ?></title>
	  <?php $this->load->view('common/inner-header'); ?>
	  <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row" id="menu-row"><!-- first row start-->
				<?php $this->load->view('common/navigation'); ?>
			</div><!-- first row end-->
			<div class="row"><!-- second row start-->
				<div class="col-md-2 col-sm-2 col-xs-12 example-navbar-collapse content new-height">
					<?php $this->load->view('common/left-panel');?>
				</div>
				<div class="col-md-10 col-sm-10 col-xs-12 col-lg-10 new-height">
					<div class="row" >
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 box">
							<form method="post" action="<?= $action; ?>" enctype="multipart/form-data">
								<div class="panel panel-default">						
									<div class=" panel-heading">
										  <h3 class="panel-title"><?= $screen; ?></h3>
									</div>
									<div class="panel-body">  
										
										<div class="form-group">
											<label>Old Password </label><span class="text text-danger"> * <?= $this->session->userdata('olderror'); ?><?= form_error('oldpassword'); ?> </span>
											<div>
												<input type="password" name="oldpassword" class="form-control"/>
											</div>
										</div>
										<div class="form-group">
											<label>New Password</label><span class="text text-danger"> * <?= form_error('password'); ?></span>
											<div>
												<input type="password" name="password" class="form-control"/>
											</div>
										</div>
										<div class="form-group">
											<label>Repeat Password</label><span class="text text-danger"> * <?= $this->session->userdata('passworderror');?><?= form_error('repeatpassword'); ?> </span>
											<div>
												<input type="password" name="repeatpassword" class="form-control"/>
											</div>
										</div>
									<div class="panel-footer">
										<div>&nbsp; <br/>
											<button type="submit" class="btn btn-success btn-sm"><?= $button; ?></button>
											<button type="button" class="btn btn-danger btn-sm" onclick="window.location='<?= $cancel_action; ?>'"><?= $cancel; ?></button>
										</div>
									</div>									
								</div>
							</form>
						</div>
					</div>
				</div>
			</div> <!-- Second row end-->
			<!-- Footer Start  -->
			<div class="row">
				<?php $this->load->view('common/footer')?>
			</div> 
			<!-- Footer End  -->
		</div>
	 	<?php $this->load->view('common/script'); ?>
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
		<script type="text/javascript">
		  $("document").ready(function(){
			// Data picker
			$( "#dobpicker" ).datepicker({
				showButtonPanel: true,
				changeMonth: true,
				changeYear: true,
			});
		 });
 		</script>
	</body>
</html>