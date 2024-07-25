<!DOCTYPE html>
<html>
	<head>
      <title><?= $page_title; ?></title>
	  <?php $this->load->view('common/inner-header'); ?>
	</head>
	<body>
		<div class="container-fluid"> <!-- Container start -->
			<div class="row" id="menu-row"><!-- first row start-->
				<?php $this->load->view('common/navigation'); ?>
			</div><!-- first row end-->
			<div class="row"><!-- second row start-->
				<div class="col-md-2 col-sm-2 col-xs-12 example-navbar-collapse content height" > <!-- Left Pannel start -->
					<?php $this->load->view('common/left-panel');?>
				</div><!-- Left Pannel End -->
				<div class="col-md-10 col-sm-10 col-xs-12 col-lg-10 height"> <!-- Right Pannel start -->
				<div><h2><?= $screen;?></h2> <hr/></div>
							<div class="row">
								<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h3 class="panel-title"><?= $records; ?></h3>
										</div>
										<div class="panel-body">
											<div class="table-responsive">
												<table class="table table-striped table-bordered">	
												<?php foreach($userdata as $alluser) { ?>
													<tr>
														<td>Name</td>
														<td><?= $alluser->name; ?></td>
													</tr>
													<tr>
														<td>Email Address</td>
														<td><?= $alluser->email_address; ?></td>
													</tr>
													<tr>
														<td>Date Of Birth</td>
														<td><?= $alluser->dob; ?></td>
													</tr>
													<tr>
														<td>Gender</td>
														<td><?= $alluser->gender; ?></td>
													</tr>
													<tr>
														<td>Photo</td>
														<td><img src="<?= base_url('/uploads/users_photo/'.$alluser->photo);?>" alt="photo"  width="50px"/></td>
													</tr>
													<tr>
														<td>role</td>
														<td><?= $alluser->role; ?></td>
													</tr>
													<tr>
														<td>Status</td>
														<td><?= $alluser->status; ?></td>
													</tr>
													<?php } ?>
												</table>
											</div>
										</div>
										<div class="panel-footer">
											<button type="button" name="cancel" class="btn btn-danger btn-sm" onclick="window.location='<?= $cancel_action; ?>'"><?= $cancel; ?></button>
										</div>
									</div>			
								</div> <!--First table Ends -->
							</div>	
				</div><!-- Right Pannel End -->
			</div> <!-- second row end-->
			<div class="row"><!-- Footer Start  -->
				<?php $this->load->view('common/footer')?>
			</div> <!-- Footer End  -->
		</div>
	    <?php $this->load->view('common/script'); ?>
	</body>
</html>

