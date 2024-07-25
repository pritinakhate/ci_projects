<!DOCTYPE html>
<html>
	<head>
      <title><?= $page_title; ?></title>
	  <?php $this->load->view('common/inner-header'); ?>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row" id="menu-row"><!-- first row start-->
				<?php $this->load->view('common/navigation'); ?>
			</div><!-- first row end-->
			<div class="row"><!-- second row start-->
				<div class="col-md-2 col-sm-2 col-xs-12 example-navbar-collapse content new-height">
					<?php $this->load->view('common/left-panel');?>
				</div>
				<div class="col-md-10 col-sm-10 col-xs-12 col-lg-10 new-height">
					<div class="row" >
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box">
							<div class="panel panel-default">						
								<div class=" panel-heading">
									  <h3 class="panel-title"><?= $record; ?></h3>
								</div>
								<div class="panel-body">  
									<div>
									<br/>
										<div class="form-group">
											<label>Country</label><span class="text text-danger"> * <?= form_error('country_id')?></span> 
											<div>
												<select name="country_id" id="country_id" class="form-control selectSearch">
												<option value="">-- Select Country --</option>
												<?php foreach($countrylist as $countrydata){ ?>
													<option value="<?= $countrydata->id; ?>"<?= !empty($country_id) && ($country_id==$countryrow->id)?'selected':''; ?>><?= $countrydata->country_name; ?></option>
												<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label>State</label><span class="text text-danger"> * <?= form_error('state_id'); ?></span> 
											<div>
												<select name="state_id" id="state_id" class="form-control">
												</select>
											</div>
										</div>
										<div class="form-group">
											<label>City</label><span class="text text-danger"> * <?= form_error('city_id'); ?></span>
											<div >
												<select name="city_id" id="city_id" class="form-control">
												</select>
											</div>
										</div>							
									</div>
								</div>
								<div class="panel-footer"> 
									<div>&nbsp; <br/>
										<input type="hidden" id="site_url" value="<?= site_url();?>"/>
										<button type="button" name="cancel" class="btn btn-danger btn-sm" onclick="window.location='<?= $cancel_action; ?>'"><?= $cancel; ?></button>
									</div>
								</div>
							</div>
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
	 	<?php $this->load->view('common/script'); ?>
		<script>
			$("document").ready(function(){
				$("#country_id").change(function(){
					var site_url = $('#site_url').val();
					var country_id = $('#country_id').val();
					var datastring = "country_id="+country_id; 
					$.ajax({
						type: 'post',
						url: site_url+'/Cscdropdown/dropdown',
						data:datastring,
						cache:false,
						success:function(response)
						{
							//alert(response);
							$('#state_id').html(response);
						}
						
						
					});
				});
				
				$("#state_id").change(function(){
					var site_url = $('#site_url').val();
					var state_id = $('#state_id').val();
					var datastring = "state_id="+state_id; 
					$.ajax({
						type: 'post',
						url: site_url+'/Cscdropdown/dropdown',
						data:datastring,
						cache:false,
						success:function(response)
						{
							//alert(response);
							$('#city_id').html(response);
						}
						
						
					});
				});
			});
		</script>
	</body>
</html>