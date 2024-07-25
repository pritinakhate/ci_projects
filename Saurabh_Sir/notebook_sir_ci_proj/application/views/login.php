<!DOCTYPE html>
<html>
	<head>
      <title><?= $page_title;?></title>
	  <?php $this->load->view('common/head');?>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row" id="menu-row"><!-- first row start-->
				<div class="col-md-2 col-sm-2 col-xs-6 col-lg-2 red pad"><?= $heading;?></div>
				<nav class="col-md-10 col-sm-10 col-xs-6 col-lg-10 navbar-default black nav-pad" role="navigation">
				   &nbsp;				   
				</nav>
			</div><!-- first row end-->
			<div class="row"><!-- second row start-->
				<div class="col-md-2 col-sm-2 col-xs-12 example-navbar-collapse content new-height invisibility">
					&nbsp;
				</div>
				<div class="col-md-10 col-sm-10 col-xs-12 col-lg-10 new-height">
					<div><h2><?= $screen;?></h2><hr/></div>
					<div class="row" >
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 box">
						<?php $logo= $this->Common_model->GetData("settings","logo","","","","","1"); ?>
						<div class="text-center">
						<img src="<?= base_url();?>uploads/settings_photo/<?= $logo->logo ?>" width="290px"/>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 box">
							<form method="post" action="<?= $action; ?>">
								<div class="panel panel-default">
									<div class="panel-heading">
									  <h3 class="panel-title"><?= $loginheading; ?></h3>
									</div>
									<div class="panel-body">
									<?php  if($this->session->flashdata('warn')) { ?>
											<div class="alert alert-warning">
												<?= $this->session->flashdata('warn'); ?>
											</div>
										<?php } ?>	
										
										<?php  if($this->session->flashdata('massage')) { ?>
											<div class="alert alert-danger">
												<?= $this->session->flashdata('massage'); ?>
											</div>
										<?php } ?>



										<?php  if(!empty($massage)) { ?>
											<div class="alert alert-danger">
												<?= $massage; ?>
											</div>
										<?php } ?>
										<?php  if(!empty($pendingwarn)) { ?>
											<div class="alert alert-warning">
												<?= $pendingwarn; ?>
											</div>
										<?php } ?>
										<?php  if($this->session->flashdata('save')) { ?>
											<div class="alert alert-success">
												<?= $this->session->flashdata('save'); ?>
											</div>
										<?php } ?>
																		
										<div class="form-group">
											<label>Email Address</label><span class="text text-danger"> * <?= form_error('email_address'); ?> </span>
											<div>
												<input type="text" name="email_address"  class="form-control" value="<?= !empty($email_address)?$email_address:''; ?>" autocomplete="off"/>
											</div>
										</div>
										<div class="form-group">
											<label>Password</label><span class="text text-danger"> * <?= form_error('password'); ?></span> 
											<div>
												<input type="password" name="password" class="form-control"/>
											</div>
										</div>
									</div>
									<div class="panel-footer">
										<div>&nbsp; <br/>
											<button type="submit" class="btn btn-success btn-sm"><?= $login_button; ?></button>

											<button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?= $register_button_action; ?>'" ><?=$register_button; ?></button>
											
											 <button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?= $forgot_password_button_action; ?>'" ><?= $forgot_password_button; ?></button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div> <!-- second row end-->
			<div class="row"><!-- Footer Start  -->
				<?php $this->load->view('common/footer')?>
			</div> <!-- Footer End  -->
		</div>
		<?php $this->load->view('common/outer-script'); ?>
	</body>
</html>

