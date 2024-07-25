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
											<label>Name</label>
											<div>
												<input type="text" name="name" id="name" class="form-control" value="<?= !empty($name)?$name:''; ?>" autocomplete="off"/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">From Date </label><span class="text text-danger"> * <?= form_error('from_date')?></span>
											<div>
												<input type="text" name="from_date" class="form-control" id="from_date" readonly placeholder="Select Your Date" value="<?= !empty($from_date)?$from_date:''; ?>"/>
											</div>
										</div>	
										<div class="form-group">
											<label class="control-label">To Date </label><span class="text text-danger"> * <?= form_error('to_date')?> <span id="errto"> </span></span>
											<div>
												<input type="text" name="to_date" class="form-control" id="to_date" readonly placeholder="Select Your Date" value="<?= !empty($to_date)?$to_date:''; ?>"/>
											</div>
										</div>	
										<div class="form-group">
											<label>Gender</label>
											<div class="push-left">
												<label class="radio-inline">
													<input type="radio" name="gender" class="gender" value="Male" <?= !empty($gender) && $gender=='Male'?'checked':''; ?> /> Male
												</label>
												<label class="radio-inline">
													<input type="radio" name="gender" class="gender" value="Female" <?= !empty($gender) && $gender=='Female'?'checked':''; ?> > Female
												</label>
											</div>
										</div>	
										<div class="form-group">
											<label>Status</label>
											<div class="push-left">
												<label class="radio-inline">
													<input type="radio" name="status" class="status" value="Active" <?= !empty($status) && $status=='Active'?'checked':''; ?> /> Active
												</label>
												<label class="radio-inline">
													<input type="radio" name="status" class="status" value="Block" <?= !empty($status) && $status=='Block'?'checked':''; ?> > Block
												</label>
												<label class="radio-inline">
													<input type="radio" name="status" class="status" value="Pending" <?= !empty($status) && $status=='Pending'?'checked':''; ?> > Pending
												</label>
											</div>
										</div>											
									</div>
									<div class="panel-footer">
										<div>&nbsp; <br/>
											<input type="hidden" id="site_url" value="<?= site_url();?>"/>
											<button type="submit" name="save" id="search" class="btn btn-success btn-sm"><?= $button; ?></button>
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
									<form method="post" action="<?= $export_action; ?>">
										&nbsp;<button type="submit" id="userreportbtn" class="btn btn-primary "><?= $export; ?></button>
										<input type="hidden" class="userreportidcollect" name="userreportidcollect"/>
									</form>
									<br/>
									<br/>
									<table id="datatablelist" class="table table-striped table-bordered ">
										<thead>	
											<tr>
												<td>SR No.</td>
												<td>Name</td>
												<td>Created</td>
												<td>Gender</td>
												<td>Status</td>
											</tr>
										</thead>
										<tbody>
											<?php 
											$i=1;
											foreach($userdata as $user){?> 
											<tr>
											<input type="hidden" class="userreportid" value="<?= $user->id; ?>"/>
												<td><?= $i; ?></td>
												<td><?= $user->name; ?></td>
												<td><?= $user->created; ?></td>
												<td><?= $user->gender; ?></td>
												<td>
													<?php if($user->status == "Active") { ?>
													<span class="label label-success"><?= $user->status; ?></span>
													<?php } else if($user->status == "Block") { ?>
													<span class="label label-danger"><?= $user->status; ?></span>
													<?php } else { ?>
													<span class="label label-warning"><?= $user->status; ?></span>
													<?php } ?>
												</td>
											</tr>
											<?php $i++; }?>
										</tbody>
									</table>
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
		<script type="text/javascript">
		  $("document").ready(function(){
			// Data picker
			$( "#from_date" ).datepicker({
				dateFormat:"yy-mm-dd",
				showButtonPanel: true,
				changeMonth: true,
				changeYear: true,
				maxDate: "today"
			});
			$( "#to_date" ).datepicker({
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
			$("#userreportbtn").click(function(){
				var ID = new Array(); 
				$('.userreportid').each(function(){
					 ID.push($(this).val());
				});
				$('.userreportidcollect').val(ID);
			});
		</script>
	</body>
</html>