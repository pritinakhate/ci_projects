<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<!-- Include all compiled plugins as needed -->
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<!-- Extraction of external javascreept -->
	<script src="<?php echo base_url();?>assets/js/main.js"></script>
	<script type="text/javascript">
				$("document").ready(function(){
				setInterval(function(){
					$.ajax({
						type:'post',
						url: '<?= site_url('Home/autologout'); ?>',
						cache:false,		
						success:function(response)
						{
							if(response=="1")
							{
								
							}
						}
					});
				},1000);
			});  
	</script>
	<script>
			$("document").ready(function(){
				setInterval(function(){
				$.ajax({
					type:'post',
					url: '<?= site_url('Home/linktokenexpire')?>',
					cache:false,		
					success:function(response)
					{
						if(response=="1")
						{

						}
					}
				});
				},1000);
			}); 
		</script>