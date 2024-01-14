<p class="text-right">
	<a href="<?php echo base_url('admin/user') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<?php 
echo form_open(base_url('admin/user/edit/'.$user->id_user)); 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Nama Pengguna</label>
	<div class="col-9">
		<input type="text" name="nama" class="form-control" placeholder="Nama user" value="<?php echo $user->nama ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Staff/Pegawai</label>
	<div class="col-9">
		<select name="id_staff" class="form-control select2">
			<option value="">Pilih Staff/Pegawai</option>
			<?php foreach($staff as $staff) { ?>
				<option value="<?php echo $staff->id_staff ?>" <?php if($staff->id_staff== $user->id_staff) { echo 'selected'; } ?>>
					<?php echo $staff->nama ?> - <?php echo $staff->jabatan ?>
				</option>
			<?php } ?>
		</select>
		<small class="text-gray">Kelola data staff dan pegawai? <a href="<?php echo base_url('admin/staff') ?>" title="Kelola Pegawai">Kelola Sekarang</a></small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Email</label>
	<div class="col-9">
		<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $user->email ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Username</label>
	<div class="col-9">
		<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $user->username ?>" readonly>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Password</label>
	<div class="col-9">
		<input type="text" name="password" class="form-control" placeholder="Password" value="">
		<small class="text-danger">Minimal 6 karakter dan maksimal 32 karakter atau biarkan kosong</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Level</label>
	<div class="col-9">
		<select name="akses_level" class="form-control">
			<option value="Admin">Admin</option>
			<option value="User" <?php if($user->akses_level=="User") { echo 'selected'; } ?>>User</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/user') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>