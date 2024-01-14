<!--==============================
Breadcumb
============================== -->
<div class="breadcumb-wrapper background-heroj">
    <div class="container z-index-common">
        <h1 class="breadcumb-title"><?php echo $title ?></h1> 
    </div>
</div>
    <!--==============================
Event Area  
==============================-->
    <section class="space-extra-bottom mt-5">
        <div class="container">
            <div class="row">
                <?php foreach($berita as $berita) { ?>
                <div class="col-xxl-10 col-lg-10 offset-1">
                   <div class="as-blog blog-single has-post-thumbnail row">
                            <div class="col-md-4">
                                <div class="blog-img">
                                    <?php if($berita->gambar !='') { ?>
                                        <img src="<?php echo base_url('assets/upload/image/'.$berita->gambar) ?>" alt="<?php echo $title ?>" class="img-thumbnail">
                                     <?php } ?>
                                 </div>
                             </div>
                             <div class="col-md-8">
                                <div class="blog-content">
                                    <h2 class="blog-title"><a href="<?php echo base_url('berita/read/'.$berita->slug_berita) ?>"><?php echo $berita->judul_berita ?></a></h2>
                                    <div class="blog-meta">
                                        <a href="<?php echo base_url('berita/kategori/'.$berita->slug_kategori) ?>"><i class="fa fa-tags"></i> <?php echo $berita->nama_kategori ?></a>
                                        <a href="#"><i class="far fa-eye"></i><?php echo $berita->hits ?> views</a>
                                        <a href="#"><i class="far fa-calendar-check"></i><?php echo $this->website->tanggal_bulan_menit($berita->tanggal_publish) ?></a>
                                    </div>
                                    <p><?php echo $berita->ringkasan ?></p>
                                    <div class="blog-bottom">
                                        <a href="<?php echo base_url('berita/read/'.$berita->slug_berita) ?>" class="link-btn">Baca Detail <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
                <?php } ?>
                <div class="col-xxl-10 col-lg-10 offset-1">
                    <div class="as-blog blog-single has-post-thumbnail row justify-content-end">
                        <?php if(isset($pagination)) { echo str_replace('index.php/','',$pagination); } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>