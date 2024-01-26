<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2><?php echo $title ?></h2>
        <ol>
          <li><a href="<?php echo base_url() ?>">Home</a></li>
          <li><?php echo $title ?></li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-2">

         <div class="col-md-4">
           <img src="<?php echo base_url('assets/upload/prestasi/'.$prestasi['gambar']) ?>" class="img img-thumbnail">
         </div>
         <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h1><?php echo $title ?></h1>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td class="bg-light" width="25%">Nama Prestasi</td>
                    <td><?php echo $prestasi['nama_prestasi'] ?></td>
                  </tr>
                  <tr>
                    <td class="bg-light">Pelaksana/Penyelenggara</td>
                    <td><?php echo $prestasi['penyelenggara'] ?></td>
                  </tr>
                  <tr>
                    <td class="bg-light">Tahun</td>
                    <td><?php echo $prestasi['tahun'] ?></td>
                  </tr>
                  <tr>
                    <td class="bg-light">Tingkat</td>
                    <td><?php echo $prestasi['tingkat'] ?></td>
                  </tr>
                  <tr>
                    <td class="bg-light">Bidang</td>
                    <td><?php echo $prestasi['bidang_prestasi'] ?></td>
                  </tr>
                  <tr>
                    <td class="bg-light">Penghargaan/Hadiah</td>
                    <td><?php echo $prestasi['hadiah_penghargaan'] ?></td>
                  </tr>
                  <tr>
                    <td class="bg-light">Info lain</td>
                    <td><?php echo $prestasi['keterangan'] ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              Tanggal: <?php echo tanggal_bulan_menit($prestasi['tanggal_update']) ?>
            </div>
          </div>
          
         </div>

      </div>
    </div>
  </section><!-- End Contact Section -->
</main><!-- End #main -->