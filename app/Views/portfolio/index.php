<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container pt-10 pb-12 pt-md-14 pb-md-14 text-center">
    <div class="row">
      <div class="col-md-10 col-lg-10 col-xl-10 mx-auto">
        <h1 class="display-1 mb-1 text-warning"><?php echo $title ?></h1>
    </div>
    <!-- /column -->
</div>
<!-- /.row -->
</div>
<!-- /.container -->
</section>

<!-- /section -->
    <section id="snippet-1" class="wrapper bg-light wrapper-border">
      <div class="container pt-12 pt-md-14 pb-13 pb-md-15">
        
        <!--/.row -->
        <div class="row grid-view gx-md-8 gx-xl-10 gy-8 gy-lg-0">
                <?php foreach($portfolio as $portfolio) { ?>

                    <div class="col-md-4 col-lg-3 mb-8">
            <div class="position-relative">
              <div class="shape rounded bg-soft-blue rellax d-md-block" data-rellax-speed="0" style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0">
              </div>
              <div class="card">
                <figure class="card-img-top">
                  <a href="<?php echo base_url('portfolio/read/'.$portfolio->id_portfolio) ?>">
                    <img class="img-fluid" src="<?php echo base_url('assets/upload/image/'.$portfolio->gambar) ?>" srcset="<?php echo base_url('assets/upload/image/'.$portfolio->gambar) ?> 2x" alt="<?php echo $portfolio->judul_portfolio ?>" />
                  </a>
                </figure>
                <div class="card-body px-6 py-5">
                  <h4 class="mb-1">
                    <a href="<?php echo base_url('portfolio/read/'.$portfolio->id_portfolio) ?>">
                      <?php echo $portfolio->judul_portfolio ?>
                    </a>
                  </h4>
                  <p class="mb-0"><?php echo $portfolio->nama_kategori_portfolio ?></p>
                </div>
                <!--/.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /div -->
          </div>
          <!--/column -->

                
               <?php } ?>
        <div class="clearfix"></div>
        </div>
         <div class="col-xxl-10 col-lg-10 offset-1">
        <div class="as-blog blog-single has-post-thumbnail row justify-content-end">
            <?php if(isset($pagination)) { echo str_replace('index.php/','',$pagination); } ?>
        </div>
    </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
      
    </section>
    <!-- /section -->
