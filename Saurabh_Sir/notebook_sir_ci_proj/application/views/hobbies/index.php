<!DOCTYPE html>
<html>
	<head>
      <title><?= $page_title;?></title>
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
										<form method="post" action="<?= $export_action; ?>">
											&nbsp;<button type="submit" class="exportdatabtn" class="btn btn-primary"><?= $export; ?></button>
											<input type="hidden" class="hobbyexportidcollect" name="exportidcollect"/>
										</form>
										<button type="button" class="btn btn-primary pull-right" onclick="window.location='<?= $button_action;?>'"><?= $button; ?></button>
										<br/>
										<br/>										
										<div class="table-responsive">
											<form method="post" action="<?= site_url('Hobbies/deleteall_action');?>">
												<table id="datatablelist" name="datatablelist" class="table table-striped table-bordered">
													<thead>	
														<tr>
															<td><input type="checkbox" name="checkall" onclick="check();"/></td>
															<td>SR No.</td>
															<td>Hobby</td>
															<td>Status</td>
															<td>Action</td>
														</tr>
													</thead>
													<tbody>
														<?php $i=1; foreach($allhobbies as $hobbyrow){?> 
														<tr>
														<input type="hidden" class="hobbyexportid" value="<?= $hobbyrow->id; ?>"/>
														<td><input type="checkbox" name="selector[]" value="<?= base64_encode($hobbyrow->token);?>"/></td>
														<td><?= $i; ?></td>
														<td><?= $hobbyrow->hobby_title; ?></td>
														<td>
															<?php if($hobbyrow->status == "Active") { ?>
															<span class="label label-success"><?= $hobbyrow->status; ?></span>
															<?php } else { ?>
															<span class="label label-danger"><?= $hobbyrow->status; ?></span>
															<?php } ?>
														</td>
														<td>
															<a href="<?= site_url('Hobbies/update/'.base64_encode($hobbyrow->token)); ?>" class="glyphicon glyphicon-edit btn text-primary"></a>
															<a href="<?= site_url('Hobbies/delete_action/'.base64_encode($hobbyrow->token)); ?>" class="glyphicon glyphicon-trash btn text-primary" onclick="return confirm('Do you really want to delete this record?')"></a>
														</td>
														</tr>
														<?php $i++; }?>
													</tbody>
													<tfoot>
														<tr>
															<td colspan="5">
																<button type ="submit" name="deleteall" class="btn btn-danger"onclick="return confirm('Do you really want to delete records?')">Delete</button>
															</td>
														</tr>
													</tfoot>
												</table>
											</form>
											</div>
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
			$('#exportdatabtn').click(function(){
				var ID = new Array();
				$('.hobbyexportid').each(function(){
					ID.push($(this).val());
				});
				$('.hobbyexportidcollect').val(ID);
			});
		</script>
	</body>
</html>

