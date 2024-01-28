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
<!--==============================
Gallery Area  
==============================-->
    <div class="space">
        <div class="container">
            <div class="row gy-4 masonary-active">
                <?php foreach($portfolio as $portfolio) { ?>
                <div class="col-md-4 filter-item">
                    <div class="gallery-card">
                        <div class="gallery-img">
                            <img src="<?php echo base_url('assets/upload/image/'.$portfolio->gambar) ?>" alt="<?php echo $portfolio->judul_portfolio ?>">
                            <a href="<?php echo base_url('assets/upload/image/'.$portfolio->gambar) ?>" class="gallery-btn popup-image"><i class="fas fa-eye"></i></a>
                        </div>
                        <div class="gallery-content">
                            <span class="gallery-tag"><?php echo $portfolio->nama_kategori_portfolio ?></span>
                            <h2 class="gallery-title"><?php echo $portfolio->judul_portfolio ?></h2>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 justify-content-end">
                    <div class="float-right">
                        <?php if(isset($pagination)) { echo str_replace('index.php/','',$pagination); } ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>