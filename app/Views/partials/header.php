<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <title><?= $view_data['core_settings']['company']; ?></title>
    <META Http-Equiv="Cache-Control" Content="no-cache">
    <META Http-Equiv="Pragma" Content="no-cache">
    <META Http-Equiv="Expires" Content="0">
    <meta name="robots" content="none" />
    <link rel="SHORTCUT ICON" href="<?= base_url() ?>assets/blueline/img/favicon.ico" />


    <!-- Load CSS files -->

    <link rel="stylesheet" href="<?= base_url('assets/blueline/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/blueline/css/blueline.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/blueline/css/font-awesome.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/blueline/css/jquery.dataTables.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url() ?>assets/blueline/css/accordion-menu.css">
    <script src="<?= base_url() ?>assets/blueline/css/accordion-menu.js"></script>
    <script src="<?= base_url() ?>assets/blueline/js/message.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/blueline/css/super-panel.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/blueline/css/jquery.dataTables.min.css">
    <script src="<?= base_url() ?>assets/blueline/css/super-panel.js"></script>
    <!-- Google Font Loader -->
    <script type="text/javascript">
        WebFontConfig = {
            google: {families: ['Open+Sans:400italic,400,300,600,700:latin,latin-ext']}
        };
        (function () {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    <!-- Bootstrap core CSS and JS -->
    <script src="<?= base_url() ?>assets/blueline/js/plugins/jquery-1.12.4.min.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>

    <!-- Google Font Loader -->
    <script type="text/javascript">
        WebFontConfig = {
            google: {families: ['Open+Sans:400italic,400,300,600,700:latin,latin-ext']}
        };
        (function () {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    <!--Handle Page Loading-->
    <style>
        #load {
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 9999;
            background: url("<?=base_url()?>assets/blueline/images/logo-vision.png") no-repeat center center rgba(44, 62, 77, 0.5);
        }
    </style>
    <script>
        document.onreadystatechange = function () {
            var state = document.readyState
            if (state == 'complete') {
                document.getElementById('interactive');
                $('#load').fadeOut('slow');
            }
        }
    </script>
    <script src="<?= base_url() ?>assets/3cs/js/bs_leftnavi.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/3cs/css/vision.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/3cs/css/bs_leftnavi.css">

    <!-- Plugins -->
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/jquery-ui-1.10.3.custom.min.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/colorpicker.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/jquery-slider.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/summernote.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/chosen.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/datatables.min.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/nprogress.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/jquery-labelauty.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/easy-pie-chart-style.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/fullcalendar.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/reflex.min.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/animate.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/flatpickr.dark.min.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/font-awesome.min.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/ionicons.min.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/bootstrap-editable.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/jquery.ganttView.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/blueline/css/plugins/dropzone.min.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/blueline/css/user.css?ver=<?= $view_data['core_settings']['version']; ?>"/>
          <!-- Link your CSS file here -->
</head>

<?php if($view_data['act_uri'] == 'login' || $view_data['act_uri'] == 'forgotpass'){ ?>
      <body class="login" style="background-image:url('<?=base_url()?>assets/blueline/images/backgrounds/<?=$view_data['core_settings']['login_background'];?>')">
      <div class="container-fluid">
      <div class="row" style="margin-bottom:0px">
<?php } else { ?>
<body onload="myFunction()">
<?php } ?>
<div id="load"></div>
