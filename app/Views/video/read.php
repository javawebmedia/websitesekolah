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
                <div class="col-md-12 col-xl-12 filter-item cat1 cat3">
                    <div class="video-course">
                        <div class="course-img">
                            <img src="<?php echo base_url('assets/upload/image/'.$video->gambar) ?>" alt="course">
                            <span class="tag">New</span>
                            <a href="https://www.youtube.com/watch?v=<?php echo $video->video ?>" class="play-btn popup-video">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title"><a href="<?php echo base_url('video/read/'.$video->slug_video) ?>"><?php echo $video->judul ?></a></h3>
                            <a href="<?php echo base_url('video/read/'.$video->slug_video) ?>" class="author-name"><?php echo $video->keterangan ?></a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>