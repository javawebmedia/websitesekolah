<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container  pt-12 pt-md-16 pb-21 pb-md-21 text-center">
    <div class="row">
      <div class="col-md-10 col-lg-10 col-xl-10 mx-auto">
        <h1 class="display-1 mb-3 text-warning">4. Pendaftaran Berhasil</h1>
        <h4><span class="text-secondary">1. Pembuatan Akun</span> <i class="fa fa-chevron-right text-secondary"></i> <span class="text-secondary">2. Isi Biodata</span> <i class="fa fa-chevron-right text-secondary"></i> <span class="text-secondary">3. Lengkapi Dokumen</span> <i class="fa fa-chevron-right text-secondary"></i> <span class="text-warning">4. Pendaftaran Berhasil</span></h4>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
<!-- /section -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/bootstrap/adminlte.min.css">
<!-- /section -->
<section class="wrapper bg-light">
  <div class="container pb-14 pb-md-16">
    <div class="row">
      <div class="col-lg-8 mx-auto mt-n20">
        <div class="card">
          <div class="card-body p-11">

            <h2 class="mb-3 text-start">Pendaftaran Berhasil</h2>
              <p class="lead mb-6 text-start">Berikut adalah data pendaftaran Anda</p>
              <p class="text-right">
                <a href="<?php echo base_url('pendaftaran/cetak/'.$siswa->slug_siswa) ?>" class="btn btn-danger btn-sm w-100" target="_blank">
                  <i class="fa fa-file-pdf"></i>&nbsp;Cetak Bukti Pendaftaran
                </a>
              </p>
              

                  <div class="card">
                    <div class="card-header bg-light text-center">
                      DATA DASAR SISWA
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered printer">
                        <tbody>
                          <tr>
                            <td class="bg-light" width="35%">Nama lengkap</td>
                            <td><?php echo $siswa->nama_siswa ?></td>
                          </tr>
                          <tr>
                            <td class="bg-light">Nama panggilan</td>
                            <td><?php echo $siswa->nama_panggilan ?></td>
                          </tr>
                          <tr>
                            <td class="bg-light">Jenis Kelamin</td>
                            <td><?php echo $siswa->jenis_kelamin ?></td>
                          </tr>
                          <tr>
                            <td class="bg-light">Tempat, tanggal lahir</td>
                            <td><?php echo $siswa->tempat_lahir ?>, <?php echo $this->website->tanggal_id($siswa->tanggal_lahir) ?></td>
                          </tr>
                          <tr>
                            <td class="bg-light">Kode Pendaftaran</td>
                            <td><?php echo $siswa->kode_siswa ?></td>
                          </tr>
                        </tbody>
                      </table>
                    
                </div>
              </div>
          
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

