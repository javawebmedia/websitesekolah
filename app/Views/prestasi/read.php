<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container pt-10 pb-12 pt-md-14 pb-md-14 text-center">
    <div class="row">
      <div class="col-md-10 col-lg-10 col-xl-10 mx-auto">
        <h1 class="display-1 mb-1 text-warning"><?php echo $title ?></h1>
    </div>
    <!-- /column -->
</div>
<!-- /.row -->
</div>
<!-- /.container -->
</section>

<!-- /section -->
    <section id="snippet-1" class="wrapper bg-light wrapper-border">
      <div class="container pt-12 pt-md-14 pb-13 pb-md-15">
        
        <!--/.row -->
        <div class="row grid-view gx-md-8 gx-xl-10 gy-8 gy-lg-0">

         <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <img src="<?php echo base_url('assets/upload/image/'.$prestasi->gambar) ?>" class="img img-thumbnail">
            </div>
          </div>
         </div>
         <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <table class="table table-bordered tabelku">
                <thead>
                  <tr>
                    <th width="25%">Nama Prestasi</th>
                    <th><?php echo $prestasi->judul_prestasi ?></th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr>
                    <td class="bg-light">Pelaksana/Penyelenggara</td>
                    <td><?php echo $prestasi->penyelenggara ?></td>
                  </tr>
                  <tr>
                    <td class="bg-light">Tahun</td>
                    <td><?php echo $prestasi->tahun_prestasi ?></td>
                  </tr>
                  <tr>
                    <td class="bg-light">Tingkat</td>
                    <td><?php echo $prestasi->jenjang_prestasi ?></td>
                  </tr>
                  <tr>
                    <td class="bg-light">Bidang</td>
                    <td><?php echo $prestasi->nama_kategori_prestasi ?></td>
                  </tr>
                  <tr>
                    <td class="bg-light">Penghargaan/Hadiah</td>
                    <td><?php echo $prestasi->hadiah_prestasi ?></td>
                  </tr>
                  <tr>
                    <td class="bg-light">Info lain</td>
                    <td><?php echo $prestasi->isi ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              Tanggal: <?php echo $this->website->tanggal_bulan_menit($prestasi->tanggal) ?>
            </div>
          </div>
          
         </div>
       </div>

       <!--/.row -->
        <div class="row grid-view gx-md-8 gx-xl-10 gy-8 gy-lg-0 mt-5 justify-content-center">
          <div class="col-xl-12">
            <h3 class="text-center mt-5 mb-5">Lihat Prestasi dan Penghargaan Lainnya....</h3>
          </div>
           <?php $no=1; foreach($prestasi_list as $prestasi) { ?>
          <div class="col-md-6 col-lg-3 mb-8">
            <div class="position-relative">
              <div class="shape rounded bg-soft-blue rellax d-md-block" data-rellax-speed="0" style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0">
              </div>
              <div class="card">
                <figure class="card-img-top">
                  <a href="<?php echo base_url('prestasi/read/'.$prestasi->slug_prestasi) ?>">
                    <img class="img-fluid" src="<?php echo base_url('assets/upload/image/'.$prestasi->gambar) ?>" srcset="<?php echo base_url('assets/upload/image/'.$prestasi->gambar) ?> 2x" alt="<?php echo $prestasi->judul_prestasi ?>" />
                  </a>
                </figure>
                <div class="card-body px-6 py-5">
                  <h5 class="mb-1">
                    <a href="<?php echo base_url('prestasi/read/'.$prestasi->slug_prestasi) ?>">
                      <?php echo $prestasi->judul_prestasi ?>
                    </a>
                  </h5>
                  <p class="mb-0"><?php echo $prestasi->jenjang_prestasi ?> | <?php echo $prestasi->tahun_prestasi ?></p>
                </div>
                <!--/.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /div -->
          </div>
          <!--/column -->
        <?php } ?>
        
    </div>
        <!--/.row -->
     </div>
   </section>
