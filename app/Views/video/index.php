<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container pt-10 pb-15 pt-md-14 pb-md-16 text-center">
    <div class="row">
      <div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
        <h1 class="display-1 mb-1 text-warning"><?php echo $title ?></h1>
    </div>
    <!-- /column -->
</div>
<!-- /.row -->
</div>
<!-- /.container -->
</section>
  <!-- /section -->

<!-- /header -->
<section class="wrapper bg-light lower-start">
  <div class="container pt-5 pt-md-8 pb-5">
    <?php if($video) { foreach($video as $video) { ?>
      <div class="card block">
        <div class="card-body">
          <div class="row gx-0 gy-10 align-items-center">
            <div class="col-lg-6" data-cues="slideInDown" data-group="page-title" data-delay="600">
              <h1 class="display-2 text-dark mb-4"><?php echo $video->judul ?></h1>
              <p class="lead fs-18 lh-sm mb-5 pe-md-18 pe-lg-0 pe-xxl-15"><?php echo word_limiter($video->keterangan,25) ?></p>
              <div>
                <a class="btn btn-lg btn-primary rounded" href="<?php echo base_url('video/read/'.$video->slug_video) ?>">Lihat detail</a>
              </div>
            </div>
            <!-- /column -->
            <div class="col-lg-6" data-cues="slideInDown">
              <div class="position-relative">
                <a href="<?php echo $video->video ?>" class="btn btn-circle btn-primary btn-play ripple mx-auto mb-6 position-absolute" style="top:50%; left: 50%; transform: translate(-50%,-50%); z-index:3;" data-glightbox><i class="icn-caret-right"></i></a>
                <figure class="rounded shadow-lg">
                  <img src="<?php echo base_url('assets/upload/image/'.$video->gambar) ?>" srcset="<?php echo base_url('assets/upload/image/'.$video->gambar) ?> 2x" alt="<?php echo $video->judul ?>" class="img img-thumbnail bg-secondary">
                </figure>
              </div>
              <!-- /div -->
            </div>
            <!-- /column -->
          </div>
        </div>
        
      <?php }} ?>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>


<div class="container justify-content-center">
    <div class="row mt-5">
        <div class="col-md-12 justify-content-end">
            <div class="float-right">
                <?php if(isset($pagination)) { echo str_replace('index.php/','',$pagination); } ?>
            </div>
            
        </div>
    </div>
</div>
         
