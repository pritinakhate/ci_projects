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
					<div><h2><?= $screen; ?></h2> <hr/></div>
							<div class="row">
								<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h3 class="panel-title"><?= $records; ?></h3>
										</div>
										<div class="panel-body">
										&nbsp;<button type="button" class="btn btn-primary " onclick="window.location='<?= $export_action?>'"><?= $export; ?></button>
										<br/>
										<br/>
										<div class="table-responsive">
										<form method="post" action= "<?= $action;?>">
											<table id="datatablelist" class="table table-striped table-bordered">
												<thead>	
													<tr>
														<td><input type="checkbox" name="checkall" onclick="check()"/></td>
														<td>SR No.</td>
														<td class="col-md-2">Name</td>
														<td class="col-md-2">Email Address</td>
														<td>Total Guest</td>
														<td>Male Guest</td>
														<td>Female Guest</td>
														<td>Status</td>
														<td class="col-md-2">Reg. On</td>
														<td class="col-md-2">Action</td>
													</tr>
												</thead>
												<tbody>
													<?php $sr=1; foreach($allusers as $row){?> 
													<tr>
														<td><input type="checkbox" name="selector[]" value="<?= base64_encode($row->token);?>"/></td>
														<td><?= $sr; ?></td>
														<td><?= $row->name; ?></td>
														<td><?= $row->email_address; ?></td>
														<td>
														<?php if($this->Users_model->GetTotalCount($row->id)>0){ ?>
														<a href="<?= site_url("Guests/totalguestbyuser/".base64_encode($row->id));?>" class="text-primary"><?= $this->Users_model->GetTotalCount($row->id); ?></a>
														<?php } else{?>
														<div class="text text-danger"><?= $this->Users_model->GetTotalCount($row->id); ?></div>
														<?php } ?>
														</td>
														<td>
														<?php if($this->Users_model->GetMaleCount($row->id)>0){ ?>
														<a href="<?= site_url("Guests/maleguestbyuser/".base64_encode($row->id));?>" class="text-primary"><?= $this->Users_model->GetMaleCount($row->id); ?></a>
														<?php } else {?>
														<div class="text text-danger"><?= $this->Users_model->GetMaleCount($row->id); ?></div>
														<?php } ?>
														</td>
														<td>
														<?php if($this->Users_model->GetFemaleCount($row->id)>0){ ?>
														<a href="<?= site_url("Guests/femaleguestbyuser/".base64_encode($row->id));?>" class="text-primary"><?= $this->Users_model->GetFemaleCount($row->id); ?></a>
														<?php } else {?>
														<div class="text text-danger"><?= $this->Users_model->GetFemaleCount($row->id); ?>
														<?php } ?></div>
														</td>
														<td>
															<?php if($row->status == "Active") { ?>
															<span class="label label-success"><?= $row->status; ?></span>
															<?php } else if($row->status == "Block") { ?>
															<span class="label label-danger"><?= $row->status; ?></span>
															<?php } else { ?>
															<span class="label label-warning"><?= $row->status; ?></span>
															<?php } ?>
														</td>
														<td><?= $this->Users_model->time_ago($row->created); ?></td>
														<td>
															<a href="<?= site_url('Users/users_view/'.base64_encode($row->token));?>" class="glyphicon glyphicon-search btn text-primary"></a>
															<a href="<?= site_url('Users/users_update/'.base64_encode($row->token));?>" class="glyphicon glyphicon-edit btn text-primary"></a>
															<a href="<?= site_url('Users/users_delete/'.base64_encode($row->token));?>" class="glyphicon glyphicon-trash btn text-primary" onclick="return confirm('Do you really want to delete this record')"></a>
														</td>
													</tr>
													<?php $sr++; } ?>
												</tbody>
												<tfoot>
													<tr>
														<td colspan="10">
															<button type ="submit" name="deleteall" class="btn btn-danger" onclick="return confirm('Do you really want to delete records');">Delete</button>
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

