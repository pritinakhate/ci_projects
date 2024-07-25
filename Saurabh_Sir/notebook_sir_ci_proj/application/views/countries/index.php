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
										<form method="post" action="<?= $export_action; ?>" >
											&nbsp;<button type="submit" id="countryexportbtn" class="btn btn-primary "><?= $export; ?></button>
											<input type="hidden" class="countryidcollect" name="countryidcollect"/>
										</form>
										<button type="button" class="btn btn-primary pull-right" onclick="window.location='<?= $button_action; ?>'"><?= $button?></button>
										<br/>
										<br/>										
										<div class="table-responsive">
										<form method="post" action="<?= site_url('Countries/deleteall_action'); ?>">
											<table id="datatablelist" class="table table-striped table-bordered">
												<thead>	
													<tr>
														<td><input type="checkbox" name="checkall" onclick="check();"/></td>
														<td>SR No.</td>
														<td>Country Name</td>
														<td>Country Code</td>
														<td>Country Flag</td>
														<td>Status</td>
														<td>Action</td>
													</tr>
												</thead>
												<tbody>
													<?php $i=1; foreach($allcountries as $countryrow){?> 
													<tr>
													<input type="hidden" class="countryid" value="<?= $countryrow->id; ?>"/>
													<td><input type="checkbox" name="selector[]" value="<?= base64_encode($countryrow->token)?>"/></td>
													<td><?php echo $i; ?></td>
													<td><?= $countryrow->country_name; ?></td>
													<td><?= $countryrow->country_code; ?></td> 
													<td><img src="<?= base_url();?>uploads/country_flag_img/<?= $countryrow->country_flag ?>" width="50px"/></td> 
													<td>
														<?php if($countryrow->status=="Active") { ?>
															<span class="label label-success"><?= $countryrow->status;?></span>
														<?php } else { ?>
															<span class="label label-danger"><?= $countryrow->status;?></span>
														<?php } ?>
													</td>
													<td>
														<a href="<?= site_url('Countries/update/'.base64_encode($countryrow->token)); ?>" class="glyphicon glyphicon-edit btn text-primary"></a>
														<a href="<?= site_url('Countries/delete_action/'.base64_encode($countryrow->token)); ?>" class="glyphicon glyphicon-trash btn text-primary" onclick="return confirm('Do you really want to delete this record')"></a>
													</td>
													</tr>
													<?php $i++; }?>
												</tbody>
												<tfoot>
													<tr>
														<td colspan="7">
															<button type ="submit" name="deleteall" class="btn btn-danger" onclick="return confirm('Do you really want to delete this records')">Delete</button>
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
			$('#countryexportbtn').click(function(){
				var ID = new Array();
				$('.countryid').each(function(){
					ID.push($(this).val());
				});
				$('.countryidcollect').val(ID);
			});
		</script>
	</body>
</html>

