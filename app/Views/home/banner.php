<section class="wrapper bg-light">
  <div class="container-card">
    <div class="card image-wrapper bg-full bg-image mt-2 mb-0" data-image-src="<?php echo $this->website->banner() ?>">
      <div class="card-body py-10 px-0">
        <div class="container">
          <div class="row gx-md-8 gx-xl-12 gy-10 align-items-center text-center text-lg-start">
            <div class="col-lg-7" data-cues="slideInDown" data-group="page-title" data-delay="900">
              <h1 class="display-4 mb-4 me-xl-5 me-xxl-0 text-warning"><?php echo $slider->judul_galeri ?></h1>
              <p class="lead fs-23 lh-sm mb-7 pe-xxl-15 text-white"><?php echo strip_tags($slider->isi) ?></p>
              <div><a href="<?php echo $slider->website ?>" class="btn btn-lg btn-gradient gradient-1 rounded"><?php echo $slider->text_website ?> &nbsp;<i class="fa fa-arrow-right ml-2"></i></a></div>
            </div>
            <!--/column -->
            <div class="col-lg-5">
              <img class="img-fluid rounded img-thumbnail shadow-black" src="<?php echo base_url('assets/upload/image/'.$slider->gambar) ?>" srcset="<?php echo base_url('assets/upload/image/'.$slider->gambar) ?> 2x" data-cue="fadeIn" data-delay="300" alt="" />
            </div>
            <!--/column -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </div>
      <!--/.card-body -->
    </div>
    <!--/.card -->
  </div>
  <!-- /.container-card -->
</section>

