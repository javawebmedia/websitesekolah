<section class="wrapper bg-light">
  <div class="container pt-10 pt-md-10 pb-10 pb-md-10">
    <div class="row text-center">
      <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
        <h2 class="fs-16 text-uppercase text-gradient gradient-1 mb-3">Kenapa memilih</h2>
        <h3 class="display-4 mb-9 px-xl-11"><?php echo $this->website->namaweb() ?></h3>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
    <div class="row gy-8 mb-5 justify-content-center">
      <?php foreach($keunggulan as $keunggulan) { ?>
      <div class="col-md-6 col-lg-4">
        <div class="d-flex flex-row">
          <div>
            <img src="<?php echo base_url('assets/upload/image/thumbs/'.$keunggulan->gambar) ?>" class="svg-inject icon-svg icon-svg-sm solid-duo text-grape-fuchsia me-4" alt="<?php echo $keunggulan->judul_berita ?>" />
          </div>
          <div>
            <h3 class="fs-22 mb-1"><?php echo $keunggulan->judul_berita ?></h3>
            <p class="mb-0"><?php echo $keunggulan->ringkasan ?></p>
          </div>
        </div>
      </div>
      <!--/column -->
      <?php } ?>
    </div>
    <!--/.row -->
    
  </div>
  <!-- /.container -->
</section>