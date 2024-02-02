<?php if($video) { ?>
<!-- /header -->
<section class="wrapper bg-dark lower-start">
  <div class="container pt-7 pt-md-11 pb-8">
    <div class="row gx-0 gy-10 align-items-center">
      <div class="col-lg-6" data-cues="slideInDown" data-group="page-title" data-delay="600">
        <h1 class="display-2 text-white mb-4"><?php echo $video->judul ?></h1>
        <p class="lead fs-24 lh-sm text-white mb-7 pe-md-18 pe-lg-0 pe-xxl-15"><?php echo $video->keterangan ?></p>
        <div>
          <a class="btn btn-lg btn-primary rounded" href="<?php echo base_url('kontak') ?>">Hubungi Kami</a>
        </div>
      </div>
      <!-- /column -->
      <div class="col-lg-5 offset-lg-1" data-cues="slideInDown">
        <div class="position-relative">
          <a href="<?php echo $video->video ?>" class="btn btn-circle btn-primary btn-play ripple mx-auto mb-6 position-absolute" style="top:50%; left: 50%; transform: translate(-50%,-50%); z-index:3;" data-glightbox><i class="icn-caret-right"></i></a>
          <figure class="rounded shadow-lg"><img src="<?php echo base_url('assets/upload/image/'.$video->gambar) ?>" srcset="<?php echo base_url('assets/upload/image/'.$video->gambar) ?> 2x" alt="<?php echo $video->judul ?>" class="img-thumbnail"></figure>
        </div>
        <!-- /div -->
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
<?php } ?>