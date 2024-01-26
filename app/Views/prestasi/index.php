<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container pt-10 pb-19 pt-md-14 pb-md-20 text-center">
    <div class="row">
      <div class="col-md-10 col-lg-10 col-xl-5 mx-auto">
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
  <div class="container pb-14 pb-md-16 bg-white">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="blog classic-view pt-5">

         <table class="table tabelku table-sm" id="example2">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th width="5%">Gambar</th>
              <th width="20%">Judul/Nama</th>
              <th width="5%">Tahun</th>
              <th width="10%">Tingkat</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach($prestasi as $prestasi) { ?>
            <tr>
              <td><?php echo $no ?></td>
              <td><?php if($prestasi->gambar=="") { echo '-'; }else{ ?>
                <img src="<?php echo base_url('assets/upload/image/thumbs/'.$prestasi->gambar) ?>" class="img img-thumbnail">
              <?php } ?>
              </td>
              <td><?php echo $prestasi->judul_prestasi ?></td>
              <td><?php echo $prestasi->tahun_prestasi ?></td>
              <td><?php echo $prestasi->jenjang_prestasi ?></td>
              <td>
                <a href="<?php echo base_url('prestasi/read/'.$prestasi->slug_prestasi) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Detail</a>
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