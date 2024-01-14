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
            <div class="row gy-4 masonary-active justify-center">
                <?php foreach($client as $client) { ?>
                <div class="col-md-3 filter-item">
                    <div class="gallery-card">
                        <div class="gallery-img">
                            <img src="<?php echo base_url('assets/upload/image/'.$client->gambar) ?>" alt="<?php echo $client->nama ?>">
                            <a href="<?php echo base_url('assets/upload/image/'.$client->gambar) ?>" class="gallery-btn popup-image"><i class="fas fa-eye"></i></a>
                        </div>
                        <div class="gallery-content">
                            <span class="gallery-tag"><?php echo $client->nama_client ?></span>
                            <h2 class="gallery-title"><?php echo $client->nama_kategori_client ?></h2>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 justify-content-center">
                    <div class="float-right">
                        <?php if(isset($pagination)) { echo str_replace('index.php/','',$pagination); } ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    