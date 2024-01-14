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
        <div class="row gy-4">

            <?php 
            foreach($kategori_staff as $kategori_staff) { 
                $staff = $m_staff->kategori_staff($kategori_staff->id_kategori_staff);
                ?>
                <div class="row gy-4 justify-content-center">
                    <h2 class="text-center"><?php echo $kategori_staff->nama_kategori_staff ?></h2>
                    <hr>
                    <?php if($staff) { foreach($staff as $staff) { ?>
                       <!-- Single Item -->
                       <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="team-grid">
                            <div class="team-img">
                                <img src="<?php echo base_url('assets/upload/staff/'.$staff->gambar) ?>" alt="<?php echo $staff->nama ?>">
                            </div>
                            <div class="team-content text-center">
                                <h3 class="team-title"><a href="<?php echo base_url('staff/detail/'.$staff->id_staff.'/'.strtolower(url_title($staff->nama))) ?>"><?php echo $staff->nama ?></a></h3>
                                <span class="team-desig"><?php echo $staff->keahlian ?></span>
                            </div>
                            <div class="team-info text-center">
                                <span><i class="fa-light fa-file"></i><?php echo $staff->jabatan ?></span>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
            </div>

        <?php } ?>
    </div>
</div>
</section>

