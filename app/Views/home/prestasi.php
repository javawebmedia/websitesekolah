<!-- /section -->
    <section id="snippet-1" class="wrapper bg-primary text-white wrapper-border">
      <div class="container pt-10 pt-md-15 pb-13 pb-md-15">
        <h2 class="display-4 mb-3 text-center text-white">Prestasi dan Penghargaan</h2>
        <p class="lead fs-lg mb-10 text-center px-md-16 px-lg-21 px-xl-0"><?php echo $this->website->namaweb() ?></p>
        <div class="swiper-container blog grid-view mb-6" data-margin="30" data-dots="true" data-items-xl="3" data-items-md="2" data-items-xs="1">
          <div class="swiper">
            <div class="swiper-wrapper">
              <?php foreach($prestasi as $prestasi) { ?>
              <div class="swiper-slide">
                <article>
                  <figure class="overlay overlay-1 hover-scale rounded mb-5">
                    <a href="<?php echo base_url('prestasi/read/'.$prestasi->slug_prestasi) ?>"> 
                      <img src="<?php echo base_url('assets/upload/image/'.$prestasi->gambar) ?>" alt="" />
                    </a>
                    <figcaption>
                      <h5 class="from-top mb-0">Lihat detail...</h5>
                    </figcaption>
                  </figure>
                  <div class="post-header">
                    <div class="post-category text-line text-warning">
                      <a href="<?php echo base_url('prestasi/kategori/'.$prestasi->slug_kategori_prestasi) ?>" class="hover text-warning" rel="category"><?php echo $prestasi->nama_kategori_prestasi ?></a>
                    </div>
                    <!-- /.post-category -->
                    <h2 class="post-title h3 mt-1 mb-3">
                      <a class="link-light" href="<?php echo base_url('prestasi/read/'.$prestasi->slug_prestasi) ?>"><?php echo $prestasi->judul_prestasi ?></a>
                    </h2>
                  </div>
                  
                </article>
                <!-- /article -->
              </div>
              <!--/.swiper-slide -->
              <?php } ?>
            </div>
            <!--/.swiper-wrapper -->
          </div>
          <!-- /.swiper -->
        </div>
        <!-- /.swiper-container -->
      </div>
      <!-- /.container -->
      
    </section>
    <!-- /section -->