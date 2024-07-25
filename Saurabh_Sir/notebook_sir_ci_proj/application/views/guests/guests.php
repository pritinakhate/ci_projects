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
					<div><h2><?= $screen;?></button></h2> <hr/></div>
							<div class="row">
								<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h3 class="panel-title"><?= $records; ?></h3>
										</div>
										<div class="panel-body">
										<div class="table-responsive">
										<form method="post" action="<?= site_url('Guests/deleteall_action'); ?>">
											<table id="datatablelist" class="table table-striped table-bordered">
												<thead>	
													<tr>
														<td><input type="checkbox" name="checkall" onclick="check()"/></td>
														<td>SR No.</td>
														<td>User</td>
														<td>Name</td>
														<td>Email Address</td>
														<td>Address</td>
														<td>Gender</td>
														<td>Status</td>
														<td>Reg. On</td>
														<td>Action</td>
													</tr>
												</thead>
												<tbody>
													<?php 
													$i=1;
													foreach($allguests as $guestrow){?> 
													<tr>
														<td><input type="checkbox" name="selector[]" value="<?= base64_encode($guestrow->token);?>"/></td>
														<td><?= $i; ?></td>
														<td><?= $guestrow->username; ?></td>
														<td><?= $guestrow->name; ?></td>
														<td><?= $guestrow->email_address; ?></td>
														<td><?= $guestrow->address; ?></td>
														<td><?= $guestrow->gender; ?></td>
														<td>
															<?php if($guestrow->status == "Active") { ?>
															<span class="label label-success"><?= $guestrow->status; ?></span>
															<?php } else if($guestrow->status == "Block") { ?>
															<span class="label label-danger"><?= $guestrow->status; ?></span>
															<?php } else { ?>
															<span class="label label-warning"><?= $guestrow->status; ?></span>
															<?php } ?>
														</td>
														<td><?= $this->Guests_model->time_ago($guestrow->created); ?></td>
														<td>
															<a href="<?= site_url('Guests/view_action/'.base64_encode($guestrow->token));?>" class="glyphicon glyphicon-search btn text-primary"></a>
															<a href="<?php echo site_url('Guests/update/'.base64_encode($guestrow->token));?>" class="glyphicon glyphicon-edit btn text-primary"></a>
															<a href="<?= site_url('Guests/delete_action/'.base64_encode($guestrow->token)); ?>" class="glyphicon glyphicon-trash btn text-primary" onclick="return confirm('Do you really want to delete this record')"></a>
														</td>
													</tr>
													<?php $i++; }?>
												</tbody>
												<tfoot>
													<tr>
														<td colspan="10">
															<button type ="submit" name="deleteall" class="btn btn-danger" onclick="return confirm('Do you really want to delete records');">Delete</button>
															<button type ="button" name="back" class="btn btn-info"onclick="window.location='<?= site_url("Users/users_manage");?>';">Back</button>
														</td>
													</tr>
												</tfoot>
											</table>
											</form>
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

