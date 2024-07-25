<!DOCTYPE html>
<html>
	<head>
      <title><?= $page_title; ?></title>
	  <!--<link href="<?= base_url();?>/assets/ckeditor/samples/css/samples.css" type="text/css" rel="stylesheet"/>-->
	  <?php $this->load->view('common/inner-header'); ?>
	  <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet"/>
	  <link href="<?php echo base_url();?>assets/css/select2.min.css" rel="stylesheet"/>
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
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<br/>
											<div class="form-group">
												<label>Name</label><span class="text text-danger"> * <?= form_error('name')?></span> 
												<div>
													<input type="text" name="name" class="form-control" value="<?= !empty($name)?$name:''; ?>" autocomplete="off"/>
												</div>
											</div>
											<div class="form-group">
												<label>Email Address</label><span class="text text-danger"> * <?= form_error('email_address'); ?> </span>
												<div>
													<input type="text" name="email_address" class="form-control" value="<?= !empty($email_address)?$email_address:''; ?>" autocomplete="off"/>
												</div>
											</div>
											<div class="form-group">
												<label>Address</label><span class="text text-danger"> * <?= form_error('address')?></span> 
												<div>
													<textarea class="form-control" name= "address" rows="3" autocomplete="off"><?= !empty($address)?$address:''; ?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label>About Guest</label><span class="text text-danger"> * <?= form_error('details_about_guest')?></span> 
												<textarea class="form-control form-control-user ckeditor" name="details_about_guest" placeholder="Details about guest" autocomplete="off"><?php echo !empty($details_about_guest)?$details_about_guest:'';?></textarea>
											</div>
											<div class="form-group">
												<label class="control-label">Date Of Birth</label><span class="text text-danger"> * <?= form_error('dob')?></span>
												<div>
													<input type="text" name="dob" class="form-control" value="<?= !empty($dob)?$dob:'';?>" id="dobpicker" readonly="true" placeholder="Select Your Date"/>
												</div>
											</div>
										</div>	
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<br/>
											<div class="form-group">
												<label>Gender</label><span class="text text-danger"> * <?= form_error('gender')?></span>
												<div class="push-left">
													 <label class="radio-inline">
														  <input type="radio" name="gender"
															 value="Male" <?= !empty($gender) && ($gender=="Male")?'checked':''; ?>> Male
													   </label>
													   <label class="radio-inline">
														  <input type="radio" name="gender" value="Female" <?= !empty($gender) && ($gender=="Female")?'checked':''; ?>> Female
													   </label> 
													   <label class="radio-inline">
														  <input type="radio" name="gender" value="Other" <?= !empty($gender) && ($gender=="Other")?'checked':''; ?>>  Other
													   </label>  
												</div>
											</div>
											<div class="form-group">
												<label>Country</label><span class="text text-danger"> * <?= form_error('country_id')?></span> 
												<div>
													<select name="country_id" class="form-control selectSearch" onchange="getStates(this.value)">
													<option value="">--Select Country--</option>
													<?php foreach($allcountries as $countryrow){ ?>
														<option value="<?= $countryrow->id; ?>" <?= !empty($country_id) && ($country_id==$countryrow->id)?'selected':''; ?>><?= $countryrow->country_name; ?></option>
													<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label>State</label><span class="text text-danger"> * <?= form_error('state_id'); ?></span> 
												<div>
													<select name="state_id" class="form-control selectSearch" id="stateId">
														 <option value="">--Select State--</option>
														
														  <?php foreach($allstates as $staterow){ ?>
														<option value="<?= $staterow->id; ?>" <?= !empty($state_id) && ($state_id==$staterow->id)?'selected':''; ?>><?= $staterow->state_name; ?></option>
														<?php } ?>
													 
													</select>
												</div>
											</div>
											<div class="form-group">
												<label>City</label><span class="text text-danger"> * <?= form_error('city_id'); ?></span>
												<div >
													<select name="city_id" class="form-control selectSearch" >
														 <option value="">--Select City--</option>
														  <?php foreach($allcities as $cityrow){ ?>
														<option value="<?= $cityrow->id; ?>" <?= !empty($city_id) && ($city_id==$cityrow->id)?'selected':''; ?>><?= $cityrow->city_name; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label>Hobbies</label><span class="text text-danger"> * <?= form_error('hobby_id'); ?></span><br/>
													<?php $checkbox_count=0;
													foreach($allhobbies as $hobbyrow) {?>		
														<input type="checkbox" name="hobby_id[]" value=" <?= $hobbyrow->id?>" <?= !empty($hobby_id) && in_array($hobbyrow->id,$hobby_id)?'checked':''; ?>> <?= $hobbyrow->hobby_title; echo " "; ?>&nbsp;
													<?php	$checkbox_count++;
														echo($checkbox_count%3==0?'<br>':'');
													}?>
											</div>	
											<div class="form-group">
												<label>Photo</label><span class="text text-danger"> * <?= form_error('photo')?></span> 
												<div>
													<input type="hidden" class="form-control" name="old_photo" value="<?= !empty($photo)?$photo:'';?>"/> 
													<input type="file" class="form-control" name="photo">
													<?php if(isset($photo) && !empty($photo)){?>
													<img src="<?php echo base_url();?>uploads/guests_photo/<?= $photo;?>" alt="<?= $photo;?>" width="50"/>
													<?php } ?>
												</div>
											</div>	
											<div class="form-group">
												<label>Status</label><span class="text text-danger"> * <?= form_error('status')?></span>
												<div class="push-left">
													<label class="radio-inline">
														<input type="radio" name="status" value="Active" <?= !empty($status) && $status=='Active'?'checked':''; ?>> Active
													</label>
													<label class="radio-inline">
														<input type="radio" name="status" value="Block" <?= !empty($status) && $status=='Block'?'checked':''; ?>> Block
													</label>
												</div>
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
			<input type="text" name="site_url" id="site_url" value="<?php echo site_url(); ?>">
			<!-- Footer Start  -->
			<div class="row">
				<?php $this->load->view('common/footer')?>
			</div> 
			<!-- Footer End  -->
		</div>
	 	<?php $this->load->view('common/script'); ?>
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
		<script src="<?= base_url('assets/ckeditor/ckeditor.js');?>" type="text/javascript"></script>
		<script type="text/javascript">
		  $("document").ready(function(){
			//Select box search
			$( ".selectSearch" ).select2({
			});
			// Data picker
			$( "#dobpicker" ).datepicker({
				changeMonth: true,
				changeYear: true,
				showOtherMonths: true,
				selectOtherMonths: true,
				showButtonPanel: true,
				yearRange:'1920:2021',
				maxDate:'today-1'
			});
		 });
 		</script>
		<script>
			function getStates(countryId)
			{
				alert(countryId);
				var site_url = $("#site_url").val();
				alert(site_url);
				var url = site_url+"/Guests/getStates";
				alert(url);
				var dataString = "country_id="+countryId;
				alert(dataString); 
				$.post(url,dataString,function(returndata){ 
					alert(returndata);
				$('#stateId').html(returndata);
				});
			}
		</script>
	</body>
</html>