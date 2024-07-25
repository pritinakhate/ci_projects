<!DOCTYPE html>
<html>
	<head>
      <title><?= $page_title;?></title>
	  <?php $this->load->view('common/head'); ?>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row" id="menu-row"><!-- first row start -->
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
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 box">
							<form method="post" action="<?= $action; ?>">
								<div class="panel panel-default">
										<div class=" panel-heading">
										  <h3 class="panel-title"><?= $forgotpasswordheading; ?></h3>
										</div>
										<div class="panel-body">
											<?php  if(!empty($massage)) { ?>
												<div class="alert alert-danger">
													<?= $massage; ?>
												</div>
											<?php } ?>	
											<div class="form-group">
												<label>Email Address</label><span class="text text-danger"> * <?= form_error('email_address'); ?></span>
												<div>
													<input type="text" name="email_address" class="form-control" id="email_address" autocomplete="off" value="<?= isset($email_address) && !empty($email_address)?$email_address:''; ?>"/>
												</div>
											</div>	
										</div>
										<div class="panel-footer">
											<div>&nbsp; <br/>
												<input type="hidden" id="site_url" value="<?= site_url();?>"/>
												<button type="submit" class="btn btn-success btn-sm"><?=$button; ?></button>
												<button type="button" class="btn btn-danger btn-sm" onclick="window.location='<?= $cancel_action; ?>'"><?= $cancel; ?></button>
											</div>
										</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div> <!-- Second row end-->
			<!-- Footer Start  -->
			<div class="row">
				<?php $this->load->view('common/footer')?>
			</div> 
			<!-- Footer End  -->
		</div>
		<?php $this->load->view('common/outer-script'); ?>
	</body>
</html>