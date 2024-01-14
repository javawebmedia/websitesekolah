<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>
<?php 
echo form_open(base_url('admin/user')); 
echo csrf_field(); 
?>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="form-group row">
					<label class="col-3">Nama Pengguna</label>
					<div class="col-9">
						<input type="text" name="nama" class="form-control" placeholder="Nama user" value="<?php echo set_value('nama') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Staff/Pegawai</label>
					<div class="col-9">
						<select name="id_staff" class="form-control select2">
							<option value="">Pilih Staff/Pegawai</option>
							<?php foreach($staff as $staff) { ?>
								<option value="<?php echo $staff->id_staff ?>" <?php if(isset($_GET['id_staff']) && $_GET['id_staff']== $staff->id_staff) { echo 'selected'; } ?>>
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
						<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Username</label>
					<div class="col-9">
						<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Password</label>
					<div class="col-9">
						<input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Level</label>
					<div class="col-9">
						<select name="akses_level" class="form-control">
							<option value="Admin">Admin</option>
							<option value="User">User</option>
						</select>
					</div>
				</div>

			</div>
			<div class="modal-footer justify-content-end">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>