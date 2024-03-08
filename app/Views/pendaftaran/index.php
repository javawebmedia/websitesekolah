<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container  pt-12 pt-md-16 pb-21 pb-md-21 text-center">
    <div class="row">
      <div class="col-md-10 col-lg-10 col-xl-10 mx-auto">
        <h1 class="display-1 mb-3 text-warning">1. Buat Akun</h1>
        <h4><span class="text-warning">1. Pembuatan Akun</span> <i class="fa fa-chevron-right text-secondary"></i> <span class="text-secondary">2. Isi Biodata</span> <i class="fa fa-chevron-right text-secondary"></i> <span class="text-secondary">3. Lengkapi Dokumen</span> <i class="fa fa-chevron-right text-secondary"></i> <span class="text-secondary">4. Pendaftaran Berhasil</span></h4>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
<!-- /section -->

<!-- /section -->
<section class="wrapper bg-light">
  <div class="container pb-14 pb-md-16">
    <div class="row">
      <div class="col-lg-8 col-xl-8 col-xxl-8 mx-auto mt-n20">
        <div class="card">
          <div class="card-body p-11">

            <h2 class="mb-3 text-start">Membuat akun pendaftaran di <?php echo $this->website->namaweb() ?></h2>
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

              <?php echo form_open(base_url('pendaftaran')) ?>
                <div class="form-floating mb-4">
                  <input type="text" class="form-control" name="nama" value="<?php echo set_value('nama') ?>"  placeholder="Name" id="loginName">
                  <label for="loginName" class="text-primary">Nama</label>
                </div>

                <div class="form-floating mb-4">
                  <input type="email" class="form-control" name="email" value="<?php echo set_value('email') ?>"  placeholder="Email" id="loginEmail">
                  <label for="loginEmail" class="text-primary">Email (Username)</label>
                </div>

                
                  <div class="form-floating password-field mb-4">
                    <input type="password" class="form-control" name="password" placeholder="Password" id="loginPassword" minlength="6" maxlength="32">
                    <span class="password-toggle"><i class="uil uil-eye"></i></span>
                    <label for="loginPassword" class="text-primary">Password minimal 6 dan maksimal 32 karakter</label>
                  </div>

                  <div class="form-floating password-field mb-4">
                    <input type="password" class="form-control" name="konfirmasi_password" placeholder="Konfirmasi Password" id="loginPasswordConfirm" minlength="6" maxlength="32">
                    <span class="password-toggle"><i class="uil uil-eye"></i></span>
                    <label for="loginPasswordConfirm" class="text-primary">Konfirmasi Password</label>
                  </div>

                
                <div class="form-floating mb-4">
                  <input type="text" class="form-control" name="telepon"  value="<?php echo set_value('telepon') ?>" placeholder="Telepon/HP" id="Telepon">
                  <label for="loginEmail" class="text-primary">Telepon/HP</label>
                </div>

                <div class="form-floating mb-4">
                  <textarea name="alamat" class="form-control" placeholder="Alamat" required="required"><?php echo set_value('alamat') ?></textarea>
                  <label for="loginEmail" class="text-primary">Alamat lengkap</label>
                </div>

                <p>
                  <button type="reset" name="reset" value="reset" class="btn btn-warning rounded-pill btn-login w-40 mb-2">Reset &nbsp; <i class="fa fa-times-circle"></i></button>
                  <button type="submit" name="submit" value="submit" class="btn btn-primary rounded-pill btn-login w-60 mb-2">Buat Akun dan Lanjutkan &nbsp; <i class="fa fa-arrow-circle-right"></i></button>
                </p>
              </form>
              <!-- /form -->
              <p class="mb-0">Sudah punya Akun? <a href="https://javawebmedia.com/signin" class="hover">Login di sini</a></p>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

