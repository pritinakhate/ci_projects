<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>admin</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="<?php echo base_url();?>assetsadmin/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="<?php echo base_url();?>assetsadmin/js/plugin/webfont/webfont.min.js"></script>
    <script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["<?php echo base_url();?>assetsadmin/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url();?>assetsadmin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assetsadmin/css/plugins.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assetsadmin/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assetsadmin/css/toastr.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?php echo base_url();?>assetsadmin/css/demo.css" />
</head>