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
    <div class="row">
        <div class="col-md-6 offset-md-3">
        	<?php 
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
 
        	<?php echo form_open(base_url('signin')); ?>

				<input type="hidden" name="pengalihan" value="<?php echo Session()->get('pengalihan'); ?>">

				<div class="form-group mb-3">
					<label class="label" for="name">Username (Email/NIS)</label>
					<input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
				</div>
				<div class="form-group mb-3">
					<label class="label" for="password">Password</label>
					<input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
				</div>
				<div class="form-group">
					<button type="reset" name="reset" value="reset" class="btn btn-dark btn-lg">
						<i class="fa fa-times-circle"></i> &nbsp; Reset
					</button>
					<button type="submit" name="submit" value="submit" class="btn btn-success btn-lg">
						 Login &nbsp;<i class="fa fa-arrow-circle-right"></i>
					</button>
				</div>
				
			
			<?php echo form_close(); ?>
			<hr class="mt-5 mb-3 pt-0 pb-0">
			<p class="text-center">
				Kembali ke <a href="<?php echo base_url() ?>">Beranda</a> | Belum punya akun? <a href="<?php echo base_url('pendaftaran') ?>">Pendaftaran Online</a> | <a href="<?php echo base_url('signin/reset') ?>">Reset Password</a>
			</p>
        </div>
   </div>
</div>
</section>