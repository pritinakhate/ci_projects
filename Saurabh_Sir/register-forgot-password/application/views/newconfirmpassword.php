<!DOCTYPE html>
<html>
	<head>
      <title><?= $page_title; ?></title>
	  <?php $this->load->view('common/head'); ?>
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
				<div class="col-md-2 col-sm-2 col-xs-12 example-navbar-collapse content new-height">
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
										<div class="form-group">
											<label>New Password</label><span class="text text-danger"> * <?= form_error('password'); ?></span>
											<div>
												<input type="password" name="password" class="form-control"/>
											</div>
										</div>
										<div class="form-group">
											<label>Repeat Password</label><span class="text text-danger"> * <?= form_error('repeatpassword'); ?> </span>
											<div>
												<input type="password" name="repeatpassword" class="form-control"/>
											</div>
										</div>
									<div class="panel-footer">
										<div>&nbsp; <br/>
											<button type="submit" class="btn btn-success btn-sm"><?= $button; ?></button>
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