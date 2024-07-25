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
											<table id="datatablelist" class="table table-striped table-bordered">
												<thead>	
													<tr>
														<td>SR No.</td>
														<td>Guest Id</td>
														<td>Name</td>
														<td>Email Address</td>
														<td>Address</td>
														<td>About Guest</td>
														<td>Date Of Birth</td>
														<td>Gender</td>
														<td>Country</td>
														<td>State</td>
														<td>City</td>
														<td>Hobby</td>
														<td>Status</td>
														<td>Created</td>
													</tr>
												</thead>
												<tbody>
													<?php 
													$j=1;
													foreach($allguestslog as $guestlog){ ?> 
													<tr>
														<td><?= $j; ?></td>
														<td><?= $guestlog->guest_id; ?></td>
														<td><?= $guestlog->name; ?></td>
														<td><?= $guestlog->email_address; ?></td>
														<td><?= $guestlog->address; ?></td>
														<td><?= $guestlog->details_about_guest; ?></td>
														<td><?= $guestlog->dob; ?></td>
														<td><?= $guestlog->gender; ?></td>
														<td><?= $guestlog->country_name; ?></td>
														<td><?= $guestlog->state_name; ?></td>
														<td><?= $guestlog->city_name; ?></td>
														<td><?php
																$allhobbyid = $guestlog->hobby_id;
																$gethobby = explode(",",$allhobbyid);
																$hobbycount= count($gethobby);
																for($i=0;$i<$hobbycount;$i++)
																{
																	$hobbycollect= $this->Guests_model->GetData("Hobbies","hobby_title","id= '".$gethobby[$i]."'","","hobby_title","","");
																	foreach($hobbycollect as $hobbyrow)
																	{
																		echo $hobbyrow->hobby_title; 
																	}
																	if($i<$hobbycount-1)
																	{
																		echo ", ";
																	}
																}
															?></td>
														<td>
															<?php if($guestlog->status == "Active") { ?>
															<span class="label label-success"><?= $guestlog->status; ?></span>
															<?php } else if($guestlog->status == "Block") { ?>
															<span class="label label-danger"><?= $guestlog->status; ?></span>
															<?php } else { ?>
															<span class="label label-warning"><?= $guestlog->status; ?></span>
															<?php } ?>
														</td>
														<td><?= $this->Guests_model->time_ago($guestlog->created); ?></td>
													</tr>
													<?php $j++; }?>
												</tbody>
												<tfoot>
													<tr>
														<td colspan="14">
															<button type="button" name="cancel" class="btn btn-danger btn-sm" onclick="window.location='<?= $cancel_action; ?>'"><?= $cancel; ?></button>
														</td>
													</tr>
												</tfoot>
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

