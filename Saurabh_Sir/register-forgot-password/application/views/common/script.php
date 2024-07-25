<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<!-- Include all compiled plugins as needed -->
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
	<!-- Extraction of external javascreept -->
	<script src="<?php echo base_url();?>assets/js/main.js"></script>
	<script src="<?php echo base_url();?>assets/js/toastr.js"></script>
	<script>
		toastr.options = {
		  "closeButton": false,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": true,
		  "positionClass": "toast-top-right",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "500",
		  "hideDuration": "1000",
		  "timeOut": "10000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
		<?php if($this->session->userdata('success')){?>
			// Display a success toast, with a title
			toastr.success('<?php echo $this->session->userdata('success'); ?>')
		<?php } ?>
		
		<?php if($this->session->userdata('warning')){?>
		// Display a warning toast, with no title
		toastr.warning('<?php echo $this->session->userdata('warning'); ?>')
		<?php } ?>
		
		<?php if($this->session->userdata('error')){?>
		// Display an error toast, with a title
		toastr.error('<?php echo $this->session->userdata('error'); ?>')
		<?php } ?>
		<?php if($this->session->userdata('hobbyerror')){?>
		// Display an error toast, with a title
		toastr.error('<?php echo $this->session->userdata('hobbyerror'); ?>')
		<?php } ?>
		<?php if($this->session->userdata('info')){?>
		// Display an info toast, with a title
		toastr.info('<?php echo $this->session->userdata('info'); ?>')
		<?php } ?>
	</script>