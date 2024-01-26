<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container pt-10 pb-19 pt-md-14 pb-md-20 text-center">
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
<section class="wrapper bg-light">
  <div class="container pb-14 pb-md-16">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="blog classic-view mt-n17">

            <article class="post">
                <div class="card">
                  <figure class="card-img-top overlay overlay-1 hover-scale">
                    
                      <?php if($staff->gambar !='') { ?>
                            <img src="<?php echo base_url('assets/upload/staff/'.$staff->gambar) ?>" alt="<?php echo $title ?>" class="img-thumbnail">
                        <?php } ?>
                    
                    
                  </figure>
                  <div class="card-body">
                    
                    <!-- /.post-header -->
                    <div class="post-content">
                      <div class="about-box">
                        <div class="about-info">
                            <h2 class="title"><?php echo $staff->nama ?></h2>
                            <span class="desig"><?php echo $staff->jabatan ?></span>
                        </div>
                        
                    </div>
                    <div class="about-quality">
                        <div class="quality-box">
                            <span class="quality-text">Jabatan:</span>
                            <span class="quality-text text-primary"><?php echo $staff->jabatan ?></span>
                        </div>
                        <div class="quality-box">
                            <span class="quality-text">Email:</span>
                            <span class="quality-text text-primary"><?php echo $staff->email ?></span>
                        </div>
                        
                    </div>
                    <h3 class="h5 mt-5">Expertise</h3>
                    <?php echo nl2br($staff->keahlian) ?>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!--/.card-body -->
                 
                </div>
                <!-- /.card -->
              </article>
              <!-- /.post -->

            
    
</div>
</div>
</div>
</div>
</section>
