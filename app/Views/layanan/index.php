<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container pt-10 pb-19 pt-md-14 pb-md-20 text-center">
    <div class="row">
      <div class="col-md-10 col-lg-10 col-xl-5 mx-auto">
        <h1 class="display-1 mb-1 text-warning"><?php echo $title ?></h1>
    </div>
    <!-- /column -->
</div>
<!-- /.row -->
</div>
<!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-light">
  <div class="container pb-14 pb-md-16">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="blog classic-view mt-n17">
        <?php foreach($berita as $berita) { ?>

            <article class="post">
                <div class="card">
                  <figure class="card-img-top overlay overlay-1 hover-scale">
                    <a class="link-dark" href="<?php echo base_url('layanan/detail/'.$berita->slug_berita) ?>">
                      <?php if($berita->gambar !='') { ?>
                            <img src="<?php echo base_url('assets/upload/image/'.$berita->gambar) ?>" alt="<?php echo $title ?>" class="img-thumbnail">
                        <?php } ?>
                    </a>
                    <figcaption>
                      <h5 class="from-top mb-0">Baca detail...</h5>
                    </figcaption>
                  </figure>
                  <div class="card-body">
                    <div class="post-header">
                      <div class="post-category text-line">
                        <a href="<?php echo base_url('layanan/kategori/'.$berita->slug_kategori) ?>" class="hover" rel="category"><?php echo $berita->nama_kategori ?></a>
                      </div>
                      <!-- /.post-category -->
                      <h2 class="post-title mt-1 mb-0">
                        <a class="link-dark" href="<?php echo base_url('layanan/detail/'.$berita->slug_berita) ?>">
                            <?php echo $berita->judul_berita ?>
                        </a>
                    </h2>
                    </div>
                    <!-- /.post-header -->
                    <div class="post-content">
                      <p><?php echo $berita->ringkasan ?></p>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!--/.card-body -->
                  <div class="card-footer">
                    <ul class="post-meta d-flex mb-0">
                      <li class="post-date"><i class="uil uil-calendar-alt"></i><span><?php echo $this->website->tanggal_bulan_menit($berita->tanggal_publish) ?></span></li>
                      <li class="post-author"><a href="#"><i class="uil uil-user"></i><span><?php echo $berita->nama ?></span></a></li>
                      <li class="post-comments"><a href="#"><i class="fa fa-eye"></i><span> Dibaca <?php echo $berita->hits ?> kali</span></a></li>
                    </ul>
                    <!-- /.post-meta -->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </article>
              <!-- /.post -->

            
    <?php } ?>
    <div class="col-xxl-10 col-lg-10 offset-1">
        <div class="as-blog blog-single has-post-thumbnail row justify-content-end">
            <?php if(isset($pagination)) { echo str_replace('index.php/','',$pagination); } ?>
        </div>
    </div>
</div>
</div>
</div>
</div>
</section>