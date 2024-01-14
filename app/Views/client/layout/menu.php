<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('admin/dasbor') ?>" class="brand-link">
      <img src="<?php echo $this->website->icon() ?>" alt="<?php echo $this->website->namaweb() ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $this->website->singkatan() ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="<?php echo base_url('client/dasbor') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('client/pendaftar') ?>" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>Data Pendaftaran</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('client/pembayaran') ?>" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>Data Pembayaran</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('client/pembayaran/konfirmasi') ?>" class="nav-link">
              <i class="nav-icon fas fa-upload"></i>
              <p>Konfirmasi Pembayaran</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('client/akun') ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Akun Saya</p>
            </a>
          </li>

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1><?php echo $title ?></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="min-height: 400px;">

                <?php 
$validation = \Config\Services::validation();
    $errors = $validation->getErrors();
    if(!empty($errors))
    {
        echo '<span class="text-danger">'.$validation->listErrors().'</span>';
    }
?>

<?php if (session('msg')) : ?>
     <div class="alert alert-info alert-dismissible">
         <?= session('msg') ?>
         <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
     </div>
 <?php endif ?>