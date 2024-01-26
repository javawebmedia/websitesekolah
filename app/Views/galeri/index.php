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
<section id="snippet-1" class="wrapper bg-light wrapper-border">
      <div class="container pt-15 pt-md-17 pb-13 pb-md-15">
        
        <!--/.row -->
        <div class="projects-tiles">
          <div class="project grid grid-view">
            <div class="row gx-md-8 gx-xl-12 gy-10 gy-md-12 isotope">
            <?php foreach($galeri as $galeri) { ?>
              <div class="item col-md-4">
                <figure class="lift rounded mb-6">
                    <a href="<?php echo base_url('galeri/detail/'.$galeri->id_galeri) ?>"> 
                        <img src="<?php echo base_url('assets/upload/image/thumbs/'.$galeri->gambar) ?>" srcset="<?php echo base_url('assets/upload/image/thumbs/'.$galeri->gambar) ?> 2x" alt="" />
                    </a>
                </figure>
                <div class="post-category mb-3 text-purple"><?php echo $galeri->nama_kategori_galeri ?></div>
                <h3 class="post-title"><?php echo $galeri->judul_galeri ?></h3>
              </div>
              <!-- /.item -->
             <?php } ?> 
            </div>
            <!-- /.row -->
            <div class="row mt-5">
                <div class="col-md-12 justify-content-end">
                    <div class="float-right">
                        <?php if(isset($pagination)) { echo str_replace('index.php/','',$pagination); } ?>
                    </div>
                    
                </div>
            </div>
          </div>
          <!-- /.project -->
        </div>
        <!-- /.projects-tiles -->
      </div>
      
    </section>
