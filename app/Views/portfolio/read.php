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

         <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <img src="<?php echo base_url('assets/upload/image/'.$portfolio->gambar) ?>" class="img img-thumbnail">
            </div>
          </div>
         </div>
         <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <table class="table table-bordered tabelku">
                <thead>
                  <tr>
                    <th width="25%">Nama Prestasi</th>
                    <th><?php echo $portfolio->judul_portfolio ?></th>
                  </tr>
                </thead>
                <tbody>
                  
                  
                  <tr>
                    <td class="bg-light">Info lain</td>
                    <td><?php echo $portfolio->isi ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              Tanggal: <?php echo $this->website->tanggal_bulan_menit($portfolio->tanggal) ?>
            </div>
          </div>
          
         </div>
       </div>

       
     </div>
   </section>