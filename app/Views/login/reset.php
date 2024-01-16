<p class="text-center">
	Halo <strong><?php echo $user->nama ?></strong>.<br> Silakan ganti password Anda. Password minimal 6 dan maksimal 32 karakter
</p>

<?php 
$validation = \Config\Services::validation();
$errors = $validation->getErrors();
if(!empty($errors))
{
	echo '<span class="text-danger">'.$validation->listErrors().'</span>';
}
?>

<?php echo form_open(base_url('login/reset/' . $kode_rahasia)); ?>



<div class="form-group">
	<input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password Baru" minlength="6" maxlength="32">
</div>
<div class="form-group">
	<input type="password" name="password_konfirmasi" class="form-control form-control-user" id="password_konfirmasi" placeholder="Konfirmasi Password" minlength="6" maxlength="32">
	<div id="konfirmasiError">
		
	</div>
</div>


<div class="form-group mt-1">
	<button type="submit" class="btn btn-primary btn-user btn-block">
		Ganti password
	</button>

</div>

<hr>
<p class="text-center">Sudah Punya Akun? <a href="<?php echo base_url('') ?>">Login</a></p>

<?php echo form_close(); ?>
<?php if (session()->has('sukses')) : ?>
<div class="alert alert-success mt-3" role="alert">
	<?php echo session('sukses'); ?>
</div>
<?php elseif (session()->has('error')) : ?>
<div class="alert alert-danger mt-3" role="alert">
	<?php echo session('error'); ?>
</div>
<?php endif; ?>