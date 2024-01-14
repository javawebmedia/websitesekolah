<?php 
use App\Models\Menu_model;
use App\Libraries\Website;
$this->website  = new Website(); 
$m_menu         = new Menu_model();
$nav_profil     = $m_menu->profil('Profil');
$nav_profil2    = $m_menu->profil('Profil');
$nav_berita     = $m_menu->berita();
$nav_layanan    = $m_menu->profil('Layanan');
$nav_layanan2   = $m_menu->profil('Layanan');
$nav_cabang     = $m_menu->cabang('Publish');
$nav_portfolio  = $m_menu->portfolio();
?>
<!--==============================
Header Area
==============================-->
<header class="as-header header-layout1">
    <div class="sticky-wrapper">
        <div class="sticky-active">
            <!-- Main Menu Area -->
            <div class="menu-area">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo">
                                <a href="<?php echo base_url() ?>">
                                    <img src="<?php echo $this->website->logo() ?>" alt="<?php echo $this->website->namaweb() ?>" style="max-width: 250px; max-height: 80px; width: auto; height: auto;"></a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <nav class="main-menu d-none d-lg-inline-block">
                                            <ul>
                                                <li>
                                                    <a href="<?php echo base_url() ?>">Home</a>
                                                </li>

                                                <!-- portfolio -->
                                                <li class="menu-item-has-children">
                                                    <a href="#">Portfolio</a>
                                                    <ul class="sub-menu">
                                                        <?php foreach($nav_portfolio as $nav_portfolio) { ?>
                                                            <li><a href="<?php echo base_url('portfolio/detail/'.$nav_portfolio->slug_kategori_portfolio) ?>"><?php echo $nav_portfolio->nama_kategori_portfolio ?></a></li>
                                                        <?php } ?>
                                                        <li><a href="<?php echo base_url('portfolio') ?>">Semua Portfolio</a></li>
                                                    </ul>
                                                </li>
                                                
                                                <!-- layanan -->
                                                <li class="menu-item-has-children">
                                                    <a href="#">Layanan</a>
                                                    <ul class="sub-menu">
                                                        <?php foreach($nav_layanan2 as $nav_layanan2) { ?>
                                                            <li><a href="<?php echo base_url('layanan/detail/'.$nav_layanan2->slug_berita) ?>"><?php echo $nav_layanan2->judul_berita ?></a></li>
                                                        <?php } ?>
                                                        <li><a href="<?php echo base_url('layanan') ?>">Semua Layanan</a></li>
                                                    </ul>
                                                </li>
                                                <!-- profil -->
                                                <li class="menu-item-has-children mega-menu-wrap">
                                                    <a href="#">Profil</a>
                                                    <ul class="mega-menu  mega-menu mega-menu-dark">
                                                        <li><a href="<?php echo base_url('profil') ?>">Profil Kami</a>
                                                            <ul>
                                                                <?php foreach($nav_profil as $nav_profil) { ?>
                                                                    <li><a href="<?php echo base_url('profil/'.$nav_profil->slug_berita) ?>"><?php echo $nav_profil->judul_berita ?></a></li>
                                                                <?php } ?>
                                                                <li><a href="<?php echo base_url('staff') ?>">Team <?php echo $this->website->namaweb() ?></a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="<?php echo base_url('layanan') ?>">Produk &amp; Layanan</a>
                                                            <ul>
                                                                <?php foreach($nav_layanan as $nav_layanan) { ?>
                                                                    <li><a href="<?php echo base_url('layanan/detail/'.$nav_layanan->slug_berita) ?>"><?php echo $nav_layanan->judul_berita ?></a></li>
                                                                <?php } ?>
                                                                <li><a href="<?php echo base_url('layanan') ?>">Semua Layanan</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="#">Galeri</a>
                                                            <ul>
                                                                <li><a href="<?php echo base_url('galeri') ?>">Galeri Gambar</a></li>
                                                                <li><a href="<?php echo base_url('video') ?>">Galeri Video</a></li>
                                                                <li><a href="<?php echo base_url('download') ?>">Download File</a></li>
                                                            </ul>
                                                        </li>
                                                        
                                                    </ul>
                                                </li>
                                                <!-- end profil -->
                                                <li class="menu-item-has-children">
                                                    <a href="#">Berita</a>
                                                    <ul class="sub-menu">
                                                        <?php foreach($nav_berita as $nav_berita) { ?>
                                                            <li><a href="<?php echo base_url('berita/kategori/'.$nav_berita->slug_kategori) ?>"><?php echo $nav_berita->nama_kategori ?></a></li>
                                                        <?php } ?>
                                                        <li><a href="<?php echo base_url('berita') ?>">Indeks Berita</a></li>
                                                    </ul>
                                                </li>
                                                <?php if($this->website->fitur_pendaftaran()=='On') { ?>
                                                    <!-- end profil -->
                                                    <li class="menu-item-has-children">
                                                        <a href="#">Cabang</a>
                                                        <ul class="sub-menu">
                                                            <?php foreach($nav_cabang as $nav_cabang) { ?>
                                                                <li><a href="<?php echo base_url('cabang/detail/'.$nav_cabang->slug_cabang) ?>"><?php echo $nav_cabang->nama_cabang ?></a></li>
                                                            <?php } ?>
                                                            <li><a href="<?php echo base_url('cabang') ?>">Semua Cabang</a></li>
                                                        </ul>
                                                    </li>
                                                <?php } ?>
                                                <li>
                                                    <a href="<?php echo base_url('clients') ?>">Client</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('kontak') ?>">Kontak</a>
                                                </li>
                                            </ul>
                                        </nav>
                                        <button type="button" class="as-menu-toggle d-inline-block d-lg-none">
                                            <i class="far fa-bars"></i>
                                        </button>
                                    </div>
                                    <div class="col-auto d-none d-xxl-block">
                                        <div class="header-button">
                                            <?php if(Session()->get('username_client') != '') { 
                                                if($this->website->fitur_pendaftaran()=='On') {
                                                ?>
                                                <a href="<?php echo base_url('client/dasbor') ?>" class="btn btn-primary" title="Masuk ke Dasbor">
                                                    <i class="fa fa-user"></i> <?php echo substr(Session()->get('nama_client'),0,6) ?>..
                                                </a>
                                                <a href="<?php echo base_url('signin/logout') ?>" class="btn btn-danger" title="Logout">
                                                    <i class="fa fa-sign-out-alt"></i>
                                                </a>
                                            <?php }}else{ ?>
                                                <a href="https://wa.me/<?php echo $this->website->whatsapp() ?>?text=<?php echo $this->website->pesan_whatsapp() ?>" class="btn btn-success btn-sm" target="_blank"><i class="fab fa-whatsapp"></i> Chat WA</a>
                                                <?php if($this->website->fitur_pendaftaran()=='On') { ?>
                                                <a href="<?php echo base_url('signin') ?>" class="btn btn-primary btn-sm"><i class="fa fa-lock"></i> Masuk</a>
                                                <a href="<?php echo base_url('register') ?>" class="btn btn-danger btn-sm"><i class="fa fa-edit"></i> Daftar</a>
                                            <?php }} ?>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header> 
