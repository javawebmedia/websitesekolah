<?php 
if($popup) {
 ?>

 <div class="modal fade modal-popup" id="modal-02" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content modal-lg">
          <div class="modal-body">
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="row">
              <div class="col-md-12 text-center">
                <figure class="mb-6">
                    <a href="<?php echo $popup->website ?>" target="_blank">
                        <img src="<?php echo base_url('assets/upload/image/thumbs/'.$popup->gambar) ?>" srcset="<?php echo base_url('assets/upload/image/thumbs/'.$popup->gambar) ?> 2x" alt="<?php echo $popup->judul_galeri ?>" class="img-thumbnail rounded" />
                    </a>
                </figure>
              </div>
              <!-- /column -->
            </div>
            <!-- /.row -->
            <h3><a href="<?php echo $popup->website ?>" target="_blank"><?php echo $popup->judul_galeri ?></a></h3>
            <div class="mb-6">
                <?php echo $popup->isi ?>
            </div>
            <div class="newsletter-wrapper">
              <div class="row">
                <div class="col-md-12 text-center">
                  <!-- Begin Mailchimp Signup Form -->
                  <div id="mc_embed_signup">
                    <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i> &nbsp; Close
                    </button>
                    <a href="<?php echo $popup->website ?>" class="btn btn-primary" target="_blank">
                        Lihat detail &nbsp;<i class="fa fa-chevron-right"></i>
                    </a>
                  </div>
                  <!--End mc_embed_signup-->
                </div>
                <!-- /.newsletter-wrapper -->
              </div>
              <!-- /column -->
            </div>
            <!-- /.row -->
          </div>
          <!--/.modal-body -->
        </div>
        <!--/.modal-content -->
      </div>
      <!--/.modal-dialog -->
    </div>
    <!--/.modal -->
    <?php } ?>
<!--==============================
Hero Area
==============================-->
<div class="as-hero-wrapper hero-1 background-heroj" style="background-color: black;">
    <div class="container z-index-common">
        <div class="row">
            <div class="col-lg-8 mt-3">
                <div class="hero-style1 pt-4">
                    <h1 class="hero-title text-warning"><?php echo $slider->judul_galeri ?></h1>
                    <p class="hero-text text-white"><?php echo strip_tags($slider->isi) ?></p>

                    <div class="d-flex justify-content-center justify-content-lg-start mb-5" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900">
                      <span>
                        <a href="<?php echo base_url('kontak') ?>" target="_blank" class="btn btn-danger rounded-pill btn-lg"> 
                            Hubungi Kami <i class="fa fa-arrow-right"></i>
                        </a>

                        <a href="<?php echo $slider->website ?>" target="_blank" class="btn btn-warning rounded-pill btn-lg"> 
                            <?php echo $slider->text_website ?> <i class="fa fa-arrow-right"></i>
                        </a>
                    </span>
                     
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4 mt-2">
                <div class="hero-ku">
                    <div class="hero-style1 pt-5">
                        
                        <img src="<?php echo base_url('assets/upload/image/'.$slider->gambar) ?>" class="img rounded" alt="hero">
                    </div>
                    </div>
            </div>
        </div>

    </div>
    
</div>
<!--======== / Hero Section ========-->

<!--==============================
About Area  
==============================-->
    <div class="space">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="img-box5 mt-0 pt-0">
                        <div class="img1 mt-0 pt-0">
                            <img src="<?php echo $this->website->banner() ?>" alt="<?php echo $this->website->namaweb() ?>" class="img img-thumbnail">
                        </div>
                        <div class="shape">
                            <img src="<?php echo base_url() ?>assets/javawebmedia/assets/img/normal/about_shape_1.png" alt="<?php echo $this->website->namaweb() ?>">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="title-area mb-35">
                        <span class="sub-title"><?php echo $this->website->tagline() ?></span>
                        <h2 class="sec-title fw-semibold">Tentang <?php echo $this->website->namaweb() ?></h2>
                    </div>
                    <h5 class="mt-n2 mb-25"><?php echo $site->ringkasan ?></h5>
                    <div class="checklist style2 mb-35">
                        <?php echo $site->tentang ?>
                    </div>
                    <div class="btn-group">
                        <a href="<?php echo$site->link_website ?>" class="as-btn"><?php echo$site->link_text ?><i class="fas fa-arrow-right ms-2"></i></a>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-mockup" data-top="0%" data-right="0"><img src="<?php echo base_url() ?>assets/javawebmedia/assets/img/shape/cloud_3.png" alt="shape"></div>

    </div>
<!-- end about -->
<!--==============================
Keunggulan
==============================-->
<section class="pt-5 pb-5 bg-success">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 mb-1">
                <h3 class="text-center text-white mb-1">Kenapa bekerjasama dengan kami?</h3>
                <h5 class="text-warning text-center mb-5">Temukan Alasan untuk Bekerjasama dengan <?php echo $this->website->namaweb() ?></h5>
            </div>
        </div>
        
        
        <div class="row gy-4 justify-content-center">
            
            <?php foreach($keunggulan as $keunggulan) { ?>
            <div class="col-lg-6 col-xl-4 mb-1">
                <div class="category-list">
                    <div class="category-list_icon">
                        <img src="<?php echo base_url('assets/upload/image/thumbs/'.$keunggulan->gambar) ?>" class="img img-thumbnail" alt="icon">
                    </div>
                    <div class="category-list_content">
                        <h3 class="category-list_title">
                            <a href="<?php echo base_url('berita/read/'.$keunggulan->slug_berita) ?>">
                                <strong><?php echo $keunggulan->judul_berita ?></strong>
                            </a>
                        </h3>
                        <span class="category-list_text"><?php echo $keunggulan->ringkasan ?></span>
                    </div>
                    <a href="<?php echo base_url('berita/read/'.$keunggulan->slug_berita) ?>" class="icon-btn"><i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- end keunggulan -->
<!--==============================
berita
==============================-->
    <section class="space">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title">Berita terbaru</span>
                <h2 class="sec-title fw-medium">Simak Selalu Update dari Kami</h2>
            </div>
            <div class="row as-carousel" data-slide-show="3" data-ml-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1">

                <?php foreach($berita as $berita) { ?>

                <div class="col-md-6 col-xl-4">
                    <div class="course-box style3">
                        <div class="course-img">
                            <img src="<?php echo base_url('assets/upload/image/'.$berita->gambar) ?>" alt="course">
                            <span class="tag">Baru</span>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">
                                <a href="<?php echo base_url('berita/read/'.$berita->slug_berita) ?>">
                                    <?php echo $berita->judul_berita ?>
                                </a></h3>
                            <div class="course-author">

                                <p><?php echo $berita->ringkasan ?></p>
                            </div>
                            <div class="course-meta">
                                <span><i class="fal fa-tags"></i> <?php echo $berita->nama_kategori ?></span>
                                <span><i class="fal fa-eye"></i>  <?php echo $berita->hits ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
                
            </div>
        </div>
        <div class="shape-mockup jump" data-top="13%" data-left="0%">
            <img src="<?php echo base_url() ?>assets/javawebmedia/assets/img/shape/line_4.png" alt="shapes">
        </div>
        <div class="shape-mockup jump-reverse" data-bottom="3%" data-right="0%">
            <img src="<?php echo base_url() ?>assets/javawebmedia/assets/img/shape/dot_shape_4.png" alt="shapes">
        </div>
    </section>

    <!-- end berita -->

     <!--==============================
staff
==============================-->
    <section class="space overflow-hidden" data-bg-src="<?php echo base_url() ?>assets/javawebmedia/assets/img/bg/testi_bg_2.jpg">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title text-warning">Our great team</span>
                <h2 class="sec-title fw-semibold text-white">Bekerja bersama team kami yang solid</h2>
            </div>
        </div>
        <div class="container">
            <div class="row gx-40" id="testiSlide1">

                <?php foreach($staff as $staff) { ?>
                <div class="col-lg-6 mb-5">
                    <div class="testi-grid">
                        <p class="testi-grid_text"><?php echo $staff->keahlian ?></p>
                        <div class="testi-grid_bottom">
                            <div class="testi-grid_author">
                                <div class="testi-grid_avater">
                                    <img src="<?php echo base_url('assets/upload/staff/thumbs/'.$staff->gambar) ?>" alt="<?php echo $staff->nama ?>">
                                </div>
                                <div>
                                    <h3 class="testi-grid_name"><?php echo $staff->nama ?></h3>
                                    <span class="testi-grid_desig text-warning"><?php echo $staff->jabatan ?></span>
                                </div>
                            </div>
                            <div class="testi-grid_review">
                                <i class="fa-solid fa-star-sharp"></i><i class="fa-solid fa-star-sharp"></i><i class="fa-solid fa-star-sharp"></i><i class="fa-solid fa-star-sharp"></i><i class="fa-solid fa-star-sharp"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- end staff -->