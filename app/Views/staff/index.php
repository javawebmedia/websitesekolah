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
    <!-- /section -->
<section class="wrapper bg-light">
  <div class="container pb-14 pb-md-16">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="blog classic-view mt-n17">

            <article class="post">
                <div class="card p-5">
                  
            <?php 
            foreach($kategori_staff as $kategori_staff) { 
                $staff = $m_staff->kategori_staff($kategori_staff->id_kategori_staff);
                ?>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-12">
                    <h2 class="text-center alert alert-dark"><?php echo $kategori_staff->nama_kategori_staff ?></h2>
                    </div>
                    <?php if($staff) { foreach($staff as $staff) { ?>
                       <!-- Single Item -->
                       <div class="col-md-6 col-lg-4 col-xl-4 mb-2 pt-2">
                            <p class="text-center">
                                <img src="<?php echo base_url('assets/upload/staff/thumbs/'.$staff->gambar) ?>" alt="<?php echo $staff->nama ?>" class="rounded-circle w-20 mx-auto mb-4 img-thumbnail">
                            </p>
                            <div class="text-center">
                                <h3 class="team-title">
                                    <a href="<?php echo base_url('staff/detail/'.$staff->id_staff.'/'.strtolower(url_title($staff->nama))) ?>">
                                        <?php echo $staff->nama ?>
                                    </a>
                                </h3>
                                <span class="team-desig"><?php echo $staff->keahlian ?></span>
                            </div>
                            <div class="team-info text-center">
                                <span><?php echo $staff->jabatan ?></span>
                            </div>
                        
                        </div>
                    <?php }} ?>
                </div>

            <?php } ?>
    </div>
</article>
</div>
</div>
</div>
</div>
</section>

