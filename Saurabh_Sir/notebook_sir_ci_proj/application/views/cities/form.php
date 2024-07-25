<!DOCTYPE html>
<html>
	<head>
      <title><?= $page_title ?></title>
	  <?php $this->load->view('common/inner-header'); ?>
	   <link href="<?= base_url(); ?>assets/css/select2.min.css" type="text/css" rel="stylesheet">
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
							<form method="post" action="<?= $action; ?>" enctype="multipart/form-data">
								<div class="panel panel-default">						
									<div class=" panel-heading">
										 <h3 class="panel-title"><?= $screen; ?></h3>
									</div>
									<div class="panel-body">  
										<div class="form-group">
											<label>State</label><span class="text text-danger"> * <?= form_error('state_id')?></span> 
											<div>
												<select name="state_id" id="selectSearch" class="form-control">
													 <option value="">--Select State--</option>
														<?php foreach($allstates as $staterow){ ?>
														<option value="<?= $staterow->id; ?>"<?= !empty($state_id) && $state_id== $staterow->id?'selected':'' ;?>><?= $staterow->state_name; ?></option>
														<?php } ?>
												</select>
											</div>
										</div> 
										<div class="form-group">
											<label>City Name</label><span class="text text-danger"> * <?= form_error('city_name')?></span> 
											<div>
												<input type="text" name="city_name" class="form-control" value="<?= !empty($city_name)?$city_name:'';?>" autocomplete="off"/>
											</div>
										</div>
										<div class="form-group">
											<label>Status</label><span class="text text-danger"> * <?= form_error('status')?></span> 
											<div class="push-left">
												<label class="radio-inline">
													<input type="radio" name="status" value="Active"   <?= !empty($status) && $status=='Active'?'checked':'';?>> Active
												</label>
												<label class="radio-inline">
													<input type="radio" name="status" value="Block"    <?= !empty($status) && $status=='Block'?'checked':'';?>> Block
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
		<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
		<script type="text/javascript">
		  $("document").ready(function(){
			//Select box search
			$( "#selectSearch" ).select2({
			});
		 });
 		</script>
	</body>
</html>

