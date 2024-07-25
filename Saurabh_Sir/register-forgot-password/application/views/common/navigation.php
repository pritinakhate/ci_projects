<?php 
	$date = date('Y-m-d');
	$allnotices = $this->Common_model->GetData("notices","","from_date<='".$date."' and to_date>='".$date."' and status='Active'","created DESC");
?>
<?php
	$allsetting = $this->Common_model->GetData("settings","","","","","","1");
?>
<?php
	$dates = date('Y-m-d');
	$bellnoticecount = $this->Common_model->GetNoticesData("notice_access_logs","id","notice_access_logs.user_id='".$this->session->userdata('id')."' and notice_access_logs.flag='Unread' and notices.from_date<='".$dates."' and notices.to_date>='".$dates."' and notices.status='Active'");
	//print_r($this->db->last_query()); exit();
?>
<div class="col-md-2 col-sm-2 col-xs-6 col-lg-2 red pad"> <?= $allsetting->title;?></div>
<nav class="col-md-10 col-sm-10 col-xs-6 col-lg-10 navbar-default pad-zero" role="navigation">
	<div class="navbar-header">
		<h5 class="white"> &emsp;<?= $allsetting->tagline;?></h5>
	  <button type="button" class="navbar-toggle" data-toggle="collapse" 
		 data-target=".example-navbar-collapse">
		 <span class="sr-only">Toggle navigation</span>
		 <span class="icon-bar"></span>
		 <span class="icon-bar"></span>
		 <span class="icon-bar"></span>
	  </button>
	</div>					   
	<div class="collapse navbar-collapse example-navbar-collapse black">
	   <ul class=" nav navbar-nav navbar-right">
				<!-- notification-->
			<li class="nav-item dropdown no-arrow mx-1" >
				<a class="nav dropdown-toggle btn btn-default" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-bell fa-fw"></i>
					<!-- Counter - Alerts -->
					<?php if($bellnoticecount>0){ ?>
					<span class="label label-danger">
					<?= $bellnoticecount; ?>
					</span>
					<?php } else {
						echo "";
					}?>
				</a>
				<!-- Dropdown - Alerts -->
				<div class="dropdown-menu dropdown-menu-right notice"
					aria-labelledby="alertsDropdown">
					<div class="dropdown-header"><h4 class="text-center"><strong>Notification</strong></h4></div>
					<hr/>
					<ul style="list-style:none;"> 
						<div class="nav navbar">
						<?php foreach($allnotices as $noticerow) { ?>
							<li onclick="window.location='<?= site_url('Notices/bell_notice/'.base64_encode($this->session->userdata('id')));?>'">
								<a class="col-md-12"  style="text-decoration:none;" href="<?= site_url('Notices/userindex');?>">
									<span class="text text-primary"><strong><?= $noticerow->title ;?></strong></span><br/>
									<div class="text-right text-danger">- <?= $this->Common_model->time_ago($noticerow->created) ;?></div>
								</a>
							</li>
						<?php } ?>
						</div>
					</ul>
					<div class="text-center show-all" onclick="window.location='<?= site_url('Notices/bell_notice/'.base64_encode($this->session->userdata('id')));?>'"><a href="<?= site_url('Notices/userindex');?>" style="text-decoration:none; color:blue;">Show All</a></div>
				</div>
			</li>
			<!-- navigation-->
			<li>
			<?php				
				$profilephoto = $this->Common_model->GetData("users","","id = '".$this->session->userdata('id')."'","","","","1");
				if($profilephoto->photo){ ?>
				<img class="img-circle img-responsive profilephoto" src="<?php echo base_url();?>uploads/users_photo/<?= $profilephoto->photo; ?>" width="30px"/>
				<?php  } else if($profilephoto->gender == "Male") { ?>
				<img class="img-circle img-responsive profilephoto" src="<?php echo base_url();?>assets/images/male.jpg" width="30px"/>
				<?php } else if($profilephoto->gender == "Female") {?>
				<img class="img-circle img-responsive profilephoto" src="<?php echo base_url();?>assets/images/female.jpg" width="30px"/>
				<?php } else {?>
				<img class="img-circle img-responsive profilephoto" src="<?php echo base_url();?>assets/images/no-profile.jpg" width="30px"/>
				<?php } ?>
			</li>
			<li>
				<a href="#" class="dropdown-toggle navbar-inverse" data-toggle="dropdown">
				<b class="text text-muted"><?= $this->session->userdata('name'); ?></b>&nbsp; <!--<i class="fa fa-user-plus"></i>--><b class="caret"></b></a>
				<ul class="dropdown-menu">
				   <li><a href="<?= site_url('Users/profile/'.base64_encode($this->session->userdata('token'))); ?>"><i class="fa fa-user-plus"></i> My Profile</a></li>
				   <li class="divider"></li>
				   <li><a href="<?= site_url('Users/changepassword'); ?>"><i class="fa fa-cogs"></i> Change Password</a></li>
				   <li class="divider"></li>
				   <li><a href="<?= site_url('Users/activitylog'); ?>"><i class="fa fa-tasks"></i> Activity Log</a></li>
				   <li class="divider"></li>
				   <li data-toggle="modal"  data-target="#logoutModal">
						<a><i class="fa fa-sign-out"></i> Log Out</a>
				   </li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-lebelledby="logoutModalLabel" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title"><b>Ready to leave?</b>
				</h3>
			</div>
			<div class="modal-body">
				<p>Select "Logout" below if you are ready to end your current session</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="window.location='<?= site_url('Home/logout'); ?>'">Logout</button>
			</div>
		</div>
	</div>
</div>