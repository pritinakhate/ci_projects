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
										<?php if($this->session->userdata('role')=="Admin") { ?> 
										&nbsp;<button type="button" class="btn btn-primary " onclick="window.location='<?= $export_action?>'"><?= $export; ?></button>
										<button type="button" class="btn btn-primary pull-right" onclick="window.location='<?= $button_action; ?>'"><?= $button; ?></button>
										<?php } ?> 
										<br/>
										<br/>
										<div class="table-responsive">
										<form method="post" action="<?= site_url('Notices/deleteall_action')?>">
											<table id="datatablelist" class="table table-striped table-bordered">
												<thead>	
													<tr>
														<?php if($this->session->userdata('role')=="Admin"){ ?>
														<td><input type="checkbox" name="checkall" onclick="check()"/></td>
														<?php } ?>
														<td>SR No.</td>
														<td>Title</td>
														<td>Content</td>
														<?php if($this->session->userdata('role')=="Admin"){ ?>
														<td>From Date</td>
														<td>To Date</td>
														<td>Status</td>
														<?php } ?>
														<td>Created</td>
														<?php if($this->session->userdata('role')=="Admin"){ ?>
														<td>Action</td>
														<?php } ?>
													</tr>
												</thead>
												<tbody>
													<?php $i=1; foreach($allnotices as $noticerow){?> 
													<tr>
													<?php if($this->session->userdata('role')=="Admin"){ ?>
													<td><input type="checkbox" name="selector[]" value="<?= base64_encode($noticerow->token); ?>"/></td>
													<?php } ?>
													<td><?=$i; ?></td>
													<td><?=  $noticerow->title; ?></td>
													<td><?=  $noticerow->content; ?></td>
													<?php if($this->session->userdata('role')=="Admin"){ ?>
													<td><?=  $noticerow->from_date; ?></td>
													<td><?=  $noticerow->to_date; ?></td>
													<td>
														<?php if($noticerow->status == "Active") { ?>
														<span class="label label-success"><?= $noticerow->status; ?></span>
														<?php } else { ?>
														<span class="label label-danger"><?= $noticerow->status; ?></span>
														<?php } ?>
													</td>
													<?php } ?>
													<td><?=  $this->Notices_model->time_ago($noticerow->created); ?></td>
													<?php if($this->session->userdata('role')=="Admin"){ ?>
													<td>
														<a href="<?= site_url('Notices/update/'.base64_encode($noticerow->token)); ?>" class="glyphicon glyphicon-edit btn text-primary"></a>
														<a href="<?= site_url('Notices/delete_action/'.base64_encode($noticerow->token)); ?>" class="glyphicon glyphicon-trash btn text-primary" onclick="return confirm('Do you really want to delete this record?')"></a>
													</td>
													<?php } ?>
													</tr>
													<?php $i++; }?>
												</tbody>
												<tfoot>
												<?php if($this->session->userdata('role')=="Admin"){ ?>
													<tr>
														<td colspan="9">
															<button type ="submit" name="deleteall" class="btn btn-danger" onclick="return confirm('Do you really want to delete this records')">Delete</button>
														</td>
													</tr>
												<?php } ?>
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

