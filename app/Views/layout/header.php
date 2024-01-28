 <?php 
use App\Models\Nav_model;
use App\Models\Konfigurasi_model;
use App\Libraries\Website;
$this->website          = new Website(); 
$m_menu                 = new Nav_model();
$m_site                 = new Konfigurasi_model();
$site_setting           = $m_site->listing();
$nav_profil             = $m_menu->profil('Profil');
$nav_profil2            = $m_menu->profil('Profil');
$nav_berita             = $m_menu->berita();
$nav_layanan            = $m_menu->profil('Layanan');
$nav_layanan2           = $m_menu->profil('Layanan');
$nav_portfolio          = $m_menu->portfolio();
$nav_prestasi           = $m_menu->prestasi();
$nav_ekstrakurikuler    = $m_menu->ekstrakurikuler();
$nav_fasilitas          = $m_menu->fasilitas();
$nav_link_website       = $m_menu->link_website('Publish');
$nav_download           = $m_menu->download();
$nav_menu               = $m_menu->menu();

$menu_tambahan          = '';
foreach($nav_menu as $nav_menu) {
  $sub_menu             = $m_menu->sub_menu($nav_menu->id_menu);
  if($sub_menu) {
    $sub_menu_tambahan = '';
    foreach($sub_menu as $sub_menu) {
      $sub_menu_tambahan .= '<li><a class="dropdown-item" href="'.$sub_menu->link.'">'.$sub_menu->nama_sub_menu.'</a></li>';
    }
    $menu_tambahan        .= '<li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">'.$nav_menu->nama_menu.'</a>
                  <ul class="dropdown-menu">'.$sub_menu_tambahan.' </ul>
                </li>';
  }else{
    $menu_tambahan        .= '<li class="nav-item">
                  <a class="nav-link" href="'.$nav_menu->link.'">'.$nav_menu->nama_menu.'</a>
                </li>';
  }
}
// echo $menu_tambahan;
?>
 <div class="content-wrapper">
    <header class="wrapper bg-light">
      <div class="bg-success text-white fw-bold fs-14 mb-0">
        <div class="container py-1 d-md-flex flex-md-row">
          <div class="d-flex flex-row align-items-center">
            <div class="icon text-white fs-14 mt-1 me-2"> <i class="uil uil-location-pin-alt"></i></div>
            <address class="mb-0"><?php echo word_limiter(strip_tags($site_setting->alamat),5) ?></address>
          </div>
          <div class="d-flex flex-row align-items-center me-6 ms-auto">
            <div class="icon text-white fs-14 mt-1 me-2"> <i class="uil uil-phone-volume"></i></div>
            <p class="mb-0"><?php echo $site_setting->telepon ?></p>
          </div>
          <div class="d-flex flex-row align-items-center">
            <div class="icon text-white fs-14 mt-1 me-2"> <i class="uil uil-message"></i></div>
            <p class="mb-0"><a href="mailto:<?php echo $site_setting->email ?>" class="link-white hover"><?php echo $site_setting->email ?></a></p>
          </div>
        </div>
        <!-- /.container -->
      </div>
      <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
          <div class="navbar-brand w-100">
            <a href="<?php echo base_url() ?>">
              <img src="<?php echo $this->website->logo() ?>" srcset="<?php echo $this->website->logo() ?>" alt="<?php echo $this->website->namaweb() ?>"  style="max-width: 250px; max-height: 52px; width: auto; height: auto;"/>
            </a>
          </div>
          <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
            <div class="offcanvas-header d-lg-none">
              <h3 class="text-white fs-30 mb-0"><?php echo $this->website->namaweb() ?></h3>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
              <ul class="navbar-nav">
                
                <?php if($site_setting->menu_home=='Publish') { ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url() ?>">Home</a>
                </li>
                <?php } if($site_setting->letak_menu=='Home') { echo $menu_tambahan; } if($site_setting->menu_berita=='Publish') { ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Berita</a>
                  <ul class="dropdown-menu bg-dark">
                    <?php foreach($nav_berita as $nav_berita) { ?>
                    <li class="nav-item"><a class="dropdown-item text-white" href="<?php echo base_url('berita/kategori/'.$nav_berita->slug_kategori) ?>"><?php echo $nav_berita->nama_kategori ?></a></li>
                    <?php } ?>
                    <li class="nav-item"><a class="dropdown-item text-warning" href="<?php echo base_url('berita') ?>">Indeks Berita</a></li>
                   
                  </ul>
                </li>
                <?php }  if($site_setting->letak_menu=='Berita') { echo $menu_tambahan; } if($site_setting->menu_profil=='Publish') { ?>
                <li class="nav-item dropdown dropdown-mega">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Profil</a>
                  <ul class="dropdown-menu mega-menu mega-menu-dark">
                    <li class="mega-menu-content">
                      <div class="row gx-0 gx-lg-3">
                        <div class="col-lg-4">
                          <h6 class="dropdown-header text-warning">Profil, Staff &amp; Team</h6>
                          <ul class="list-unstyled pb-lg-1">
                            <?php foreach($nav_profil as $nav_profil) { ?>
                            <li><a class="dropdown-item" href="<?php echo base_url('berita/profil/'.$nav_profil->slug_berita) ?>"><?php echo $nav_profil->judul_berita ?></a></li>
                          <?php } ?>
                            <li><a class="dropdown-item" href="<?php echo base_url('staff') ?>">Team &amp; Staff<?php echo $this->website->namaweb() ?></a></li>
                          </ul>
                          <h6 class="dropdown-header mt-lg-6 text-warning">Layanan &amp; Produk</h6>
                          <ul class="list-unstyled">
                            <?php foreach($nav_layanan2 as $nav_layanan2) { ?>
                            <li><a class="dropdown-item" href="<?php echo base_url('layanan/detail/'.$nav_layanan2->slug_berita) ?>"><?php echo $nav_layanan2->judul_berita ?></a></li>
                            <?php } ?>
                            <li><a class="dropdown-item text-warning"  href="<?php echo base_url('layanan') ?>">Semua Layanan</a></li>
                          </ul>
                        </div>
                        <!--/column -->
                        
                        <div class="col-lg-4">
                          <h6 class="dropdown-header text-warning">Prestasi &amp; Penghargaan</h6>
                          <ul class="list-unstyled">
                            <?php foreach($nav_prestasi as $nav_prestasi) { ?>
                            <li><a class="dropdown-item" href="<?php echo base_url('prestasi/kategori/'.$nav_prestasi->slug_kategori_prestasi) ?>"><?php echo $nav_prestasi->nama_kategori_prestasi ?></a></li>
                            <?php } ?>
                            <li><a class="dropdown-item text-warning"  href="<?php echo base_url('prestasi') ?>">Semua Prestasi</a></li>
                          </ul>
                          <h6 class="dropdown-header mt-lg-6 text-warning">Ekstrakurikuler</h6>
                          <ul class="list-unstyled">
                            <?php foreach($nav_ekstrakurikuler as $nav_ekstrakurikuler) { ?>
                            <li><a class="dropdown-item" href="<?php echo base_url('ekstrakurikuler/kategori/'.$nav_ekstrakurikuler->slug_kategori_ekstrakurikuler) ?>"><?php echo $nav_ekstrakurikuler->nama_kategori_ekstrakurikuler ?></a></li>
                            <?php } ?>
                            <li><a class="dropdown-item text-warning"  href="<?php echo base_url('ekstrakurikuler') ?>">Semua Ekstrakurikuler</a></li>
                          </ul>
                        </div>
                        <!--/column -->
                        <div class="col-lg-4">
                          <h6 class="dropdown-header text-warning">Fasilitas, Sarana &amp; Prasarana</h6>
                          <ul class="list-unstyled">
                            <?php foreach($nav_fasilitas as $nav_fasilitas) { ?>
                            <li><a class="dropdown-item" href="<?php echo base_url('fasilitas/detail/'.$nav_fasilitas->slug_fasilitas) ?>"><?php echo $nav_fasilitas->judul_fasilitas ?></a></li>
                            <?php } ?>
                            <li><a class="dropdown-item text-warning"  href="<?php echo base_url('fasilitas') ?>">Semua Fasilitas</a></li>
                          </ul>
                        </div>
                        <!--/column -->
                      </div>
                      <!--/.row -->
                    </li>
                    <!--/.mega-menu-content-->
                  </ul>
                  <!--/.dropdown-menu -->
                </li>
                <?php }  if($site_setting->letak_menu=='Profil') { echo $menu_tambahan; } if($site_setting->menu_karya=='Publish') { ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Karya</a>
                  <ul class="dropdown-menu bg-dark">
                    
                    <?php foreach($nav_portfolio as $nav_portfolio) { ?>
                    <li><a class="dropdown-item text-white" href="<?php echo base_url('portfolio/kategori/'.$nav_portfolio->slug_kategori_portfolio) ?>"><?php echo $nav_portfolio->nama_kategori_portfolio ?></a></li>
                    <?php } ?>
                    <li><a class="dropdown-item text-warning"  href="<?php echo base_url('portfolio') ?>">Semua Karya</a></li>
                   
                  </ul>
                </li>
              <?php }  if($site_setting->letak_menu=='Karya') { echo $menu_tambahan; } if($site_setting->menu_galeri=='Publish') { ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Galeri</a>
                  <ul class="dropdown-menu bg-dark">
                    
                    <li class="nav-item"><a class="dropdown-item text-white" href="<?php echo base_url('galeri') ?>">Galeri Gambar</a></li>
                    <li class="nav-item"><a class="dropdown-item text-white" href="<?php echo base_url('video') ?>">Galeri Video</a></li>
                   
                  </ul>
                </li>
              <?php }  if($site_setting->letak_menu=='Galeri') { echo $menu_tambahan; }  if($site_setting->menu_unduhan=='Publish') { ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Unduhan</a>
                  <ul class="dropdown-menu bg-dark">
                    
                    <?php foreach($nav_download as $nav_download) { ?>
                    <li><a class="dropdown-item text-white" href="<?php echo base_url('download/kategori/'.$nav_download->slug_kategori_download) ?>"><?php echo $nav_download->nama_kategori_download ?></a></li>
                    <?php } ?>
                    <li><a class="dropdown-item text-warning"  href="<?php echo base_url('download') ?>">Semua Unduhan</a></li>
                   
                  </ul>
                </li>
              <?php }  if($site_setting->letak_menu=='Unduhan') { echo $menu_tambahan; } if($site_setting->menu_tautan=='Publish') { ?>
                <li class="nav-item dropdown dropdown-mega">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Tautan</a>
                  <ul class="dropdown-menu mega-menu mega-menu-dark mega-menu-img">
                    <li class="mega-menu-content">
                      <ul class="row row-cols-1 row-cols-lg-6 gx-0 gx-lg-6 gy-lg-4 list-unstyled">
                        <?php foreach($nav_link_website as $nav_link_website) { ?>
                        <li class="col"><a class="dropdown-item" href="<?php echo $nav_link_website->link_website ?>" target="<?php echo $nav_link_website->metode_link ?>">
                            <div class="rounded img-svg d-none d-lg-block p-0 mb-lg-2">
                              <img class="img img-thumbnail bg-light rounded" src="<?php echo base_url('assets/upload/image/thumbs/'.$nav_link_website->gambar) ?>" alt="<?php echo $nav_link_website->nama_link_website ?>">
                            </div>
                            <span><?php echo $nav_link_website->nama_link_website ?>
                            </span>
                          </a>
                        </li>
                      <?php } ?>
                        
                      </ul>
                      <!--/.row -->
                    </li>
                    <!--/.mega-menu-content-->
                  </ul>
                  <!--/.dropdown-menu -->
                </li>
              <?php }  if($site_setting->letak_menu=='Tautan') { echo $menu_tambahan; } ?>
              <?php if($site_setting->menu_kontak=='Publish') { ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('kontak') ?>">Kontak</a>
                </li>
              <?php } ?>
                
                
              </ul>
              <!-- /.navbar-nav -->
              <div class="offcanvas-footer d-lg-none">
                <div>
                  <a href="mailto:first.last@email.com" class="link-inverse">info@email.com</a>
                  <br /> 00 (123) 456 78 90 <br />
                  <nav class="nav social social-white mt-4">
                    <a href="#"><i class="uil uil-twitter"></i></a>
                    <a href="#"><i class="uil uil-facebook-f"></i></a>
                    <a href="#"><i class="uil uil-dribbble"></i></a>
                    <a href="#"><i class="uil uil-instagram"></i></a>
                    <a href="#"><i class="uil uil-youtube"></i></a>
                  </nav>
                  <!-- /.social -->
                </div>
              </div>
              <!-- /.offcanvas-footer -->
            </div>
            <!-- /.offcanvas-body -->
          </div>
          <!-- /.navbar-collapse -->
          <?php if($site_setting->fitur_pendaftaran=='On') { ?>
          <div class="navbar-other w-100 d-flex ms-auto">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              
              <li class="nav-item d-none d-md-block">
                <a href="<?php echo base_url('pendaftaran') ?>" class="btn btn-sm btn-primary px-2 py-1 text-sm">Pendaftaran</a>
              </li>
              <li class="nav-item d-none d-md-block">
                <a href="<?php echo base_url('signin') ?>" class="btn btn-sm btn-danger px-2 py-1 text-sm">Login</a>
              </li>
              <li class="nav-item d-lg-none">
                <button class="hamburger offcanvas-nav-btn"><span></span></button>
              </li>
            </ul>
            <!-- /.navbar-nav -->
          </div>
          <!-- /.navbar-other -->
        <?php } ?>
        </div>
        <!-- /.container -->
      </nav>
      <!-- /.navbar -->
    </header>
    <!-- /header -->