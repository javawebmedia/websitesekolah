<!-- /section -->
    <section class="wrapper bg-light">
      <div class="container py-14 pt-md-10 pb-md-16">
        
        <div class="row text-center">
          <div class="col-lg-9 col-xl-8 col-xxl-7 mx-auto">
            <h3 class="display-4 mb-6">Berita &amp; Artikel</h3>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="position-relative">
          <div class="shape bg-dot primary rellax w-17 h-20" data-rellax-speed="1" style="top: 0; left: -1.7rem;"></div>
          <div class="swiper-container dots-closer blog grid-view mb-6" data-margin="0" data-dots="true" data-items-xl="3" data-items-md="2" data-items-xs="1">
            <div class="swiper">
              <div class="swiper-wrapper">
                <?php foreach($berita as $berita) { ?>
                <div class="swiper-slide">
                  <div class="item-inner">
                    <article>
                      <div class="card">
                        <figure class="card-img-top overlay overlay-1 hover-scale">
                          <a href="<?php echo base_url('berita/read/'.$berita->slug_berita) ?>"> 
                            <img src="<?php echo base_url('assets/upload/image/'.$berita->gambar) ?>" alt="<?php echo $berita->judul_berita ?>" />
                          </a>
                          <figcaption>
                            <h5 class="from-top mb-0">Baca detail...</h5>
                          </figcaption>
                        </figure>
                        <div class="card-body">
                          <div class="post-header">
                            <h2 class="post-title h3 mt-1 mb-3">
                              <a class="link-dark" href="<?php echo base_url('berita/read/'.$berita->slug_berita) ?>">
                                <?php echo $berita->judul_berita ?>
                              </a>
                            </h2>
                          </div>
                          <!-- /.post-header -->
                          <div class="post-content">
                            <p><?php echo word_limiter($berita->ringkasan,25) ?></p>
                          </div>
                          <!-- /.post-content -->
                        </div>
                        <!--/.card-body -->
                        <div class="card-footer">
                          <ul class="post-meta d-flex mb-0">
                            <li class="post-date"><i class="uil uil-calendar-alt"></i><span><?php echo $this->website->tanggal_bulan_menit($berita->tanggal_publish) ?></span></li>
                            <li class="post-comments">
                              <a href="<?php echo base_url('berita/kategori/'.$berita->slug_kategori) ?>">
                                <i class="uil uil-file-alt fs-15"></i><?php echo $berita->nama_kategori ?>
                              </a>
                            </li>
                          </ul>
                          <!-- /.post-meta -->
                        </div>
                        <!-- /.card-footer -->
                      </div>
                      <!-- /.card -->
                    </article>
                    <!-- /article -->
                  </div>
                  <!-- /.item-inner -->
                </div>
                <!--/.swiper-slide -->
               <?php } ?> 
              </div>
              <!--/.swiper-wrapper -->
            </div>
            <!--/.swiper -->
          </div>
          <!-- /.swiper-container -->
        </div>
        <!-- /.position-relative -->
      </div>
      <!-- /.container -->
    </section>