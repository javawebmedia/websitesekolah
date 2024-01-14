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
            <div class="col-md-12">

                <table class="table table-sm table-hover" id="example2">
                    <thead>
                        <tr class="text-center bg-light">
                            <th width="5%" class="text-center">No</th>
                            <th width="40%">Judul</th>
                            <th width="10%">Jenis</th>
                            <th width="10%">Ukuran</th>
                            <th width="20%">Jumlah Download</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($download as $download) { ?>
                        <tr>
                            <td class="text-center"><?php echo $no ?>
                            </td>
                            
                            <td><?php echo $download->judul_download ?>
                                <small>
                                    <br><?php echo $download->isi ?>
                                </small>
                            </td>
                            <td class="text-center"><?php echo strtoupper($download->file_ext) ?></td>
                            <td class="text-center"><?php echo $download->file_size ?> MB</td>
                            <td class="text-center"><?php echo $download->hits ?> kali</td>
                            <td>
                                <?php if($download->gambar=="") { echo '-'; }else{ ?>
                                    <a href="<?php echo base_url('download/unduh/'.$download->id_download) ?>" class="btn btn-primary btn-sm mt-1" target="_blank"><i class="fa fa-download"></i> Unduh</a>
                                <?php } ?>
                               
                            </td>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>


