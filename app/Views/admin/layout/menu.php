<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('admin/dasbor') ?>" class="brand-link">
      <img src="<?php echo $this->website->icon() ?>" alt="<?php echo $this->website->namaweb() ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $this->website->singkatan() ?></span>
    </a>

<style type="text/css" media="screen">
  nav ul li ul li i {
    color: yellow;
    margin-left: 10px;
  }
</style>
    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="<?php echo base_url('admin/dasbor') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <?php if($this->website->fitur_beladiri()=='On') { ?>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/pendaftar') ?>" class="nav-link">
              <i class="nav-icon fas fa-child"></i>
              <p>Data Pendaftar</p>
            </a>
          </li>

          <!-- berita -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>Siswa &amp; Pelatih <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/anggota') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Data Siswa &amp; Pelatih</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/anggota/tambah') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Tambah Siswa &amp; Pelatih</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/tingkatan') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Tingkatan / Sabuk</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
          

         <!-- berita -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>Berita &amp; Profil <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/berita') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Data Berita &amp; Profil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/berita/tambah') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Tambah Berita &amp; Profil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/kategori') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Kategori Berita &amp; Profil</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- PORTFOLIO -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>Portfolio <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/portfolio') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Data Portfolio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/portfolio/tambah') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Tambah Portfolio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/kategori_portfolio') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Kategori Portfolio</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- galeri -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>Galeri &amp; Banner <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/galeri') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Data Galeri &amp; Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/galeri/tambah') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Tambah Galeri &amp; Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/kategori_galeri') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Kategori Galeri &amp; Banner</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- download -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-upload"></i>
              <p>Download <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/download') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Data Download</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/download/tambah') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Tambah Download</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/kategori_download') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Kategori Download</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- CLIENT -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>Data Client <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/client') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Data Client</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/client/tambah') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Tambah Client</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/kategori_client') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Kategori Client</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- event -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>Event &amp; Agenda <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/agenda') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Data Event &amp; Agenda</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/agenda/tambah') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Tambah Event &amp; Agenda</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/kategori_agenda') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Kategori Event &amp; Agenda</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- video -->
          <li class="nav-item">
            <a href="<?php echo base_url('admin/video') ?>" class="nav-link">
              <i class="nav-icon fab fa-youtube"></i>
              <p>Video Youtube</p>
            </a>
          </li>
         
          <!-- Guru -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chair"></i>
              <p>Team &amp; Staff <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/staff') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Data Team &amp; Staff</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/staff/tambah') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Tambah Team &amp; Staff</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/kategori_staff') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Kategori Team &amp; Staff</p>
                </a>
              </li>
            </ul>
          </li>

          <?php if($this->website->fitur_beladiri()=='On') { ?>
          <!-- master -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Master Data <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/usia') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Kelompok Usia</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/jenjang') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Jenjang Pendidikan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/hubungan') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Hubungan Keluarga</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/pekerjaan') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Jenis Pekerjaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/agama') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Agama</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/cabang') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Cabang Latihan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/kategori_cabang') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Kategori Cabang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/tingkatan') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Tingkatan / Sabuk</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <?php if(Session()->get('akses_level')=='Admin') { ?>
          <!-- pengguna -->
          <li class="nav-item">
            <a href="<?php echo base_url('admin/user') ?>" class="nav-link">
              <i class="nav-icon fas fa-user-lock"></i>
              <p>Pengguna Sistem</p>
            </a>
          </li>

          <!-- konfigurasi -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>Setting Aplikasi <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/konfigurasi') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Setting Aplikasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/konfigurasi/banner') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>About Us &amp; Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/konfigurasi/logo') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Ganti Logo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/konfigurasi/icon') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Ganti Icon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/konfigurasi/sekolah') ?>" class="nav-link">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Informasi Sekolah</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        </ul>
        <br><br><br>
        <br><br><br>
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