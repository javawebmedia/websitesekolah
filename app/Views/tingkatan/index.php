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
                <div class="col-xxl-12 col-lg-12">
                    <div class="course-single">
                        <div class="course-single-top">
                            <div class="course-single-meta">
                                
                                <table class="table table-bordered table-striped" id="example3">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">No</th>
                                            <th width="10%">Gambar</th>
                                            <th width="30%">Nama</th>
                                            <th width="20%">Jenis</th>
                                            <th width="40%">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no=1; foreach($tingkatan as $tingkatan) { 
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no ?></td>
                                            <td class="text-center">
                                                <?php if($tingkatan->gambar=="") { echo '-'; }else{ ?>
                                                    <img src="<?php echo base_url('assets/upload/image/'.$tingkatan->gambar) ?>" class="img img-thumbnail">
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $tingkatan->nama_tingkatan ?></td>
                                            <td><?php echo $tingkatan->jenis_tingkatan ?></td>
                                            <td><?php echo $tingkatan->keterangan ?></td>
                                            
                                        </tr>
                                        <?php $no++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>