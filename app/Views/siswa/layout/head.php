<?php 
use App\Models\Konfigurasi_model;
$konfigurasi  = new Konfigurasi_model;
$site         = $konfigurasi->listing();

// website
use App\Libraries\Website;
$this->website  = new Website();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $title ?></title>
  <!-- Favicons -->
  <link href="<?php echo $this->website->icon() ?>" rel="icon">
  <link href="<?php echo $this->website->icon() ?>" rel="apple-touch-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/jqvmap/jqvmap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/summernote/summernote-bs4.min.css">
  <!-- SWEETALERT -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/summernote/summernote-bs4.min.css">
  <script src="<?php echo base_url('assets/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/viewerjs/ViewerJS/pdf.js') ?>"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


