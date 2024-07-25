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
					<div><h2><?= $screen; ?> </h2> <hr/></div>
							<div class="row">
								<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h3 class="panel-title"><?= $records; ?></h3>
										</div>
										<div class="panel-body">
										<div class="table-responsive">
											<table id="datatablelist" class="table table-striped table-bordered">
												<thead>	
													<tr>
														<td class="col-md-1">SR No.</td>
														<td class="col-md-2">User Login</td>
														<td class="col-md-2">User Logout</td>
														<td class="col-md-2">IP Address</td>
														<td class="col-md-3">Access Details</td>
														<td class="col-md-3">Daily Log</td>
													</tr>
												</thead>
												<tbody>
													<?php $sr=1; foreach($allactivitylog as $activityrow){?> 
													<tr>
														<td><?= $sr; ?></td>
														<td><?= $activityrow->start_login; ?></td>
														<td><?= $activityrow->end_login; ?></td>
														<td><?= $activityrow->ip_address; ?></td>
														<td><?= $activityrow->access_details; ?></td>
														<td><?= $activityrow->user_count; ?><a href="<?= site_url('Users/daily_log/'.base64_encode($activityrow->start_login))?>">&ensp;Click Here</a></td>
													</tr>
													<?php $sr++; } ?>
												</tbody>
											</table>
											</div>
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
		<script>
			$("document").ready(function(){
				 $('#datatablelist').DataTable();
			});
		</script>
	</body>
</html>

