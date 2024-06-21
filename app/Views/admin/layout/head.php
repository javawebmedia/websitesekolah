<?php 
use App\Libraries\Website;
$this->website = new Website();

$uri = service('uri');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?></title>
  <link rel="icon" href="<?php echo $this->website->icon() ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- pace-progress -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/pace-progress/themes/black/pace-theme-flat-top.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/dropzone/min/dropzone.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- jQuery -->
  <script src="<?php echo base_url() ?>assets/admin/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url() ?>assets/jquery-ui/jquery-ui.min.js"></script>
  <link href="<?php echo base_url() ?>assets/jquery-ui/jquery-ui.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo base_url() ?>assets/admin/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url('assets/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
  <style type="text/css" media="screen">
    .ui-autocomplete { 
      z-index:2147483647; 
    }
    .ui-timepicker-container{ 
         z-index:1151 !important; 
    }
  </style>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse pace-primary">
  <!-- Site wrapper -->
  <div class="wrapper">