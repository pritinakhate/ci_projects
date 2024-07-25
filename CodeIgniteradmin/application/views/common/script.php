<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js">
</script>
<script src="<?php echo base_url(); ?>assets/js/ruang-admin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js">
</script>
<script src="<?php echo base_url(); ?>assets/js/demo/chart-area-demo.js">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>


<!-- toster -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Toster -->
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