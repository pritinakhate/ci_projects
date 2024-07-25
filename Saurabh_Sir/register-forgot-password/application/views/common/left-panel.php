<div class="black pad">
		<?php 
		$profilephoto = $this->Common_model->GetData("users","","id = '".$this->session->userdata('id')."'","","","","1");
 		if($profilephoto->photo){ ?>
		<img class="img-circle img-responsive outer-border" src="<?php echo base_url();?>uploads/users_photo/<?= $profilephoto->photo; ?>"/>
		<?php  } else if($profilephoto->gender == "Male") { ?>
		<img class="img-circle img-responsive outer-border" src="<?php echo base_url();?>assets/images/male.jpg"/>
		<?php } else if($profilephoto->gender == "Female") {?>
		<img class="img-circle img-responsive outer-border" src="<?php echo base_url();?>assets/images/female.jpg" />
		<?php } else {?>
		<img class="img-circle img-responsive outer-border" src="<?php echo base_url();?>assets/images/no-profile.jpg"/>
		<?php } ?>
</div>
<div class="navbar left-menu">
	<ul class="nav nav-tabs nav-stacked">
		<li> 
			<h4 class="text-center "> 
			<?php 
				echo "<b>".$this->session->userdata('name')."</b>";
			?>
			</h4>
		</li>
		<hr class="sidehr"/>
		<li <?php echo $this->uri->segment(1)=='Users' && $this->uri->segment(2)=='index'?'class="left-active"':''; ?>><a href="<?php echo site_url('Users/index'); ?>" ><i class="fa fa-tachometer"></i> Dashboard</a></li>
		
		<li <?php echo ($this->uri->segment(1)=='Guests' && $this->uri->segment(2)=='index') || ($this->uri->segment(1)=='Guests' && $this->uri->segment(2)=='create') || ($this->uri->segment(1)=='Guests' && $this->uri->segment(2)=='create_action')?'class="left-active"':''; ?>><a href="<?php echo site_url('Guests/index'); ?>"><i class="fa fa-venus"></i> Manage Guests</a></li>
		
		<?php if($this->session->userdata('role') == "Admin"){ ?>
		
		<li <?php echo ($this->uri->segment(1)=='Users' && $this->uri->segment(2)=='users_manage') || ($this->uri->segment(1)=='Users' && $this->uri->segment(2)=='create') || ($this->uri->segment(1)=='Users' && $this->uri->segment(2)=='create_action')?'class="left-active"':''; ?>><a href="<?php echo site_url('Users/users_manage'); ?>"><i class="fa fa-sitemap"></i> Manage Users</a></li>
		<hr class="sidehr"/>
		<li class="text-center"><b>MASTERS</b></li>
		<li <?php echo($this->uri->segment(1)=='Countries' && $this->uri->segment(2)=='index')||($this->uri->segment(1)=='Countries' && $this->uri->segment(2)=='create') || ($this->uri->segment(1)=='Countries' && $this->uri->segment(2)=='create_action')?'class="left-active"':''; ?>><a href="<?php echo site_url('Countries/index'); ?>"><i class="fa fa-globe"></i> Manage Countries</a></li>
		
		<li <?php echo ($this->uri->segment(1)=='States' && $this->uri->segment(2)=='index') || ($this->uri->segment(1)=='States' && $this->uri->segment(2)=='create') || ($this->uri->segment(1)=='States' && $this->uri->segment(2)=='create_action')?'class="left-active"':''; ?>><a href="<?php echo site_url('States/index'); ?>"><i class="fa fa-map-marker"></i> Manage States</a></li>
		
		<li <?php echo ($this->uri->segment(1)=='Cities' && $this->uri->segment(2)=='index') || ($this->uri->segment(1)=='Cities' && $this->uri->segment(2)=='create') || ($this->uri->segment(1)=='Cities' && $this->uri->segment(2)=='create_action')?'class="left-active"':''; ?>><a href="<?php echo site_url('Cities/index'); ?>"><i class="fa fa-bolt" ></i> Manage Cities</a></li>
		
		<li <?php echo ($this->uri->segment(1)=='Hobbies' && $this->uri->segment(2)=='index') || ($this->uri->segment(1)=='Hobbies' && $this->uri->segment(2)=='create') || ($this->uri->segment(1)=='Hobbies' && $this->uri->segment(2)=='create_action')?'class="left-active"':''; ?>><a href="<?php echo site_url('Hobbies/index'); ?>"><i class="fa fa-bookmark"></i> Manage Hobbies</a></li>
		
		<li <?php echo ($this->uri->segment(1)=='Notices' && $this->uri->segment(2)=='index') || ($this->uri->segment(1)=='Notices' && $this->uri->segment(2)=='create') || ($this->uri->segment(1)=='Notices' && $this->uri->segment(2)=='create_action')?'class="left-active"':''; ?>><a href="<?php echo site_url('Notices/index'); ?>"><i class="fa fa-bell"></i> Manage Notices</a></li>
		<?php } ?>
		<li class="dropdown" <?php echo ($this->uri->segment(1)=='Reports' && $this->uri->segment(2)=='search_user') || ($this->uri->segment(1)=='Reports' && $this->uri->segment(2)=='search_guest')?'class="left-active"':''; ?>><a  class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-sticky-note"></i> Report <i class="fa fa-caret-down"></i></a> 
		<ul class="dropdown-menu pull-right">
			<?php if($this->session->userdata('role')=="Admin"){?>
			<li><a href="<?php echo site_url('Reports/search_user'); ?>" >&nbsp; User Report</a></li>
			<li class='divider'></li>
			<?php } ?>
			<li><a href="<?php echo site_url('Reports/search_guest'); ?>" >&nbsp; Guest Report</a></li>
		</ul>
		</li>	
		<li><a href="<?php echo site_url('Cscdropdown/index'); ?>" >&nbsp; Customize CSC Dropdown</a></li>
		<hr class="sidehr"/>
		<?php if($this->session->userdata('role')=="Admin"){?>
		<li <?php echo ($this->uri->segment(1)=='Settings' && $this->uri->segment(2)=='index') || ($this->uri->segment(1)=='Settings' && $this->uri->segment(2)=='update')?'class="left-active"':''; ?>>
			<a class="nav-link" href="<?php echo site_url('Settings/index'); ?>">
				<i class="fas fa-fw fa-cog"></i>
				<span>Manage Settings</span>
			</a>
		</li>
		<?php } ?>
		
	</ul>
</div>