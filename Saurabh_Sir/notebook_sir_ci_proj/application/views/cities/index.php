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
					<div><h2><?= $screen; ?><hr/></div>
					<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title"><?= $records; ?></h3>
								</div>
								<div class="panel-body">
								<form method="post" action="<?= $export_action?>">
									&nbsp;<button type="submit" id="cityidbtn" class="btn btn-primary "><?= $export; ?></button>
									<input type="hidden" class="cityidcollect" name="cityidcollect"/>
								</form>
								<button type="button" class="btn btn-primary pull-right" onclick="window.location='<?= $button_action; ?>'"><?= $button; ?></button> 
								<br/>
								<br/>
								<div class="table-responsive">
								<form method="post" action="<?= site_url('Cities/deleteall_action')?>">
									<table id="datatablelist" class="table table-striped table-bordered">
										<thead>	
											<tr>
												<td><input type="checkbox" name="checkall" onclick="check();"/></td>
												<td>SR No.</td>
												<td>State Name</td>
												<td>City Name</td>
												<td>Status</td>
												<td>Action</td>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; foreach($allcities as $cityrow){?> 
											<tr>
											<input type="hidden" class="cityid" value="<?= $cityrow->id; ?>"/>
											<td><input type="checkbox" name="selector[]" value="<?= base64_encode($cityrow->token); ?>"/></td>
											<td><?php echo $i; ?></td>
											<td><?= $cityrow->state_name; ?></td>
											<td><?= $cityrow->city_name; ?></td>
											<td>
												<?php if($cityrow->status=="Active") { ?>
													<span class="label label-success"><?= $cityrow->status;?></span>
												<?php } else { ?>
													<span class="label label-danger"><?= $cityrow->status;?></span>
												<?php } ?>
											</td>
											<td>
												<a href="<?= site_url('Cities/update/'.base64_encode($cityrow->token)); ?>" class="glyphicon glyphicon-edit btn text-primary"></a>
												<a href="<?= site_url('Cities/delete_action/'.base64_encode($cityrow->token)); ?>" class="glyphicon glyphicon-trash btn text-primary" onclick="return confirm('Do you really want to delete this record?')"></a>
											</td>
											</tr>
											<?php $i++; }?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="6">
													<button type ="submit" name="deleteall" class="btn btn-danger"onclick="return confirm('Do you really want to delete this records')">Delete</button>
												</td>
											</tr>
										</tfoot>
									</table>
									</form>
									</div>
								</div>
								<div class="panel-footer">
									
								</div>
							</div>			
						</div> <!--First table Ends -->
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 box">
								<form method="post" action="<?= $importdata; ?>" enctype="multipart/form-data">
									<div class="panel panel-default">						
										<div class=" panel-heading">
											  <h3 class="panel-title"><?= $record; ?></h3>
										</div>
										<div class="panel-body">  
											<div class="form-group">
												<label>Select Excel File </label>
												<div>
													<input type="file" name="file" id="file" class="form-control"/>
												</div>
											</div>	
										</div>	
										<div class="panel-footer">
											<div>&nbsp; <br/>
												<button type="submit" name="upload" value="upload" class="btn btn-success btn-sm"><?= $importbutton;?></button>
												<button type="button" class="btn btn-default btn-sm pull-right" onclick="window.location='<?= $sample; ?>'"><?= $samplebutton;?></button>
											</div>
										</div>									
									</div>
								</form>
								</div>
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
		<script>
			$("#cityidbtn").click(function(){
				var ID = new Array();
				 $('.cityid').each(function(){
					 ID.push($(this).val());
				 });
				 $('.cityidcollect').val(ID);
			});
		</script>
	</body>
</html>

