<div class="row">
	<div class="col-md-7" id="pwd">
		<div class="card">
			<div class="card-header" id="user">
				<h4>Update Profil User</h4>
			</div>
			<div class="card-body">
				<?php 
				echo form_open_multipart(base_url('admin/akun')); 
				echo csrf_field(); 
				?>

				<p class="text-center mt-2">
					<?php 
					if($user->gambar=='') { 
						$gambar = base_url('assets/admin/dist/img/user4-128x128.jpg');
					}else{
						$gambar = base_url('assets/upload/image/'.$user->gambar);
					} 
					?>
					<img class="profile-user-img img-fluid img-circle" src="<?php echo $gambar ?>" alt="<?php echo $user->nama ?>" style="width: 100px; height: 100px;">
				</p>

				<div class="form-group row">
					<label class="col-3">Nama Pengguna</label>
					<div class="col-9">
						<input type="text" name="nama" class="form-control" placeholder="Nama user" value="<?php echo $user->nama ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Email</label>
					<div class="col-9">
						<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $user->email ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Upload Foto</label>
					<div class="col-9">
						<input type="file" name="gambar" class="form-control" placeholder="Upload foto" value="<?php echo $user->gambar ?>">
						<small class="text-gray">Format: jpg, png, gif</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Username</label>
					<div class="col-9">
						<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $user->username ?>" readonly>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Level</label>
					<div class="col-9">
						<input type="text" name="akses_level" class="form-control" placeholder="Akses level" value="<?php echo $user->akses_level ?>" disabled>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3"></label>
					<div class="col-9">
						<button type="submit" name="user" value="Update User" class="btn btn-success"><i class="fa fa-save"></i> Update Akun</button>
					</div>
				</div>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="card">
			<div class="card-header">
				<h4>Ganti Password</h4>
			</div>
			<div class="card-body">
				<?php 
				echo form_open_multipart(base_url('admin/akun')); 
				echo csrf_field(); 
				?>
				<input type="hidden" name="nama" class="form-control" placeholder="Nama user" value="<?php echo $user->nama ?>">
				<div class="form-group row">
					<label class="col-4">Password baru</label>
					<div class="col-8">
						<input type="password" name="password" class="form-control" placeholder="Password baru" minlength="6" maxlength="32" value="" required>
						<small class="text-danger">Minimal 6 dan maksimal 32 karakter</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-4">Konfirmasi Password baru</label>
					<div class="col-8">
						<input type="password" name="konfirmasi_password" class="form-control" placeholder="Konfirmasi Password baru" minlength="6" maxlength="32" value="" required>
						<small class="text-danger">Konfirmasi Password. Minimal 6 dan maksimal 32 karakter</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-4"></label>
					<div class="col-8">
						<button type="submit" name="pwd" value="Update password" class="btn btn-success"><i class="fa fa-save"></i> Update Password</button>
					</div>
				</div>

				<?php echo form_close(); ?>
			</div>
		</div>

	</div>

	<?php if($staff !='') { ?>
	<div class="col-md-7">
		<div class="card">
			<div class="card-header" id="staff">
				<h4>Update Profil Pegawai dan Staff</h4>
			</div>
			<div class="card-body">
				<p class="text-center mt-2">
					<?php 
					if($staff->gambar=='') { 
						$gambar = base_url('assets/admin/dist/img/user4-128x128.jpg');
					}else{
						$gambar = base_url('assets/upload/image/'.$staff->gambar);
					} 
					?>
					<img class="profile-user-img img-fluid img-circle" src="<?php echo $gambar ?>" alt="<?php echo $staff->nama ?>" style="width: 100px; height: 100px;">
				</p>

				<?php echo form_open_multipart(base_url('admin/akun')) ?>
				<div class="form-group row">
					<label class="col-3">Nama Staff</label>
					<div class="col-6">
						<input type="text" name="nama" class="form-control" placeholder="Nama staff" value="<?php echo $staff->nama ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Jenis Kelamin</label>
					<div class="col-6">
						<div class="form-group">
				            <div class="custom-control custom-radio">
				              <input class="custom-control-input" type="radio" id="customRadio1" name="jenis_kelamin" value="P" <?php if($staff->jenis_kelamin=='P') { echo 'checked'; } ?> required>
				              <label for="customRadio1" class="custom-control-label">Wanita</label>
				            </div>
				            <div class="custom-control custom-radio">
				              <input class="custom-control-input" type="radio" id="customRadio2" name="jenis_kelamin" value="L" <?php if($staff->jenis_kelamin=='L') { echo 'checked'; } ?> required>
				              <label for="customRadio2" class="custom-control-label">Laki-laki</label>
				            </div>
				        </div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Jabatan &amp; No Urut Tampil</label>
					<div class="col-4">
						<input type="text" name="jabatan" class="form-control" placeholder="Jabatan" value="<?php echo $staff->jabatan ?>">
					</div>
					<div class="col-2">
						<input type="number" name="urutan" class="form-control" placeholder="No Urut tampil" value="<?php echo $staff->urutan ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Tempat, tanggal lahir</label>
					<div class="col-3">
						<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir" value="<?php echo $staff->tempat_lahir ?>">
					</div>
					<div class="col-3">
						<input type="text" name="tanggal_lahir" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?php echo $this->website->tanggal_id($staff->tanggal_lahir) ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Jenis, Status Staff</label>
					<div class="col-3">
						<select name="id_kategori_staff" class="form-control">
							<?php foreach($kategori_staff as $kategori_staff) { ?>
							<option value="<?php echo $kategori_staff->id_kategori_staff ?>" <?php if($staff->id_kategori_staff==$kategori_staff->id_kategori_staff) { echo 'selected'; } ?>><?php echo $kategori_staff->nama_kategori_staff ?></option>
							<?php } ?>
						</select>
						<small class="text-secondary">Jenis Staff</small>
					</div>
					<div class="col-3">
						<select name="status_staff" class="form-control">
							<option value="Publish">Publish</option>
							<option value="Draft"  <?php if($staff->status_staff=="Draft") { echo 'selected'; } ?>>Draft</option>
						</select>
						<small class="text-secondary">Status Staff</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Upload Foto dan Website</label>
					<div class="col-4">
						<input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $staff->telepon ?>">
					</div>
					<div class="col-5">
						<input type="text" name="email" class="form-control" placeholder="Email staff" value="<?php echo $staff->email ?>">
					</div>
					
				</div>

				<div class="form-group row">
					<label class="col-3">Website dan logo</label>
					<div class="col-4">
						<input type="text" name="website" class="form-control" placeholder="Website" value="<?php echo $staff->website ?>">
					</div>
					<div class="col-5">
						<input type="file" name="gambar" class="form-control" placeholder="gambar" value="<?php echo $staff->gambar ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Alamat</label>
					<div class="col-9">
						<textarea name="alamat" placeholder="Alamat" class="form-control"><?php echo $staff->alamat ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Keahlian</label>
					<div class="col-9">
						<textarea name="keahlian" placeholder="Keahlian" class="form-control"><?php echo $staff->keahlian ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3"></label>
					<div class="col-9">
						<a href="<?php echo base_url('admin/staff') ?>" class="btn btn-outline-info">
							<i class="fa fa-arrow-left"></i> Kembali
						</a>
						<button type="submit" name="staff" value="Update Staff" class="btn btn-success"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
					</div>
				</div>


				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

<?php } ?>
	
</div>