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
							<form method="post" action="<?= $action; ?>">
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
											<label>Content</label><span class="text text-danger"> * <?= form_error('content');?></span>
											<div>
												<textarea type="text" name="content" class="form-control" autocomplete="off"><?= !empty($content)?$content:''; ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">From Date</label><span class="text text-danger"> * <?= form_error('from_date');?></span>
											<div>
												<input type="text" name="from_date" class="form-control" id="dobpicker" readonly placeholder="Select Your Date" value="<?= !empty($from_date)?$from_date:''; ?>"/>
											</div>
										</div>	
										<div class="form-group">
											<label class="control-label">To Date</label><span class="text text-danger"> * <?= form_error('to_date');?></span>
											<div>
												<input type="text" name="to_date" class="form-control" id="dobpicker1" readonly placeholder="Select Your Date" value="<?= !empty($to_date)?$to_date:''; ?>"/>
											</div>
										</div>	
										<div class="form-group">
											<label>Status</label><span class="text text-danger"> * <?= form_error('status');?></span>
											<div class="push-left">
												<label class="radio-inline">
													<input type="radio" name="status" value="Active" <?= !empty($status) && $status=='Active'?'checked':''; ?> /> Active
												</label>
												<label class="radio-inline">
													<input type="radio" name="status" value="Block" <?= !empty($status) && $status=='Block'?'checked':''; ?> > Block
												</label>
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
				minDate:'today'
			});
			$( "#dobpicker1" ).datepicker({
				showButtonPanel: true,
				changeMonth: true,
				changeYear: true,
				minDate:'today+1'
			});
		 });
 		</script>
	</body>
</html>