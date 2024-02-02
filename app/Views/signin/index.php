<section class="wrapper bg-soft-primary  bg-image" data-image-src="<?php echo $this->website->banner() ?>">
  <div class="container  pt-12 pt-md-16 pb-21 pb-md-21 text-center">
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
<section class="wrapper bg-light">
<div class="container pb-14 pb-md-16">
  <div class="row">
    <div class="col mt-n19">
      <div class="card shadow-lg">
        <div class="row gx-0 text-center">
          <div class="col-lg-6 image-wrapper bg-image bg-cover rounded-top rounded-lg-start d-none d-md-block" data-image-src="<?php echo base_url() ?>assets/template/assets/img/photos/tm3.jpg">
          </div>
          <!--/column -->
          <div class="col-lg-6">
            <div class="p-10 p-md-11 p-lg-13">
              <h2 class="mb-3 text-start">Selamat datang</h2>
              <p class="lead mb-6 text-start">Masukkan NIS/Email dan Password Anda.</p>
              <?php 
              if(Session()->getFlashdata('warning')) {
                ?>
                <div class="alert alert-warning alert-dismissible">
                    <i class="fa fa-times-circle"></i> <?php echo Session()->getFlashdata('warning'); ?>
                    
                 </div>
                <?php
              }
              $validation = \Config\Services::validation();
                  $errors = $validation->getErrors();
                  if(!empty($errors))
                  {
                      echo '<span class="text-danger">'.$validation->listErrors().'</span>';
                  }
              ?>
              <?php if (session('msg')) : ?>
                 <div class="alert alert-info alert-dismissible">
                     <?= session('msg') ?>
                     <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                 </div>
             <?php endif ?>
             
              <?php echo form_open(base_url('signin'),' class=="text-start mb-3"'); ?>
                <div class="form-floating mb-4">
                  <input type="text" class="form-control" name="username" placeholder="NIS/Email" id="loginEmail">
                  <label for="loginEmail">NIS/Email</label>
                </div>
                <div class="form-floating password-field mb-4">
                  <input type="password" class="form-control" name="password" placeholder="Password" id="loginPassword">
                  <span class="password-toggle"><i class="uil uil-eye"></i></span>
                  <label for="loginPassword">Password</label>
                </div>
                <button type="submit" name="submit" value="submit" class="btn btn-primary rounded-pill btn-login w-100 mb-2">Masuk&nbsp;<i class="fa fa-arrow-right"></i></button>
              </form>
              <!-- /form -->
              <p class="mb-1">Kembali ke <a href="<?php echo base_url() ?>">Beranda</a> | <a href="<?php echo base_url('signin/reset') ?>" class="hover">Lupa Password?</a></p>
              <p class="mb-0">Belum punya akun? <a href="<?php echo base_url('pendaftaran') ?>">Pendaftaran Online</a></p>
          
            
              <!--/.social -->
            </div>
            <!--/div -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /column -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container -->
</section>
<!-- /section -->