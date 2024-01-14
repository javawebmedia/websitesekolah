<!--==============================
Breadcumb
============================== -->
<div class="breadcumb-wrapper background-heroj">
    <div class="container z-index-common">
        <div class="row">
            <div class=" col-md-12">
                <h1 class="breadcumb-title"><?php echo $title ?></h1> 
            </div>
            
        </div>
    </div>
</div>
    <!--==============================
Event Area  
==============================-->
    <section class="space-extra-bottom mt-5">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="course-single">
                        <div class="course-single-top">
                            <?php if($berita->gambar !='') { ?>
                                <img src="<?php echo base_url('assets/upload/image/'.$berita->gambar) ?>" alt="<?php echo $title ?>" class="img-thumbnail">
                            
                                <hr>
                            <?php } ?>
                                
                           <?php echo $berita->isi ?>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <aside class="sidebar-area">
                        <div class="widget widget_info  ">
                        
                            <h3 class="widget_title">Tentang kami</h3>
                            <div class="info-list">
                                <ul>
                                    <?php foreach($news as $news) { ?>
                                    <li>
                                        <a href="<?php echo base_url('berita/read/'.$news->slug_berita) ?>">
                                            <i class="fa fa-chevron-right"></i> <?php echo $news->judul_berita ?> <sup class="text-seconcary"><i class="fa fa-eye"></i> <?php echo $news->hits ?></sup>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>