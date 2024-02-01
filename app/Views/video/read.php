<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container pt-10 pb-15 pt-md-14 pb-md-16 text-center">
    <div class="row">
      <div class="col-md-10 col-lg-10 col-xl-10 mx-auto">
        <h1 class="display-2 mb-10 text-warning"><?php echo $title ?></h1>
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

            <article class="post">
                <div class="card">

                    <a href="<?php echo $video->video ?>" class="btn btn-circle btn-primary btn-play ripple mx-auto mb-6 position-absolute" style="top:50%; left: 50%; transform: translate(-50%,-50%); z-index:3;" data-glightbox><i class="icn-caret-right"></i></a>
          <figure class="card-img-top overlay overlay-1 hover-scale"><img src="<?php echo base_url('assets/upload/image/'.$video->gambar) ?>" srcset="<?php echo base_url('assets/upload/image/'.$video->gambar) ?> 2x" alt="<?php echo $video->judul ?>"></figure>

                  
                  <div class="card-body">
                    
                    <!-- /.post-header -->
                    <div class="post-content">
                      <?php echo $video->keterangan ?>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!--/.card-body -->
                  <div class="card-footer">
                    <ul class="post-meta d-flex mb-0">
                      <li class="post-date"><i class="uil uil-calendar-alt"></i><span><?php echo $this->website->tanggal_bulan_menit($video->tanggal) ?></span></li>
                     
                      <li class="post-comments"><a href="#"><i class="fa fa-eye"></i><span> Dibaca <?php echo $video->hits ?> kali</span></a></li>
                    </ul>
                    <!-- /.post-meta -->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </article>
              <!-- /.post -->

            
    
</div>
</div>
</div>
</div>
</section>