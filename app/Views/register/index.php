<div class="container">
	<div class="row">
        <div class="col-md-6 offset-3">
        	<hr>
        	<h4 class="text-center">Pendaftaran Anggota Baru</h4>
        	<div class="alert alert-info">
        		<strong>Perhatian! </strong>Isi data Anda dengan lengkap dan benar.
        	</div>

        	<?php 
        	$validation = \Config\Services::validation();
        	$errors = $validation->getErrors();
        	if(!empty($errors))
        	{
        		echo '<div class="alert alert-warning">'.$validation->listErrors().'</div>';
        	}
        	?>

        	<?php if (session('msg')) : ?>
        		<div class="alert alert-info alert-dismissible">
        			<?= session('msg') ?>
        			<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        		</div>
        	<?php endif ?>

        	<?php echo form_open(base_url('register')); ?>

				<input type="hidden" name="pengalihan" value="<?php echo Session()->get('pengalihan'); ?>">

				<div class="form-group mb-3">
					<label class="label" for="name">Nama lengkap <span class="text-danger">*</span></label>
					<input type="text" name="nama_client" class="form-control form-control-lg" value="<?php echo set_value('nama_client') ?>" required>
				</div>

				<div class="form-group mb-3">
					<label class="label" for="name">HP dengan Whatsapp Aktif <span class="text-danger">*</span></label>
					<input type="text" name="telepon" class="form-control form-control-lg"  value="<?php echo set_value('telepon') ?>" required>
				</div>

				<div class="form-group mb-3">
					<label class="label" for="name">Nama Organisasi/Sekolah/Perguruan <span class="text-danger">*</span></label>
					<input type="text" name="nama_perusahaan" class="form-control form-control-lg"  value="<?php echo set_value('nama_perusahaan') ?>" required>
				</div>

				<div class="form-group mb-3">
					<label class="label" for="name">Email (Username) <span class="text-danger">*</span></label>
					<input type="email" name="email" class="form-control form-control-lg"  value="<?php echo set_value('email') ?>" required>
				</div>
				<div class="form-group mb-3">
					<label class="label" for="password">Password <span class="text-danger">*</span></label>
					<input type="password" name="password" class="form-control form-control-lg" required>
					<small class="text-secondary">Minimal 6 dan maksimal 32 karakter</small>
				</div>
				<div class="form-group">
					<button type="reset" name="reset" value="reset" class="btn btn-dark btn-lg">
						<i class="fa fa-times"></i> Reset
					</button>
					<button type="submit" name="submit" value="submit" class="btn btn-success btn-lg">
						 Register <i class="fa fa-chevron-circle-right"></i>
					</button>
				</div>
				
			
			<?php echo form_close(); ?>
			<hr style="border-top: solid thin #666;">
			<p class="text-center">
				Kembali ke <a href="<?php echo base_url() ?>">Beranda</a> | Sudah punya akun? <a href="<?php echo base_url('login') ?>">Login</a>
			</p>
        </div>
    </div>
</div>