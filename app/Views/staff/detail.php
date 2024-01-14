<!--==============================
Breadcumb
============================== -->
<div class="breadcumb-wrapper background-heroj">
    <div class="container z-index-common">
        <h1 class="breadcumb-title"><?php echo $title ?></h1> 
    </div>
</div>

<!--==============================
Team Area  
==============================-->
    <section class="bg-white space">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="team-details-img">
                        <img class="w-100" src="<?php echo base_url('assets/upload/staff/'.$staff->gambar) ?>" alt="<?php echo $staff->nama ?>">
                    </div>
                </div>
                <div class="col-xl-7 align-self-center">
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
                    <h3 class="h5 mt-35">Expertise</h3>
                    <?php echo nl2br($staff->keahlian) ?>
                </div>
            </div>
        </div>
    </section>