<script src="<?php echo base_url();?>assetsadmin/js/core/jquery-3.7.1.min.js"></script>
<script src="<?php echo base_url();?>assetsadmin/js/core/popper.min.js"></script>
<script src="<?php echo base_url();?>assetsadmin/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="<?php echo base_url();?>assetsadmin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Chart JS -->
<script src="<?php echo base_url();?>assetsadmin/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="<?php echo base_url();?>assetsadmin/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="<?php echo base_url();?>assetsadmin/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="<?php echo base_url();?>assetsadmin/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="<?php echo base_url();?>assetsadmin/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="<?php echo base_url();?>assetsadmin/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="<?php echo base_url();?>assetsadmin/js/plugin/jsvectormap/world.js"></script>

<!-- Sweet Alert -->
<script src="<?php echo base_url();?>assetsadmin/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Kaiadmin JS -->
<script src="<?php echo base_url();?>assetsadmin/js/kaiadmin.min.js"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url();?>assetsadmin/js/setting-demo.js"></script>
<script src="<?php echo base_url();?>assetsadmin/js/demo.js"></script>
<script>
$("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#177dff",
    fillColor: "rgba(23, 125, 255, 0.14)",
});

$("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#f3545d",
    fillColor: "rgba(243, 84, 93, .14)",
});

$("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#ffa534",
    fillColor: "rgba(255, 165, 52, .14)",
});
</script>
<!-- Toster script -->
<script src="<?php echo base_url();?>assetsadmin/js/toastr.js"></script>
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
<?php if ($this -> session -> userdata('success')) {?>
// Display a success toast, with a title
toastr.success('<?php echo $this->session->userdata('success'); ?>')
<?php } ?>

<?php if ($this -> session -> userdata('warning')) {?>
// Display a warning toast, with no title
toastr.warning('<?php echo $this->session->userdata('warning'); ?>') <?php } ?>

<?php if ($this -> session -> userdata('error')) {?>
// Display an error toast, with a title
toastr.error('<?php echo $this->session->userdata('error'); ?>')
<?php } ?>
<?php if ($this -> session -> userdata('hobbyerror')) {?>
// Display an error toast, with a title
toastr.error('<?php echo $this->session->userdata('hobbyerror'); ?>')
<?php } ?>
<?php if ($this -> session -> userdata('info')) {?>
// Display an info toast, with a title
toastr.info('<?php echo $this->session->userdata('info'); ?>')
<?php } ?>
</script>

<?php $this->load->view('logout') ?>