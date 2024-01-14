<!--==============================
Breadcumb
============================== -->
<div class="breadcumb-wrapper background-heroj">
    <div class="container z-index-common">
        <div class="row">
            <div class=" col-xxl-8 col-lg-8 offset-2">
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

            <div class="col-xxl-10 col-lg-10 offset-1">
                <div class="course-single">
                    <div class="course-single-top row">
                        <div class="col-md-6">
                            <div class="map-contact">
                                <div class="contact-info">
                                    <div class="contact-info_icon">
                                        <i class="fal fa-location-dot"></i>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="contact-info_title"><strong><?php echo $this->website->namaweb() ?></strong></h4>
                                        <span class="contact-info_text">
                                            <?php echo $this->website->alamat() ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="contact-info">
                                    <div class="contact-info_icon">
                                        <i class="fal fa-phone"></i>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="contact-info_title"><strong>Phone Number</strong></h4>
                                        <span class="contact-info_text">
                                            <span>Telepon: <a href="tel:<?php echo $konfigurasi->telepon ?>"><?php echo $konfigurasi->telepon ?></a></span>
                                            <br>
                                            <span>HP: <a href="tel:<?php echo $konfigurasi->hp ?>"><?php echo $konfigurasi->hp ?></a></span>
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="rounded border border-secondary bg-light p-2">
                                <?php echo $konfigurasi->google_map ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
