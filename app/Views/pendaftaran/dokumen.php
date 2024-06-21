<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container  pt-12 pt-md-16 pb-21 pb-md-21 text-center">
    <div class="row">
      <div class="col-md-10 col-lg-10 col-xl-10 mx-auto">
        <h1 class="display-1 mb-3 text-warning">3. Unggah Dokumen Pendukung</h1>
        <h4><span class="text-secondary">1. Pembuatan Akun</span> <i class="fa fa-chevron-right text-secondary"></i> <span class="text-secondary">2. Isi Biodata</span> <i class="fa fa-chevron-right text-secondary"></i> <span class="text-warning">3. Lengkapi Dokumen</span> <i class="fa fa-chevron-right text-secondary"></i> <span class="text-secondary">4. Pendaftaran Berhasil</span></h4>
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
      <div class="col-lg-12 mx-auto mt-n20">
        <div class="card">
          <div class="card-body p-11">

            <h2 class="mb-3 text-start">Unggah dokumen pendukung</h2>
              <p class="lead mb-6 text-start">Masukkan data Anda dengan benar dan lengkap.</p>

              <?php 
              $validation = \Config\Services::validation();
                  $errors = $validation->getErrors();
                  if(!empty($errors))
                  {
                      echo '<span class="text-danger">'.$validation->listErrors().'</span>';
                  }
              if (session('msg')) : 
              ?>
                   <div class="alert alert-info alert-dismissible">
                       <?= session('msg') ?>
                       <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                   </div>
               <?php endif ?>

             

          <table class="table tabelku table-sm">
            <thead>
              <tr>
                <th width="5%" class="text-left">No</th>
                <th width="30%" class="text-left">Nama Dokumen</th>
                <th width="10%" class="text-center">Status Wajib</th>
                <th width="20%" class="text-center">Status Unggah</th>
                <th class="text-center">Unggah</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $id_siswa     = $siswa->id_siswa;
              $no           = 1; 
              $data_total   = 1;
              foreach($jenis_dokumen as $jenis_dokumen) { 
                $id_jenis_dokumen     = $jenis_dokumen->id_jenis_dokumen;
                $check_dokumen        = $m_dokumen->check($id_siswa,$id_jenis_dokumen);
                if($jenis_dokumen->status_jenis_dokumen=='Wajib') {
                    if($check_dokumen) {
                      $data_id = 1;
                    }else{
                      $data_id = 0;
                    }
                }else{
                    $data_id = 1;
                }
                $data_total+=$data_id;
              ?>
              <tr data-id="<?php echo $data_id ?>">
                <td class="text-center"><?php echo $no ?></td>
                
                <td><?php echo $jenis_dokumen->nama_jenis_dokumen ?>
                  <small>
                    <br><?php echo $jenis_dokumen->keterangan ?>
                  </small>
                </td>
                <td class="text-center">
                  <?php if($jenis_dokumen->status_jenis_dokumen=='Wajib') { ?>
                    <span class="badge bg-info">
                      <i class="fa fa-check-circle"></i> <?php echo $jenis_dokumen->status_jenis_dokumen ?>
                    </span>
                  <?php }else{ ?>
                    <span class="badge bg-secondary">
                      <i class="fa fa-times-circle"></i> <?php echo $jenis_dokumen->status_jenis_dokumen ?>
                    </span>
                  <?php } ?>
                </td>
                <td class="text-center">
                     
                  <?php if($check_dokumen) { ?>
                    <span class="badge bg-info">
                      <i class="fa fa-check-circle"></i> Sudah
                    </span>
                  <?php }else{ ?>
                    <span class="badge bg-secondary">
                      <i class="fa fa-times-circle"></i> Belum
                    </span>
                  <?php } ?>
                </td>                
                <td>
                  <?php if($check_dokumen) { ?>
                    <a class="btn btn-dark btn-xs mb-1" href="<?php echo base_url('pendaftaran/unduh/'.$check_dokumen->kode_dokumen.'/'.$siswa->slug_siswa) ?>" target="_blank">
                      <i class="fa fa-download"></i>&nbsp;  Unduh
                    </a>
                    <a class="btn btn-secondary btn-sm  delete-link" href="<?php echo base_url('pendaftaran/hapus/'.$check_dokumen->kode_dokumen.'/'.$siswa->slug_siswa) ?>">
                      <i class="fa fa-trash"></i>&nbsp;  Hapus
                    </a>
                  <?php }else{ ?>
                    <?php 
                    echo form_open_multipart(base_url('pendaftaran/dokumen/'.$siswa->slug_siswa));
                    echo csrf_field(); 
                    ?>

                    <input type="hidden" name="id_jenis_dokumen" value="<?php echo $jenis_dokumen->id_jenis_dokumen ?>">

                    <div class="row">
                      <div class="col-md-8">
                        <input type="file" name="gambar" class="form-control form-control-sm" placeholder="Unggah" value="" required>
                      </div>
                      <div class="col-md-4">
                        <button type="submit" name="submit" value="Cari" class="btn btn-dark btn-xs mb-1">
                          <i class="fa fa-upload"></i>&nbsp; Submit
                        </button>
                    
                      </div>
                    </div>

                    <?php echo form_close();} ?>
                </td>
              </tr>
              <?php $no++; } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4"></td>
                <td>
                  <?php if($no==$data_total) { ?>
                      <a href="<?php echo base_url('pendaftaran/selesai/'.$siswa->slug_siswa) ?>" class="btn btn-success float-right text-white">
                        Simpan dan Selesaikan Pendaftaran&nbsp;<i class="fa fa-arrow-right"></i>
                      </a>
                  <?php }else{ ?>
                      <div class="alert alert-info">
                        Dokumen masih kurang, silakan lengkapi.
                      </div>
                  <?php } ?>
                </td>
              </tr>
            </tfoot>
          </table>
          
          
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

