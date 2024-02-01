<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container pt-10 pb-19 pt-md-14 pb-md-15 pb-sm-3 text-center">
    <div class="row">
      <div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
        <h1 class="display-1 mb-1 text-warning"><?php echo $title ?></h1>
    </div>
    <!-- /column -->
</div>
<!-- /.row -->
</div>
<!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-light">
  <div class="container pb-14 pb-md-16">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="blog classic-view pt-10">

                <table class="table table-sm table-bordered tabelku" id="example2">
                    <thead>
                        <tr class="text-center">
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
                                    <a href="<?php echo base_url('download/unduh/'.$download->id_download) ?>" class="btn btn-primary btn-sm mt-1" target="_blank">
                                        <small><i class="fa fa-download"></i> Unduh</small>
                                    </a>
                                <?php } ?>
                               
                            </td>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</section>

