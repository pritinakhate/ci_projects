<!DOCTYPE html>
<html>
	<head>
      <title><?= $page_title; ?></title>
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
							<form method="post" action="<?= $action; ?>">
								<div class="panel panel-default">						
									<div class=" panel-heading">
										  <h3 class="panel-title"><?= $screen; ?></h3>
									</div>
									<div class="panel-body">  
										<?php if($this->session->userdata('role')=="Admin"){?>
										<div class="form-group">
											<label class="control-label">User</label>
											<div>
												<select name="user_id" class="selectSearch col-md-3">
													<option value=''>--Select User--</option>
												<?php foreach($alluser as $user){ ?>
													<option value='<?= $user->id; ?>'<?= !empty($user_id) && $user_id==$user->id?'selected':'';?>><?= $user->name; ?></option>
												<?php } ?>
												</select>
											</div>
										</div>
										<?php } ?>									
										<div class="form-group">
											<label>Name</label>
											<div>
												<input type="text" name="name" class="form-control" value="<?= !empty($name)?$name:''; ?>" autocomplete="off"/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">From Date</label><span class="text text-danger"> * <?= form_error('from_date')?></span>
											<div>
												<input type="text" name="from_date" class="form-control" id="dobpicker" readonly placeholder="Select Your Date" value="<?= !empty($from_date)?$from_date:''; ?>"/>
											</div>
										</div>	
										<div class="form-group">
											<label class="control-label">To Date</label><span class="text text-danger"> * <?= form_error('to_date')?></span>
											<div>
												<input type="text" name="to_date" class="form-control" id="dobpicker1" readonly placeholder="Select Your Date" value="<?= !empty($to_date)?$to_date:''; ?>"/>
											</div>
										</div>	
										<div class="form-group">
											<label class="control-label">City</label>
											<div>
												<select name="city_id" class="selectSearch col-md-3">
												<option value=''>--Select City--</option>
												<?php foreach($allcities as $cities){ ?>
													<option value="<?= $cities->id ?>" <?= !empty($city_id) && $city_id==$cities->id?'selected':'';?>><?= $cities->city_name; ?></option>
												<?php } ?>
												</select>
											</div>
										</div>	
										<div class="form-group">
											<label>Gender</label>
											<div class="push-left">
												<label class="radio-inline">
													<input type="radio" name="gender" value="Male" <?= !empty($gender) && $gender=='Male'?'checked':''; ?> /> Male
												</label>
												<label class="radio-inline">
													<input type="radio" name="gender" value="Female" <?= !empty($gender) && $gender=='Female'?'checked':''; ?> > Female
												</label>
											</div>
										</div>	
										<div class="form-group">
											<label>Status</label>
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
											<button type="button" name="reset" class="btn btn-danger btn-sm" onclick="window.location='<?= $reset_action; ?>'"><?= $reset; ?></button>
										</div>
									</div>								
								</div>
							</form>
							<br/>
							<br/>
							<?php if(!empty($getData)){ ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title"><?= $records; ?></h3>
								</div>
								<div class="panel-body">
								<form method="post" action="<?= $export_action?>">
									&nbsp;<button type="submit" id="guestexportbtn" class="btn btn-primary "><?= $export; ?></button>
									<input type="text" class="guestreportidcollect" name="guestreportidcollect"/>
								</form>
								<br/>
								<br/>
									<div class="table-responsive">
										<table id="datatablelist" class="table table-striped table-bordered">
										<thead>	
											<tr>
												<td>SR No.</td>
												<td>User</td>
												<td>Name</td>
												<td>City</td>
												<td>Created</td>
												<td>Gender</td>
												<td>Status</td>
											</tr>
										</thead>
										<tbody>
											<?php 
											$i=1;
											foreach($guestdata as $guest){?> 
											<tr>
											<input type="hidden" class="guestreportid" value="<?= $guest->id; ?>"/>
												<td><?= $i; ?></td>
												<td><?= $guest->username; ?></td>
												<td><?= $guest->name; ?></td>
												<td><?= $guest->city_name; ?></td>
												<td><?= $guest->created; ?></td>
												<td><?= $guest->gender; ?></td>
												<td>
													<?php if($guest->status == "Active") { ?>
													<span class="label label-success"><?= $guest->status; ?></span>
													<?php } else if($guest->status == "Block") { ?>
													<span class="label label-danger"><?= $guest->status; ?></span>
													<?php } else { ?>
													<span class="label label-warning"><?= $guest->status; ?></span>
													<?php } ?>
												</td>
											</tr>
											<?php $i++; }?>
										</tbody>
									</table>
									</div>
								</div>
							</div>	
							<?php } ?>
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
		<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
		<script type="text/javascript">
		  $("document").ready(function(){
			  $( ".selectSearch" ).select2({
			});
			// Data picker
			$( "#dobpicker" ).datepicker({
				dateFormat:"yy-mm-dd",
				showButtonPanel: true,
				changeMonth: true,
				changeYear: true,
				maxDate: "today"
			});
			$( "#dobpicker1" ).datepicker({
				dateFormat:"yy-mm-dd",
				showButtonPanel: true,
				changeMonth: true,
				changeYear: true,
				maxDate: "today"
			});
		 });
 		</script>
		<script>
			$("document").ready(function(){
				 $('#datatablelist').DataTable();
			});
		</script>
		<script>
			$("#guestexportbtn").click(function(){
				var ID = new Array();
				 $('.guestreportid').each(function(){
					 ID.push($(this).val());
				 });
				 $('.guestreportidcollect').val(ID);
			});
		</script>
	</body>
</html>