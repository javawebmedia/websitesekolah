<!--==============================
Breadcumb
============================== -->
<div class="breadcumb-wrapper background-heroj">
    <div class="container z-index-common">
        <h1 class="breadcumb-title"><?php echo $title ?></h1> 
    </div>
</div>

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