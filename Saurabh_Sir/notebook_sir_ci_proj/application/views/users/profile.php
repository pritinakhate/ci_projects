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
										  <h3 class="panel-title"><?= $record; ?></h3>
									</div>
									<div class="panel-body">  
										<div class="form-group">
											<label>Name </label><span class="text text-danger"> * <?= form_error('name'); ?></span>
											<div>
												<input type="text" name="name" class="form-control" value="<?= !empty($name) && isset($name)?$name:''; ?>"/>
											</div>
										</div>
										<div class="form-group">
											<label>Email Address </label><span class="text text-danger"> * <?= form_error('email_address'); ?></span>
											<div>
												<input type="text" name="email_address" value="<?= !empty($email_address) && isset($email_address)?$email_address:''; ?>" class="form-control"/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">Date Of Birth </label><span class="text text-danger"> * <?= form_error('dob'); ?></span>
											<div>
												<input type="text" class="form-control" name="dob" id="dobpicker" readonly="true" value="<?= !empty($dob) && isset($dob)?$dob:''; ?>" placeholder="Select Your Date"/>
											</div>
										</div>										
										<div class="form-group">
											<label>Gender </label><span class="text text-danger"> * <?= form_error('gender'); ?></span>
											<div class="push-left">
												<label class="radio-inline">
													<input type="radio" name="gender"
												value="Male" <?= !empty($gender) && $gender=='Male' ?'checked':''; ?>> Male
												</label>
												<label class="radio-inline">
													<input type="radio" name="gender" value="Female" <?= !empty($gender) && $gender=='Female' ?'checked':''; ?>> Female
												</label>
												<label class="radio-inline">
													<input type="radio" name="gender" value="Other" <?= !empty($gender) && $gender=='Other' ?'checked':''; ?>> Other
												</label>
											</div>
										</div>		
										<div class="form-group">
											<label>Photo </label>
											<div>
												<input type="hidden" name="old_photo" value="<?= !empty($photo)?$photo:''; ?>" class="form-control"/>
												<input type="file" name="photo" class="form-control"/>
												<?php if(!empty($photo) && isset($photo)){ ?>
												<img src="<?= base_url(); ?>uploads/users_photo/<?= $photo;?>" alt="<?= $photo; ?>" width="50px"/>
												<?php } ?>
											</div>
										</div>	
										<?php if($this->session->userdata('role')=='Admin'){ ?>
										<?php } ?>
									</div>	
									<div class="panel-footer">
										<div>&nbsp; <br/>
											<button type="submit" name="save" class="btn btn-success btn-sm"><?= $button;?></button>
											<button type="button" name="cancel" class="btn btn-danger btn-sm" onclick="window.location='<?= $cancel_action; ?>'"><?= $cancel?></button>
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
				yearRange:"1920:2021",
				maxDate:"today-1"
			});
		 });
 		</script>
	</body>
</html>