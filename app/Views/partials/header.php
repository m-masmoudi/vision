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
      <!-- Combined CSS Links -->
      <link rel="stylesheet" href="<?= base_url('assets/blueline/css/bootstrap.min.css') ?>">

      <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

      <link href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.min.css" rel="stylesheet">
      
      <link href="https://cdnjs.cloudflare.com/ajax/libs/nanoscroller/0.8.7/css/nanoscroller.min.css" rel="stylesheet">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/css/jquery-ui.min.css" rel="stylesheet">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.min.css"
            rel="stylesheet">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-gantt-view/1.1.0/jquery.ganttView.css" rel="stylesheet">

      <!-- Dropzone.js (File Upload) -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">

      <!-- Flatpickr (Date Picker) -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" rel="stylesheet">

      <!-- Bootstrap Editable (for inline editing) -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css"
            rel="stylesheet">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">


      <link rel="stylesheet" href="<?= base_url('assets/blueline/css/blueline.css') ?>">


      <link rel="stylesheet" href="<?= base_url() ?>assets/blueline/css/accordion-menu.css">

      <link rel="stylesheet" href="<?= base_url() ?>assets/blueline/css/super-panel.css">

      
      <link rel="stylesheet"
            href="<?= base_url() ?>assets/blueline/css/font-awesome.min.css?ver=<?= $view_data['core_settings']['version']; ?>" />



      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <!-- jQuery UI -->

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>



      <!-- Google Font Loader -->
      <script type="text/javascript">
            WebFontConfig = {
                  google: { families: ['Open+Sans:400italic,400,300,600,700:latin,latin-ext'] }
            };
            (function () {
                  var wf = document.createElement('script');
                  wf.src = (document.location.protocol === 'https:' ? 'https' : 'http') +
                        '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
                  wf.type = 'text/javascript';
                  wf.async = true;
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
                  background: url("<?= base_url() ?>assets/blueline/images/logo-vision.png") no-repeat center center rgba(44, 62, 77, 0.5);
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
            href="<?= base_url() ?>assets/blueline/css/plugins/jquery-ui-1.10.3.custom.min.css?ver=<?= $view_data['core_settings']['version']; ?>" />
      <link rel="stylesheet"
            href="<?= base_url() ?>assets/blueline/css/plugins/jquery-slider.css?ver=<?= $view_data['core_settings']['version']; ?>" />
      <link rel="stylesheet"
            href="<?= base_url() ?>assets/blueline/css/plugins/jquery-labelauty.css?ver=<?= $view_data['core_settings']['version']; ?>" />
      <link rel="stylesheet"
            href="<?= base_url() ?>assets/blueline/css/plugins/easy-pie-chart-style.css?ver=<?= $view_data['core_settings']['version']; ?>" />
      <!-- FullCalendar CSS -->
      <link rel="stylesheet"
            href="<?= base_url() ?>assets/blueline/css/plugins/fullcalendar.css?ver=<?= $view_data['core_settings']['version']; ?>" />
      <link rel="stylesheet"
            href="<?= base_url() ?>assets/blueline/css/plugins/reflex.min.css?ver=<?= $view_data['core_settings']['version']; ?>" />
      <link rel="stylesheet"
            href="<?= base_url() ?>assets/blueline/css/plugins/animate.css?ver=<?= $view_data['core_settings']['version']; ?>" />
      <link rel="stylesheet"
            href="<?= base_url() ?>assets/blueline/css/ionicons.min.css?ver=<?= $view_data['core_settings']['version']; ?>" />
      <link rel="stylesheet"
            href="<?= base_url() ?>assets/blueline/css/plugins/bootstrap-editable.css?ver=<?= $view_data['core_settings']['version']; ?>" />
      <link rel="stylesheet"
            href="<?= base_url() ?>assets/blueline/css/user.css?ver=<?= $view_data['core_settings']['version']; ?>" />
            
      <!-- Link your CSS file here -->
</head>

<?php if ($view_data['act_uri'] == 'login' || $view_data['act_uri'] == 'forgotpass') { ?>

      <body class="login"
            style="background-image:url('<?= base_url() ?>assets/blueline/images/backgrounds/<?= $view_data['core_settings']['login_background']; ?>')">
            <div class="">
                  <div class="" style="margin-bottom:0px">
                  <?php } else { ?>

                        <body onload="myFunction()">
                        <?php } ?>
                        <div id="load"></div>