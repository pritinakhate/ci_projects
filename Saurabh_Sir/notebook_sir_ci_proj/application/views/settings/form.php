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
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box">
							<form method="post" action="<?= $action; ?>"  enctype="multipart/form-data">
								<div class="panel panel-default">						
									<div class=" panel-heading">
										  <h3 class="panel-title"><?= $screen; ?></h3>
									</div>
									<div class="panel-body">  
										<div class="form-group">
											<label>Title</label><span class="text text-danger"> * <?= form_error('title');?></span>
											<div>
												<input type="text" name="title" class="form-control" value="<?= !empty($title)?$title:''; ?>" autocomplete="off"/>
											</div>
											<span class="text text-danger"> </span>
										</div>
										<div class="form-group">
											<label>Tagline</label><span class="text text-danger"> * <?= form_error('tagline');?></span>
											<div>
												<textarea type="text" name="tagline" class="form-control" autocomplete="off"><?= !empty($tagline)?$tagline:''; ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">Logo</label><span class="text text-danger"></span>
											<div>
												<input type="hidden" name="old_logo" class="form-control" value="<?= !empty($logo)?$logo:''?>"/>
												<input type="file" name="logo" class="form-control"/>
												<?php if(isset($logo) && !empty($logo)){ ?>
												<img src="<?= base_url(); ?>uploads/settings_photo/<?= $logo;?>" alt="<?= $logo;?>" width="50px"/>
												<?php } ?>
											</div>
										</div>	
										<div class="form-group">
											<label class="control-label">Footer Note</label><span class="text text-danger"> * <?= form_error('footer_note');?></span>
											<div>
												<textarea type="text" name="footer_note" class="form-control" autocomplete="off"><?= !empty($footer_note)?$footer_note:''; ?></textarea>
											</div>
										</div>									
									</div>
									<div class="panel-footer">
										<div>&nbsp; <br/>
											<button type="submit" name="save" class="btn btn-success btn-sm"><?= $button; ?></button>
											<button type="button" name="cancel" class="btn btn-danger btn-sm" onclick="window.location='<?= $cancel_action; ?>'"><?= $cancel; ?></button>
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
			$( "#dobpicker1" ).datepicker({
				showButtonPanel: true,
				changeMonth: true,
				changeYear: true,
			});
		 });
 		</script>
	</body>
</html>